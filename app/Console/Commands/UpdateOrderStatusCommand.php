<?php

namespace App\Console\Commands;

use App\Events\OrderShipmentStatusUpdate;
use App\Models\Order;
use Illuminate\Console\Command;

class UpdateOrderStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oder:update-status {status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of the order';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $order = Order::first();
        $order->status = $this->argument('status');
        $order->save();

        OrderShipmentStatusUpdate::dispatch($order, $this->argument('status'));
    }
}
