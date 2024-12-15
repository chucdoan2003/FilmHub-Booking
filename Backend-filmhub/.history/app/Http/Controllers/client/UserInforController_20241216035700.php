<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserInforController extends Controller
{
    public function history (){


        //
        if(Auth::check()){
            $tickets = DB::table('tickets')
        ->join('users', 'tickets.user_id', '=', 'users.user_id')
        ->join('showtimes', 'tickets.showtime_id', '=', 'showtimes.showtime_id')
        ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
        ->select(
            'tickets.*',
            "movies.*",
            "showtimes.*",
            'users.name as user_name',
        )
        ->where('tickets.user_id', Auth::user()->user_id)
        ->where('tickets.status','completed')
        ->orderBy('tickets.ticket_time', 'desc')
        ->get();
        foreach ($tickets as $ticket){
            $seats = DB::table('tickets_seats')
            ->join('seats', 'seats.seat_id','=', 'tickets_seats.seat_id')
            ->where('ticket_id', $ticket->ticket_id)
            ->get();
            $theater = DB::table('theaters')->where('theater_id', $ticket->theater_id)->first();
            $shift = DB::table('shifts')->where('shift_id', $ticket->shift_id)->first();
            $showtime = DB::table('showtimes')->where('showtime_id', $ticket->showtime_id)->first();
            $ticket->theater = $theater->name;
            $ticket->seats = $seats;
            $ticket->shift_name = $shift->shift_name;
            $ticket->shift_start = $shift->start_time;
            $ticket->shift_end = $shift->end_time;
            $ticket->datetime = $showtime->dattime;
        }

        return view("frontend.users.history", compact('tickets'));

        }else{
            return redirect()->route('login');
        }

        // $tickets = DB::table('tickets')->where('user_id', $user)->get();
        // $foods = [];
        // $drinks = [];

        // foreach($tickets as $ticket){
        //     $food = DB::table('foods')->where('id',$ticket->food_id)->first();
        //     $drink = DB::table('drinks')->where('id',$ticket->drink_id)->first();
        //     if ($food) {
        //         $foods[] = $food;
        //     }
        //     if ($drink) {
        //         $drinks[] = $drink;
        //     }
        //     $showtime = DB::table('showtimes')
        //     ->where('showtimes.showtime_id', $ticket->showtime_id)
        //     ->first();
        //     $movie = DB::table('movies')->where('movie_id', $showtime->movie_id)->first();
        //     $thearter = DB::table('theaters')->where('theater_id', $showtime->theater_id)->first();
        //     $room = DB::table('rooms')->where('room_id', $showtime->room_id)->first();
        //     $shift = DB::table('shifts')->where('shift_id', $showtime->shift_id)->first();
        // }

    }
    public function overview(){
        return view('frontend.users.overview');
    }
    public function edit(){
        $user = auth()->user();
        return view('frontend.users.edit', compact('user'));
    }
    public function update(Request $request){
        $user = Auth::user();
        if ($request->hasFile('avt')) {
            // Xóa ảnh cũ nếu có
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }
            // Lưu ảnh mới
            $path = $request->file('avt')->store('storage/users', 'public'); //
            DB::table('users')->where('user_id',$user->user_id)->update([
                'name' => $request->name,

                'avt'=>$path
            ]);
        }else{
            DB::table('users')->where('user_id',$user->user_id)->update([
                'name' => $request->name,

            ]);

        }
        return redirect()->route('userOverview');


    }

    public function Payment()
{
    // Lấy thông tin của người dùng hiện tại
    $userId = session('user_id');

    // Lấy tất cả thông tin thanh toán của người dùng từ bảng payments
    $payments = \DB::table('payments')->where('user_id', $userId)->get();

    return view('frontend.users.payment', compact('payments'));
}

}
