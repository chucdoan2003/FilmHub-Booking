<?php

namespace App\Console\Commands;

use App\Models\SelectedSeat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteUnpaidSeats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seats:delete-unpaid';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Xóa ghế chưa thanh toán sau 5 phút';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredTime = Carbon::now()->subMinutes(5);
        SelectedSeat::where('created_at', '<', $expiredTime)->delete();
        $this->info('Ghế chưa thanh toán đã được xóa.');
    }
}
