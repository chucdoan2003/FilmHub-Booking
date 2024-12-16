<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

        ->select('showtimes.*', 'movies.title as movie_name','rooms.room_name as room_name', 'shifts.shift_name as shift_name','theaters.name as thearter_name', 'shifts.start_time', 'shifts.end_time')
        ->get();
        return view('admin.showtimes.list', compact('showtimes'));
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

    // function create2(Request $request){
    //     $datetime= $request->datetime;
    //     $theater= $request->theater;
    //     $theaters = DB::table('theaters')->get();
    //     $movies = DB::table('movies')->get();
    //     $rooms = DB::table('rooms')->get();
    //     $shifts = DB::table('shifts')->get();
    //     $showtimes=DB::table('showtimes')
    //     ->select('room_id', DB::raw('COUNT(*) as total_showtimes'))
    //     ->whereDate('datetime', $datetime)
    //     ->where("theater_id", $theater)
    //     ->groupBy('room_id')
    //     ->get();
    //     $room_over=[];
    //     foreach($showtimes as $item){
    //         if($item->total_showtimes == count($shifts)){
    //             $room_over[]= $item->room_id;
    //         }
    //     }
    //     return view('admin.showtimes.add2', compact('movies', 'rooms', 'datetime', 'room_over', 'theater', 'theaters'));

    // }
    // function store(Request $request){
    //     $movie_id= $request->movie;
    //     $room_id = $request->room;
    //     $datetime= $request->datetime;
    //     $theater = $request->theater;
    //     $theaters = DB::table("theaters")->get();
    //     $showtimes=  DB::table('showtimes')
    //     ->where('datetime', $datetime)
    //     ->where('theater_id', $theater)
    //     ->where('room_id', $room_id)
    //     ->get();
    //    $shiftInroomBook = [];
    //    foreach($showtimes as $item){
    //     $shiftInroomBook[]=$item->shift_id;
    //    }
    //     $movies = DB::table('movies')->get();
    //     $rooms = DB::table('rooms')->get();
    //     $shifts = DB::table('shifts')->get();

    //     return view('admin.showtimes.addshift', compact('movies', 'rooms', 'shifts', 'movie_id', 'room_id', 'datetime', 'shiftInroomBook', 'theaters', 'theater' ));
    // }
    function addshowtime(Request $request){
        // $shift_id = $request->shift;
        $movie_id= $request->movie;
        $room_id = $request->room;
        $datetime =$request->datetime;
        $theater = $request->theater;
        $normal_price = $request->normal_price;
        $vip_price = $request->vip_price;
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();
        $theaters = DB::table("theaters")->get();
        $start_time = $request->start_time;
        $end_time = $request->end_time;

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
                    $errors['shift_not_except']= "Shift is not except";
                    return view('admin.showtimes.addshift', compact(
                        'movies', 'rooms', 'shifts', 'datetime',
                        'room_id', 'movie_id', 'theaters', 'theater',
                        'errors', 'showtimes',
                        'normal_price', 'vip_price'
                    ));
                }
            }
            $start_time = Carbon::createFromFormat('H:i',$request->start_time );
            $end_time = Carbon::createFromFormat('H:i',$request->end_time );
            $differenceInMunutes = $start_time->diffInSeconds($end_time);
            $diff = $differenceInMunutes/60;
        }else{
            $errors['start_end_time'] = 'Start time and end time must be set';
            return view('admin.showtimes.addshift', compact(
                'movies', 'rooms', 'shifts', 'datetime',
                'room_id', 'movie_id', 'theaters', 'theater',
                'errors', 'showtimes',
                'normal_price', 'vip_price'
            ));
        }



        $errors=[];

        if($normal_price > $vip_price){
            $errors['price_not_except'] = 'Normal price must be less than vip price';
        }
        if ($movie->duration > $diff) {
            $errors['isNotEnoughtTime']= 'Shift must be greater than minute movie duration';
        }
        if (strtotime($start_time) > strtotime($end_time)) {
            $errors['startime_endtime']= 'Start time must be less than end time';
        }
        if(!isset($normal_price)){
            $errors['normal_price_null'] = 'Normal price must be set';
        }
        if(!isset($vip_price)){
            $errors['vip_price_null'] = 'Vip price must be set';
        }

        if (!empty($errors)) {
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
        DB::table('showtimes')->where('showtime_id', $id)->delete();
        return redirect()->route('showtimes.index');
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
        $theater = $showtime->theater_id;
        $errors= [];
        return view('admin.showtimes.edit2', compact(
           'movies','movie_id',  'rooms', 'shifts', 'datetime',
            'room_id', 'id', 'theaters', 'theater',
            'normal_price', 'vip_price','start_time', 'end_time',
            'errors', 'showtime_id'
        ));
    }


    function update(string $id, Request $request,){
        $showtime = DB::table('showtimes')->where('showtime_id', $id)->first();

        $movie_id= $request->movie;
        $room_id = $request->room;
        $datetime =$request->datetime;
        $theater = $request->theater;
        $normal_price = $request->normal_price;
        $vip_price = $request->vip_price;
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();
        $theaters = DB::table("theaters")->get();
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $shift = DB::table('shifts')->where('shift_id', $showtime->shift_id)->first();


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
                    $errors['shift_not_except']= "Shift is not except";
                    return view('admin.showtimes.addshift', compact(
                        'movies', 'rooms', 'shifts', 'datetime',
                        'room_id', 'movie_id', 'theaters', 'theater',
                        'errors', 'showtimes',
                        'normal_price', 'vip_price'
                    ));
                }
            }

            $start_time = Carbon::createFromFormat('H:i',substr(trim($request->start_time),0, 5) );
            $end_time = Carbon::createFromFormat('H:i',substr(trim($request->end_time),0, 5) );
            $differenceInMunutes = $start_time->diffInSeconds($end_time);
            $diff = $differenceInMunutes/60;
        }else{
            $errors['start_end_time'] = 'Start time and end time must be set';
            return view('admin.showtimes.addshift', compact(
                'movies', 'rooms', 'shifts', 'datetime',
                'room_id', 'movie_id', 'theaters', 'theater',
                'errors', 'showtimes',
                'normal_price', 'vip_price'
            ));
        }



        $errors=[];

        if($normal_price > $vip_price){
            $errors['price_not_except'] = 'Normal price must be less than vip price';
        }
        if ($movie->duration > $diff) {
            $errors['isNotEnoughtTime']= 'Shift must be greater than minute movie duration';
        }
        if (strtotime($start_time) > strtotime($end_time)) {
            $errors['startime_endtime']= 'Start time must be less than end time';
        }
        if(!isset($normal_price)){
            $errors['normal_price_null'] = 'Normal price must be set';
        }
        if(!isset($vip_price)){
            $errors['vip_price_null'] = 'Vip price must be set';
        }

        if (!empty($errors)) {
            return view('admin.showtimes.addshift', compact(
                'movies', 'rooms', 'shifts', 'datetime',
                'room_id', 'movie_id', 'theaters', 'theater',
                'errors', 'showtimes', 'start_time', 'end_time',
                'normal_price', 'vip_price'
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
    function getAPI(Request $request){
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();
        $showtimes=DB::table('showtimes')
        ->select('room_id', DB::raw('COUNT(*) as total_showtimes'))
        ->whereDate('datetime', $request->datetime)
        ->groupBy('room_id')
        ->get();
        $room_over=[];
        foreach($showtimes as $item){
            if($item->total_showtimes == count($shifts)){
                $room_over[]= $item->room_id;
            }
        }
        $rooms2=[];
        foreach($rooms as $room){
            $room->isDisable = in_array($room->id, $room_over);
            // Thêm room vào mảng $rooms2
            $rooms2[] = $room;
        }
        $showtimes2=  DB::table('showtimes')
        ->where('datetime', $request->datetime)
        ->where('room_id', $request->room_id)
        ->get();
        ;

       $shiftInroom = [];

       foreach($showtimes2 as $item){
        $shiftInroom[]=$item->shift_id;
       }
       $shift2=[];

       foreach($shifts as $shift){
        $shift->isDisable = in_array($shift->id, $shiftInroom);
        // Thêm room vào mảng $rooms2
        $shift2[] = $shift;
    }



        return response()->json([
            "message"=> "get data success",
            "data"=>$request->datetime,
            "room_over"=>$room_over,
            "movies"=>$movies,
            "rooms"=>$rooms2,
            "shifts"=>$shift2,
            "shiftInroom"=>$shiftInroom,
            "showtimes"=>$showtimes2,
            "room_selected"=>$request->room_id,

        ]);
    }
}
