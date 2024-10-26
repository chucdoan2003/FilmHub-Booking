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
        ->join('movies', 'showtimes.movie_id', '=', 'movies.id') 
        ->join('rooms', 'showtimes.room_id', '=', 'rooms.id')   // Join với bảng rooms
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.id') // Join với bảng shifts
        ->select('showtimes.*', 'movies.name as movie_name','rooms.name as room_name', 'shifts.name as shift_name', 'shifts.start_time', 'shifts.end_time')
        ->paginate(10);
        return view('admin.showtimes.list', compact('showtimes'));
    }
    function create(){
        return view('admin.showtimes.add');
    }
    function create2(Request $request){
        $datetime= $request->datetime;
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();
        $showtimes=DB::table('showtimes')
        ->select('room_id', DB::raw('COUNT(*) as total_showtimes'))
        ->whereDate('datetime', $datetime)
        ->groupBy('room_id')
        ->get();
        $room_over=[];
        foreach($showtimes as $item){
            if($item->total_showtimes == count($shifts)){
                $room_over[]= $item->room_id;
            }
        }
        return view('admin.showtimes.add2', compact('movies', 'rooms', 'datetime', 'room_over'));

    }
    function store(Request $request){
        $movie_id= $request->movie;
        $room_id = $request->room;
        $datetime= $request->datetime;
        $showtimes=  DB::table('showtimes')
        ->where('datetime', $datetime)
        ->where('room_id', $room_id)
        ->get();
       $shiftInroomBook = [];
       foreach($showtimes as $item){
        $shiftInroomBook[]=$item->shift_id;
       }
        $movies = DB::table('movies')->get();
        $rooms = DB::table('rooms')->get();
        $shifts = DB::table('shifts')->get();

        return view('admin.showtimes.addshift', compact('movies', 'rooms', 'shifts', 'movie_id', 'room_id', 'datetime', 'shiftInroomBook' ));
    }
    function addshowtime(Request $request){
        $shift_id = $request->shift;
        $movie_id= $request->movie;
        $room_id = $request->room;
        $datetime =$request->datetime;
        DB::table('showtimes')->insert([
            "movie_id"=>$movie_id,
            "room_id"=>$room_id,
            "shift_id"=>$shift_id,
            'datetime'=> $datetime
        ]);
        

       
        
        return redirect()->route('showtimes.create');
        

        

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
        $showtimes = DB::table('showtimes')->get();

        return response()->json([
            "message"=> "get data success",
            "data"=>$showtimes
        ]);
    }
}
