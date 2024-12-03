<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Movie;
use Carbon\Carbon;

class UpdateMovieStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật trạng thái phim từ "Sắp ra mắt" sang "Đang phát hành" nếu ngày phát hành trùng với ngày hiện tại';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // Lấy các phim có trạng thái "Sắp ra mắt" và ngày phát hành là hôm nay
        $movies = Movie::where('status', 'Sắp ra mắt')
            ->where('release_date', $today)
            ->get();

        foreach ($movies as $movie) {
            $movie->status = 'Đang phát hành';
            $movie->save();
            $this->info('Đã cập nhật trạng thái cho phim: ' . $movie->title);
        }

        $this->info('Cập nhật trạng thái phim hoàn tất.');
    }
}
