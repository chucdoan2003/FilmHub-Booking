<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class ShowtimesController extends Controller
{
    function addshowtimes(Request $request){


    }
    function list(){
        $showtimes = DB::table('showtimes')
        ->latest()
        ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
        ->join('rooms', 'showtimes.room_id', '=', 'rooms.room_id')   // Join với bảng rooms
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id') // Join với bảng shifts
        ->join('theaters', 'showtimes.theater_id', '=', 'theaters.theater_id')
        ->where('theaters.theater_id', Auth::user()->theater_id)
        // ->where('showtimes.datetime', '2024-12-05')

        ->select('showtimes.*', 'movies.title as movie_name','rooms.room_name as room_name', 'shifts.shift_name as shift_name','theaters.name as thearter_name', 'shifts.start_time', 'shifts.end_time')
        ->get();
        return view('admin.showtimes.list', compact('showtimes'));
    }
    public function findShowtime(Request $request){
        if(!empty($request->datetime)){
            $showtimes = DB::table('showtimes')
            ->latest()
            ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
            ->join('rooms', 'showtimes.room_id', '=', 'rooms.room_id')   // Join với bảng rooms
            ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id') // Join với bảng shifts
            ->join('theaters', 'showtimes.theater_id', '=', 'theaters.theater_id')
            ->where('theaters.theater_id', Auth::user()->theater_id)
            ->where('showtimes.datetime', $request->datetime)
            ->select('showtimes.*', 'movies.title as movie_name','rooms.room_name as room_name', 'shifts.shift_name as shift_name','theaters.name as thearter_name', 'shifts.start_time', 'shifts.end_time')
            ->get();
            return view('admin.showtimes.list', compact('showtimes'));
        }else{
            return redirect()->route('showtimes.index');
        }
    }
    function create(){
        $theaters = DB::table('theaters')->get();
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();
        $theaters = DB::table("theaters")->where('theater_id', Auth::user()->theater_id)->first();
        $errors = [];

        return view('admin.showtimes.addshift', compact('movies', 'rooms', 'shifts', 'theaters','errors' ));
    }


    function addshowtime(Request $request){
        // $shift_id = $request->shift;
        $movie_id= $request->movie;
        $room_id = $request->room;
        $datetime =$request->datetime;
        $theater = Auth::user()->theater_id;
        $normal_price = $request->normal_price;
        $vip_price = $request->vip_price;
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();
        $theaters = DB::table("theaters")->get();
        $start_time = $request->start_time;
        $end_time = $request->end_time;

        // dd($start_time);



        $errors=[];
        $inputDate = Carbon::createFromFormat('Y-m-d', $datetime , 'Asia/Ho_Chi_Minh');
        $currentDate = Carbon::now();

        if($inputDate->isPast() || $inputDate->isToday())
        {
            $errors['date_not_future'] = 'Ngày được chọn phải là một ngày của tương lai';
        }


        $movie = DB::table('movies')->where('movie_id',$movie_id)->first();
        $showtimes=  DB::table('showtimes')
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id')
        ->where('datetime', $datetime)
        ->where('theater_id', $theater)
        ->where('room_id', $room_id)
        ->get();
        if(isset($request->start_time) && isset($request->end_time)){


            foreach($showtimes as $show){
                if($show->start_time < $end_time && $start_time <$show->end_time){
                    $errors['shift_not_except']= "Ca chiếu bị trùng lặp";
                    break;

                    // return view('admin.showtimes.addshift', compact(
                    //     'movies', 'rooms', 'shifts', 'datetime',
                    //     'room_id', 'movie_id', 'theaters', 'theater',
                    //     'errors', 'showtimes',
                    //     'normal_price', 'vip_price'
                    // ));
                }
            }
            $start_time = Carbon::createFromFormat('H:i',$request->start_time );
            $end_time = Carbon::createFromFormat('H:i',$request->end_time );
            $differenceInMunutes = $start_time->diffInSeconds($end_time);
            $diff = $differenceInMunutes/60;

        }else{
            $errors['start_end_time'] = 'Thời gian bắt đầu, kết thúc của ca chiếu không được để trống';
            return view('admin.showtimes.addshift', compact(
                'movies', 'rooms', 'shifts', 'datetime',
                'room_id', 'movie_id', 'theaters', 'theater',
                'errors', 'showtimes',
                'normal_price', 'vip_price'
            ));
        }




        if($normal_price >= $vip_price){
            $errors['price_not_except'] = 'Giá vip phải lớn hơn giá thường';
        }
        if ($movie->duration > $diff) {
            $errors['isNotEnoughtTime']= 'Khoảng thời gian của ca chiếu phải lớn hơn thời lượng chiếu của phim. Thời lượng chiếu của phim '.$movie->duration.' Phút';
        }
        if (strtotime($start_time) > strtotime($end_time)) {
            $errors['startime_endtime']= 'Thời gian bắt đầu phải trước thời gian kết thúc';
        }
        if(!isset($normal_price)){
            $errors['normal_price_null'] = 'Giá thường không được để trống';
        }
        if(!isset($vip_price)){
            $errors['vip_price_null'] = 'Giá vip không được để trống';
        }

        if (!empty($errors)) {
            $start_time = Carbon::parse($start_time)->format('H:i');
            $end_time = Carbon::parse($end_time)->format('H:i');
            return view('admin.showtimes.addshift', compact(
                'movies', 'rooms', 'shifts', 'datetime',
                'room_id', 'movie_id', 'theaters', 'theater',
                'errors', 'showtimes', 'start_time', 'end_time',
                'normal_price', 'vip_price'
            ));
        }




        $shiftId = DB::table('shifts')->insertGetId([
            'shift_name' => '',
            'start_time' => $start_time,
            'end_time' => $end_time,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('showtimes')->insert([
            "theater_id" => $theater,
            "movie_id"=>$movie_id,
            "room_id"=>$room_id,
            "shift_id"=>$shiftId,
            'datetime'=> $datetime,
            'normal_price'=>$normal_price,
            'vip_price'=>$vip_price,
        ]);




        return redirect()->route('showtimes.index');




    }
    function destroy(string $id){
        $ticket = DB::table('tickets')->where('showtime_id', $id)->first();
        $showtime = DB::table('showtimes')->where('showtime_id', $id)->first();
        if(!empty($ticket)){
            $not_delete_showtime = true;
            $showtimes = DB::table('showtimes')
            ->latest()
            ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
            ->join('rooms', 'showtimes.room_id', '=', 'rooms.room_id')   // Join với bảng rooms
            ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id') // Join với bảng shifts
            ->join('theaters', 'showtimes.theater_id', '=', 'theaters.theater_id')
            ->where('theaters.theater_id', Auth::user()->theater_id)

            ->select('showtimes.*', 'movies.title as movie_name','rooms.room_name as room_name', 'shifts.shift_name as shift_name','theaters.name as thearter_name', 'shifts.start_time', 'shifts.end_time')
            ->get();
            return view('admin.showtimes.list', compact('showtimes', 'not_delete_showtime'));


        }else{
            $not_delete_showtime = false;
                if(isset($showtime->shift_id)){
                    DB::table('shifts')->where('shift_id', $showtime->shift_id)->delete();
                DB::table('showtimes')->where('showtime_id', $id)->delete();

                $showtimes = DB::table('showtimes')
                ->latest()
                ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
                ->join('rooms', 'showtimes.room_id', '=', 'rooms.room_id')   // Join với bảng rooms
                ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id') // Join với bảng shifts
                ->join('theaters', 'showtimes.theater_id', '=', 'theaters.theater_id')
                ->where('theaters.theater_id', Auth::user()->theater_id)

                ->select('showtimes.*', 'movies.title as movie_name','rooms.room_name as room_name', 'shifts.shift_name as shift_name','theaters.name as thearter_name', 'shifts.start_time', 'shifts.end_time')
                ->get();

                return view('admin.showtimes.list', compact('showtimes', 'not_delete_showtime'));
            }else{
                return redirect()->route('showtimes.index');
            }


        }

    }
    function edit(string $id){
        $showtime = DB::table('showtimes')->where('showtime_id', $id)->first();
        $showtime_id =$id;
        $shift = DB::table('shifts')->where('shift_id', $showtime->shift_id)->first();
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();
        $theaters = DB::table("theaters")->get();
        $datetime = $showtime->datetime;
        $room_id = $showtime->room_id;
        $movie_id = $showtime->movie_id;
        $start_time = $shift->start_time;
        $end_time = $shift->end_time;
        $normal_price = $showtime->normal_price;
        $vip_price = $showtime->vip_price;
        $errors= [];
        return view('admin.showtimes.edit2', compact(
           'movies','movie_id',  'rooms', 'shifts', 'datetime',
            'room_id', 'id', 'theaters',
            'normal_price', 'vip_price','start_time', 'end_time',
            'errors', 'showtime_id'
        ));
    }


    function update(string $id, Request $request,){
        $showtime = DB::table('showtimes')->where('showtime_id', $id)->first();

        $movie_id= $request->movie;
        $room_id = $request->room;
        $datetime =$request->datetime;
        $theater = Auth::user()->theater_id;
        $normal_price = $request->normal_price;
        $vip_price = $request->vip_price;
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();
        $theaters = DB::table("theaters")->get();
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $shift = DB::table('shifts')->where('shift_id', $showtime->shift_id)->first();

        $errors=[];


        $inputDate = Carbon::createFromFormat('Y-m-d', $datetime , 'Asia/Ho_Chi_Minh');
        $currentDate = Carbon::now();

        if($inputDate->isPast() || $inputDate->isToday())
        {
            $errors['date_not_future'] = 'Ngày được chọn phải là một ngày của tương lai';
        }


        $movie = DB::table('movies')->where('movie_id',$movie_id)->first();
        $showtimes=  DB::table('showtimes')
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id')
        ->where('datetime', $datetime)
        ->where('theater_id', $theater)
        ->where('room_id', $room_id)
        ->where('showtimes.shift_id', '!=', $showtime->shift_id )
        ->get();
        if(isset($request->start_time) && isset($request->end_time)){
            foreach($showtimes as $show){
                if($show->start_time < $end_time && $start_time <$show->end_time){
                    $errors['shift_not_except']= "Ca chiếu bị trùng lặp";
                    break;

                }
            }

            $start_time2 = Carbon::createFromFormat('H:i',substr(trim($request->start_time),0, 5) );
            $end_time2 = Carbon::createFromFormat('H:i',substr(trim($request->end_time),0, 5) );
            $differenceInMunutes = $start_time2->diffInSeconds($end_time2);
            $diff = $differenceInMunutes/60;
        }else{
            $errors['start_end_time'] = 'Thời gian bắt đầu và kết thúc của ca chiếu không được để trống';
             $showtime_id = $id;
            return view('admin.showtimes.edit2', compact(
                'movies', 'rooms', 'shifts', 'datetime',
                'room_id', 'movie_id', 'theaters', 'theater', 'start_time', 'end_time',
                'errors', 'showtimes',
                'normal_price', 'vip_price','showtime_id'
            ));
        }




        if($normal_price >= $vip_price){
            $errors['price_not_except'] = 'Giá vip phải lớn hơn giá thường';
        }
        if ($movie->duration > $diff) {
            $errors['isNotEnoughtTime']= 'Khoảng thời gian của ca chiếu phải lớn hơn thời lượng chiếu của phim. Thời lượng chiếu của phim '.$movie->duration.' Phút';
        }
        if (strtotime($start_time) > strtotime($end_time)) {
            $errors['startime_endtime']= 'Thời gian bắt đầu phải trước thời gian kết thúc';
        }
        if(!isset($normal_price)){
            $errors['normal_price_null'] = 'Giá thường không được để trống';
        }
        if(!isset($vip_price)){
            $errors['vip_price_null'] = 'Giá vip không được để trống';
        }

        if (!empty($errors)) {
            $start_time = Carbon::parse($start_time)->format('H:i');
            $end_time = Carbon::parse($end_time)->format('H:i');
            $showtime_id = $id;
            return view('admin.showtimes.edit2', compact(
                'movies', 'rooms', 'shifts', 'datetime',
                'room_id', 'movie_id', 'theaters', 'theater',
                'errors', 'showtimes', 'start_time', 'end_time',
                'normal_price', 'vip_price' , 'showtime_id'
            ));
        }
        $shiftId = DB::table('shifts')->where('shift_id', $showtime->shift_id)->update([
            'shift_name' => '',
            'start_time' => $start_time,
            'end_time' => $end_time,
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('showtimes')->where('showtime_id', $id)->update([
            "theater_id" => $theater,
            "movie_id"=>$movie_id,
            "room_id"=>$room_id,
            "shift_id"=>$showtime->shift_id,
            'datetime'=> $datetime,
            'normal_price'=>$normal_price,
            'vip_price'=>$vip_price,
        ]);




        return redirect()->route('showtimes.index');


    }

}
