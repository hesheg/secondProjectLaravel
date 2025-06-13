<?php

namespace App\Console\Commands;

use App\Http\Services\Clients\YougileClient;
use App\Jobs\SendHttpRequest;
use App\Models\Order;
use Illuminate\Console\Command;
use League\Uri\Http;

class OrderWithoutTaskId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:order-without-task-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $orders = Order::query()
            ->where('yougile_task_id', null)
            ->orWhere('yougile_task_id', '')
            ->get();

        foreach ($orders as $order) {
            SendHttpRequest::dispatch($order->id);
        }

        $this->info('Команда выполнена');
    }
}
