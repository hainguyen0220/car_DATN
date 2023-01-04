<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Throwable;
use Illuminate\Support\Facades\Log;

class ResetOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:reset-order-detail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reorder overdue orders every day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            OrderDetail::where('status', Order::STATUS_BORROW)->where('date_order', '<', Carbon::now()->subDays(90))
                ->update(
                    [
                        'status' => Order::STATUS_OBSOLETE
                    ]
                );
        } catch (Throwable $e) {
            log::channel('admin_log')->error($e->getMessage());
        }
    }
}
