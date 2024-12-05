<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    const PATH_VIEW = "admin.statistics.";
    public function index()
    {
        // Lấy danh sách phim để hiển thị trong form
        $movies = Movie::all();
        return view(self::PATH_VIEW.__FUNCTION__, compact('movies'));
    }

    public function show(Request $request)
{
    $request->validate([
        'movie_id' => 'required|exists:movies,movie_id',
        'month' => 'required|date_format:Y-m', // Kiểm tra định dạng tháng
    ]);

    // Lấy tháng đã chọn
    $selectedMonth = Carbon::createFromFormat('Y-m', $request->month);

    // Lấy thống kê từ bảng tickets
    $statistics = Ticket::with('showtime.movie') // Eager load showtime và movie
        ->whereHas('showtime', function ($query) use ($request, $selectedMonth) {
            $query->where('movie_id', $request->movie_id)
                  ->whereYear('datetime', $selectedMonth->year) // Sử dụng datetime
                  ->whereMonth('datetime', $selectedMonth->month); // Sử dụng datetime
        })
        ->selectRaw('showtime_id, SUM(total_price) as total_revenue, COUNT(ticket_id) as total_tickets')
        ->groupBy('showtime_id') // Nhóm theo showtime_id
        ->first();

    // Kiểm tra nếu không có thống kê nào
    if (!$statistics) {
        return redirect()->route('admin.statistics.index')->with('error', 'Không có dữ liệu thống kê.');
    }

    return view(self::PATH_VIEW . __FUNCTION__, compact('statistics', 'selectedMonth'));
}
}
