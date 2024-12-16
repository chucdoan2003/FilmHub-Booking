<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiShowtimes extends Controller{
    public function showtime($id){
        $showtimes = DB::table('showtimes')
        ->join('movies', 'showtimes.movie_id', '=', 'movies.id') 
        ->join('rooms', 'showtimes.room_id', '=', 'rooms.id')   // Join với bảng rooms
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.id') // Join với bảng shifts
        ->select('showtimes.*', 'movies.name as movie_name','rooms.name as room_name', 'shifts.name as shift_name', 'shifts.start_time', 'shifts.end_time')
        ->where('showtimes.movie_id', $id)->get();
       return response()->json([
        "message"=> "get data success",
        "data"=>$showtimes
       ]);
    }
}





?>