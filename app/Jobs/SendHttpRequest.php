<?php

namespace App\Jobs;

use App\Http\Services\Clients\DTO\YougileTaskDTO;
use App\Http\Services\Clients\YougileClient;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendHttpRequest implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected int $orderId;
    protected YougileClient $yougileClient;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
        $this->yougileClient = new YougileClient();
    }

    /**
     * Create a new job instance.
     */

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $taskDTO = new YougileTaskDTO(
                "Зазаз №{$this->orderId}",
                'a3f15733-feb0-4770-ac0c-059c84773c1c',
                $this->getBody());
            $taskId = $this->yougileClient->createTask($taskDTO);

            $order = Order::query()->find($this->orderId);

            if ($order) {
                $order->yougile_task_id = $taskId;
                $order->save();
            }
        } catch (\Throwable $exception) {
            Log::error('SendHttpRequest failed: ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);

            throw $exception;
        }
    }

    public function getBody()
    {
        $order = Order::with('products')->find($this->orderId);

        if (!$order) {
            throw new \Exception("Order not found");
        }

        $description = "Имя: {$order->contact_name} <br>"
            . "Номер телефона: {$order->contact_phone} <br>"
            . "Адрес: {$order->address} <br>"
            . "Комментарий: {$order->comment} <br>"
            . "<br>";

        foreach ($order->products as $product) {
            $description .= "ID продукта: $product->id <br>"
                . "Наименование: $product->name <br>"
                . "Количество: " . $product->pivot->amount . "шт <br>"
                . "<br>";
        }

        return $description;
    }
}
