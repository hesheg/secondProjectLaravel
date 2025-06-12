<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendHttpRequest implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected int $orderId;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
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
            $order = Order::with('products')->find($this->orderId);

            if (!$order) {
                throw new \Exception("Order not found");
            }

            $description = "Имя: {$order->contact_name} <br>"
                . "Номер телефона: {$order->contact_phone} <br>"
                . "Адрес: {$order->address} <br>"
                . "Комментарий: {$order->comment} <br>";

            foreach ($order->products as $product) {
                $description .= "ID продукта: $product->id <br>"
                    . "Наименование $product->name " . " - " . $product->pivot->amount . "шт <br>";
            }

            $apiKey = 'Bearer 1eEbd5XqGHSElKp5FpMSqFi+gl122Vq0NRg96Oe9Sv+KnIC5KYPLeN4Ur149nGBf';
            $baseUrl = 'https://yougile.com/api-v2/tasks';

            $responce = Http::withHeaders([
                'Authorization' => $apiKey,
                'Content-Type' => 'application/json'
            ])->post($baseUrl, [
                'title' => "Заказ №{$this->orderId}",
                'columnId' => 'a3f15733-feb0-4770-ac0c-059c84773c1c',
                'description' => $description,
                'completed' => false
            ])->throw()->json();

        } catch (\Throwable $exception) {
            Log::error('SendHttpRequest failed: ' . $exception->getMessage(), [
                'exception' => $exception,
            ]);

            throw $exception;
        }
    }
}
