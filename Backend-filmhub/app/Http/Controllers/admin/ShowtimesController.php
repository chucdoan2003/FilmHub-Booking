<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowtimesController extends Controller
{
    function addshowtimes(Request $request){


    }
    function list(){
        $showtimes = DB::table('showtimes')
        ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
        ->join('rooms', 'showtimes.room_id', '=', 'rooms.room_id')   // Join với bảng rooms
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id') // Join với bảng shifts
        ->join('theaters', 'showtimes.shift_id', '=', 'theaters.theater_id')
        ->select('showtimes.*', 'movies.title as movie_name','rooms.room_name as room_name', 'shifts.shift_name as shift_name','theaters.name as thearter_name', 'shifts.start_time', 'shifts.end_time')
        ->paginate(10);
        return view('admin.showtimes.list', compact('showtimes'));
    }
    function create(){
        $theaters = DB::table('theaters')->get();
        return view('admin.showtimes.add', compact('theaters'));
    }
    public function create3(){
        return view("admin.showtimes.add3");
    }
    function create2(Request $request){
        $datetime= $request->datetime;
        $theater= $request->theater;
        $theaters = DB::table('theaters')->get();
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();
        $showtimes=DB::table('showtimes')
        ->select('room_id', DB::raw('COUNT(*) as total_showtimes'))
        ->whereDate('datetime', $datetime)
        ->where("theater_id", $theater)
        ->groupBy('room_id')
        ->get();
        $room_over=[];
        foreach($showtimes as $item){
            if($item->total_showtimes == count($shifts)){
                $room_over[]= $item->room_id;
            }
        }
        return view('admin.showtimes.add2', compact('movies', 'rooms', 'datetime', 'room_over', 'theater', 'theaters'));

    }
    function store(Request $request){
        $movie_id= $request->movie;
        $room_id = $request->room;
        $datetime= $request->datetime;
        $theater = $request->theater;
        $theaters = DB::table("theaters")->get();
        $showtimes=  DB::table('showtimes')
        ->where('datetime', $datetime)
        ->where('theater_id', $theater)
        ->where('room_id', $room_id)
        ->get();
       $shiftInroomBook = [];
       foreach($showtimes as $item){
        $shiftInroomBook[]=$item->shift_id;
       }
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();

        return view('admin.showtimes.addshift', compact('movies', 'rooms', 'shifts', 'movie_id', 'room_id', 'datetime', 'shiftInroomBook', 'theaters', 'theater' ));
    }
    function addshowtime(Request $request){
        $shift_id = $request->shift;
        $movie_id= $request->movie;
        $room_id = $request->room;
        $datetime =$request->datetime;
        $theater = $request->theater;
        $normal_price = $request->normal_price;
        $vip_price = $request->vip_price;
        DB::table('showtimes')->insert([
            "theater_id" => $theater,
            "movie_id"=>$movie_id,
            "room_id"=>$room_id,
            "shift_id"=>$shift_id,
            'datetime'=> $datetime,
            'normal_price'=>$normal_price,
            'vip_price'=>$vip_price,
        ]);




        return redirect()->route('showtimes.index');




    }
    function destroy(string $id){
        DB::table('showtimes')->where('id', $id)->delete();
        return redirect()->route('showtimes.index');
    }
    function edit(string $id){
        $showtime = DB::table('showtimes')->where('id', $id)->first();
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();
        $showtimes=DB::table('showtimes')
        ->select('room_id', DB::raw('COUNT(*) as total_showtimes'))
        ->whereDate('datetime', $showtime->datetime)
        ->groupBy('room_id')
        ->get();
        // kiểm tra phòng full ca chưa
        $room_over=[];
        foreach($showtimes as $item){
            if($item->total_showtimes == count($shifts)){
                $room_over[]= $item->room_id;
            }
        }
        //Kiểm tra phòng chọn những ca nào r
        $showtimes2=  DB::table('showtimes')
        ->where('datetime', $showtime->datetime)
        ->where('room_id', $showtime->room_id)
        ->get();
       $shiftInroomBook = [];
       foreach($showtimes2 as $item){
        $shiftInroomBook[]=$item->shift_id;
       }

        return view('admin.showtimes.edit', compact('showtime', 'movies', 'shifts', 'rooms', 'room_over', 'shiftInroomBook'));


    }
    function update(string $id, Request $request,){
        try {
           $update = DB::table('showtimes')->where('id', $id)->update([
                "movie_id"=>$request->movie,
                "room_id"=>$request->room,
                "shift_id"=>$request->shift
            ]);
                return redirect()->route('showtimes.index');
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
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
