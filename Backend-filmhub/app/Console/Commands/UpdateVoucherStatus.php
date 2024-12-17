<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateVoucherStatus extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vouchers:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of expired vouchers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         // Cập nhật trạng thái cho các voucher đã hết hạn
         DB::table('vourcher_event')
         ->where('end_time', '<', Carbon::now());
        //  ->update(['is_active' => 0]);

     $this->info('Voucher statuses updated successfully.');
    }
}
