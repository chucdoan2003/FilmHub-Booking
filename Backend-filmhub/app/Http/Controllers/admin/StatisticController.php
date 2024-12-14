<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Showtime;
use App\Models\Theater;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    const PATH_VIEW = "admin.statistics.";
    // thống kê doanh thu toàn hệ thống
    public function statisticFilmHub()
    {
        $theater_id = session('theater_id'); // Lấy theater_id từ session
        // dd($theater_id);
        if(!$theater_id){
            // Truy vấn và tính toán doanh thu cho từng phim trong từng rạp và số lượng phim trong rạp
            $result = DB::table('theaters')
            ->join('showtimes', 'theaters.theater_id', '=', 'showtimes.theater_id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
            ->join('tickets', 'showtimes.showtime_id', '=', 'tickets.showtime_id')
            ->select(
                'theaters.theater_id as theater_id',
                'theaters.name as theater_name',
                DB::raw('COUNT(DISTINCT movies.movie_id) as movie_count'), // Số lượng phim trong rạp
                DB::raw('SUM(tickets.total_price) as total_revenue')
            )
            ->groupBy('theaters.theater_id')
            ->get();
            // Tính tổng doanh thu của toàn bộ hệ thống
            $totalRevenue = $result->sum('total_revenue');

        
            // Tính tổng số lượng rạp và số lượng phim có xuất chiếu
            $totalTheaters = DB::table('theaters')
            ->join('showtimes', 'theaters.theater_id', '=', 'showtimes.theater_id')
            ->distinct()
            ->count('theaters.theater_id');

            $totalMovies = DB::table('movies')
            ->join('showtimes', 'movies.movie_id', '=', 'showtimes.movie_id')
            ->distinct()
            ->count('movies.movie_id');
            return view(self::PATH_VIEW . 'statisticFilmHub', compact('result', 'totalRevenue', 'totalTheaters', 'totalMovies'));
        } 
        else{
            $theater = DB::table('theaters')->where('theater_id', $theater_id)->first();
            $result = DB::table('theaters')
            ->join('showtimes', 'theaters.theater_id', '=', 'showtimes.theater_id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
            ->join('tickets', 'showtimes.showtime_id', '=', 'tickets.showtime_id')
            ->where('theaters.theater_id', $theater_id) // Chỉ lấy dữ liệu cho rạp của user
            ->select(
                'theaters.theater_id as theater_id',
                'theaters.name as theater_name',
                DB::raw('COUNT(DISTINCT movies.movie_id) as movie_count'),
                DB::raw('SUM(tickets.total_price) as total_revenue')
            )
            ->groupBy('theaters.theater_id')
            ->get();

            $totalRevenue = $result->sum('total_revenue');
            $totalMovies = DB::table('movies')
                ->join('showtimes', 'movies.movie_id', '=', 'showtimes.movie_id')
                ->where('showtimes.theater_id', $theater_id)
                ->distinct()
                ->count('movies.movie_id'); 
            // Trả về view với dữ liệu
            return view(self::PATH_VIEW . 'statisticFilmHubManager', compact('result', 'totalRevenue', 'totalMovies', 'theater'));
        }

    }

    //thống kê doanh thu từng rạp
    public function statisticTheater(Request $request, $theater_id)
{
    $theater = DB::table('theaters')->where('theater_id', $theater_id)->first();
    // Lấy danh sách các phim tại rạp này
    $movies = DB::table('movies')
        ->join('showtimes', 'movies.movie_id', '=', 'showtimes.movie_id')
        ->join('theaters', 'showtimes.theater_id', '=', 'theaters.theater_id')
        ->leftJoin('tickets', 'showtimes.showtime_id', '=', 'tickets.showtime_id')
        ->where('showtimes.theater_id', $theater_id)
        ->select(
            'movies.movie_id as movie_id',
            'movies.title as movie_name',
            'showtimes.theater_id as theater_id',
            DB::raw('COUNT(DISTINCT showtimes.showtime_id) as show_count'), // Số lượng suất chiếu
            DB::raw('COUNT(tickets.ticket_id) as ticket_count'), // Số lượng vé đã bán
            DB::raw('SUM(tickets.total_price) as total_revenue') // Tổng doanh thu
        )
        ->groupBy('movies.movie_id', 'showtimes.theater_id')
        ->get();
         // Tính toán tổng số lượng phim, suất chiếu, vé và doanh thu
        $totalMoviesCount = $movies->count();
        $totalShowtimesCount = $movies->sum('show_count');
        $totalTicketsCount = $movies->sum('ticket_count');
        $totalRevenue = $movies->sum('total_revenue');
        // Lọc 
        if($request->datetime){
            $movies = DB::table('movies')
                ->join('showtimes', 'movies.movie_id', '=', 'showtimes.movie_id')
                ->join('theaters', 'showtimes.theater_id', '=', 'theaters.theater_id')
                ->leftJoin('tickets', 'showtimes.showtime_id', '=', 'tickets.showtime_id')
                ->where('showtimes.theater_id', $theater_id)
                ->where('showtimes.datetime', $request->datetime)
                ->select(
                    'movies.movie_id as movie_id',
                    'movies.title as movie_name',
                    'showtimes.theater_id as theater_id',
                    DB::raw('COUNT(DISTINCT showtimes.showtime_id) as show_count'), // Số lượng suất chiếu
                    DB::raw('COUNT(tickets.ticket_id) as ticket_count'), // Số lượng vé đã bán
                    DB::raw('SUM(tickets.total_price) as total_revenue') // Tổng doanh thu
                )
                ->groupBy('movies.movie_id', 'showtimes.theater_id')
                ->get();
                // Tính toán tổng số lượng phim, suất chiếu, vé và doanh thu
                $totalMoviesCount = $movies->count();
                $totalShowtimesCount = $movies->sum('show_count');
                $totalTicketsCount = $movies->sum('ticket_count');
                $totalRevenue = $movies->sum('total_revenue');
            return view(self::PATH_VIEW . 'statisticTheater', compact('movies', 'theater', 'totalMoviesCount', 'totalShowtimesCount', 'totalTicketsCount', 'totalRevenue'));
        }
        // Trả về view với dữ liệu
        return view(self::PATH_VIEW . 'statisticTheater', compact('movies', 'theater', 'totalMoviesCount', 'totalShowtimesCount', 'totalTicketsCount', 'totalRevenue'));
}
// thống kê doanh thu từng phim trong rạp
public function statisticFilmTheater(Request $request, $theater_id, $movie_id)
{   
    $movie = DB::table('movies')->where('movie_id', $movie_id)->first();

    // Lấy danh sách các ca chiếu tại rạp này và cho phim này
    $showtimes = DB::table('showtimes')
        ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id') // Join với bảng shift
        ->where('showtimes.theater_id', $theater_id)
        ->where('movies.movie_id', $movie_id)
        ->select(
            'showtimes.showtime_id as showtime_id',
            'shifts.shift_name as shift_name',
            'shifts.start_time as start_time',
            'shifts.end_time as end_time',
            'showtimes.datetime as showtime_date',
            DB::raw('COUNT(tickets.ticket_id) as ticket_count'), // Số lượng vé đã bán
            DB::raw('SUM(tickets.total_price) as total_revenue') // Tổng doanh thu từ vé
        )
        ->leftJoin('tickets', 'showtimes.showtime_id', '=', 'tickets.showtime_id') // Join với bảng tickets
        ->groupBy('showtimes.showtime_id', 'shifts.start_time', 'shifts.end_time', 'showtimes.datetime', 'movies.movie_id')
        ->get();
        // Lọc
        if ($request->datetime) {
            $showtimes = DB::table('showtimes')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
            ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id') // Join với bảng shift
            ->where('showtimes.theater_id', $theater_id)
            ->where('showtimes.datetime', $request->datetime)
            ->where('movies.movie_id', $movie_id)
            ->select(
                'showtimes.showtime_id as showtime_id',
                'shifts.shift_name as shift_name',
                'shifts.start_time as start_time',
                'shifts.end_time as end_time',
                'showtimes.datetime as showtime_date',
                DB::raw('COUNT(tickets.ticket_id) as ticket_count'), // Số lượng vé đã bán
                DB::raw('SUM(tickets.total_price) as total_revenue') // Tổng doanh thu từ vé
            )
            ->leftJoin('tickets', 'showtimes.showtime_id', '=', 'tickets.showtime_id') // Join với bảng tickets
            ->groupBy('showtimes.showtime_id', 'shifts.start_time', 'shifts.end_time', 'showtimes.datetime', 'movies.movie_id')
            ->get();
            return view('admin.statistics.statisticFilmTheater', compact('showtimes', 'theater_id', 'movie'));

         }

    // Thực hiện truy vấn
    // $showtimes = $query->get();
    // Trả về view với dữ liệu
    return view('admin.statistics.statisticFilmTheater', compact('showtimes', 'theater_id', 'movie'));
  

}
// biều đổ cột thống kê hệ thống
public function statisticFilmHubData()
{
    $currentYear = Carbon::now()->year;
    $result = DB::table('theaters')
        ->join('showtimes', 'theaters.theater_id', '=', 'showtimes.theater_id')
        ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
        ->join('tickets', 'showtimes.showtime_id', '=', 'tickets.showtime_id')
        ->select(
            'theaters.name as theater_name',
            DB::raw('MONTH(showtimes.datetime) as month'),
            DB::raw('SUM(tickets.total_price) as total_revenue')
        )
        ->whereYear('showtimes.datetime', $currentYear)
        ->groupBy('theaters.theater_id', 'month')
        ->get();

    // Tính tổng doanh thu cho mỗi tháng
    $monthlyRevenue = [];
    foreach ($result as $item) {
        $monthlyRevenue[$item->month] = ($monthlyRevenue[$item->month] ?? 0) + $item->total_revenue;
    }

    // Đảm bảo có đủ 12 tháng
    $revenues = [];
    for ($i = 1; $i <= 12; $i++) {
        $revenues[$i] = $monthlyRevenue[$i] ?? 0;
    }

    return response()->json([
        'months' => array_keys($revenues),
        'revenues' => array_values($revenues),
    ]);
}
// biểu đồ tròn thống kê hệ thống
public function statisticTheaterData()
{
    $result = DB::table('theaters')
        ->join('showtimes', 'theaters.theater_id', '=', 'showtimes.theater_id')
        ->join('tickets', 'showtimes.showtime_id', '=', 'tickets.showtime_id')
        ->select(
            'theaters.name as theater_name',
            DB::raw('SUM(tickets.total_price) as total_revenue')
        )
        ->groupBy('theaters.theater_id')
        ->get();

    return response()->json($result);
}
// thống kê phim
public function statisticFilm(Request $request)
{
    // Lấy dữ liệu trực tiếp từ cơ sở dữ liệu
    $results = DB::table('tickets')
        ->join('showtimes', 'tickets.showtime_id', '=', 'showtimes.showtime_id')
        ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
        ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id')
        ->select(
            'movies.title as movie_name',
            'shifts.shift_name as shift_name',
            'shifts.start_time as start_time',
            'shifts.end_time as end_time',
            'showtimes.datetime as datetime',
            DB::raw('COUNT(tickets.ticket_id) as ticket_count'),
            DB::raw('SUM(tickets.total_price) as total_revenue')
        )
        ->groupBy('showtimes.showtime_id', 'movies.title', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'showtimes.datetime')
        ->get();
        if($request->datetime){
            $results = DB::table('tickets')
            ->join('showtimes', 'tickets.showtime_id', '=', 'showtimes.showtime_id')
            ->join('movies', 'showtimes.movie_id', '=', 'movies.movie_id')
            ->join('shifts', 'showtimes.shift_id', '=', 'shifts.shift_id')
            ->where('showtimes.datetime', $request->datetime)
            ->select(
                'movies.title as movie_name',
                'shifts.shift_name as shift_name',
                'shifts.start_time as start_time',
                'shifts.end_time as end_time',
                'showtimes.datetime as datetime',
                DB::raw('COUNT(tickets.ticket_id) as ticket_count'),
                DB::raw('SUM(tickets.total_price) as total_revenue')
            )
            ->groupBy('showtimes.showtime_id', 'movies.title', 'shifts.shift_name', 'shifts.start_time', 'shifts.end_time', 'showtimes.datetime')
            ->get();
            return view('admin.statistics.statisticFilm', compact('results'));

        }
            // dd($results);
    // Trả về view với dữ liệu thống kê
    return view('admin.statistics.statisticFilm', compact('results'));
}
}
