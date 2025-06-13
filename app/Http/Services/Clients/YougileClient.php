<?php

namespace App\Http\Services\Clients;

use App\Http\Services\Clients\DTO\YougileTaskDTO;
use App\Models\Order;
use Illuminate\Support\Facades\Http;

class YougileClient
{
    private string $apiKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.yougile.api_key');
        $this->baseUrl = config('services.yougile.base_url');
    }
    public function createTask(YougileTaskDTO $taskDTO): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ])->post($this->baseUrl . '/tasks', $taskDTO->getArray());

        if (!$response->successful()) {
            throw new \Exception('Ошибка создания задачи в Yougile');
        }
        $data = $response->json();

        return $data['id'];
    }

    public function deleteTask(Order $order): true
    {
        $taskId = Order::query()->where('id', $order->id)->value('yougile_task_id');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json'
        ])->post($this->baseUrl . "/tasks/{$taskId}");

        if (!$response->successful()) {
            throw new \Exception("Ошибка удаления задачи");
        }

        return true;
    }
}
