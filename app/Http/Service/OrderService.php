<?php

namespace App\Http\Service;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function create(OrderRequest $request)
    {
        $userId = Auth::id();
        $userProductsWithProd = UserProduct::query()->with('product')->where('user_id', $userId)->get();

        DB::beginTransaction();
        try {
            $order = Order::query()->create([
                'contact_name' => $request->contact_name,
                'contact_phone' => $request->contact_phone,
                'comment' => $request->comment,
                'user_id' => $userId,
                'address' => $request->address
            ]);

//            throw new \Exception('test');

            foreach ($userProductsWithProd as $userProduct) {
                OrderProduct::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $userProduct->product->id,
                    'amount' => $userProduct->amount
                ]);
            }

            UserProduct::query()->where('user_id', $userId)->delete();

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
    }


    public function getAll()
    {
        $userId = Auth::id();
        $userOrders = Order::query()->with('productsWithAmount')->where('user_id', $userId)->get();
        $orderSums = [];

        foreach ($userOrders as $userOrder) {
            $orderSum = 0;
            foreach ($userOrder->productsWithAmount as $orderProduct) {
                $orderSum += $orderProduct->price * $orderProduct->pivot->amount;
            }

            $orderSums[$userOrder->id] = $orderSum;
        }

        return [
            'userOrders' => $userOrders,
            'orderSums' => $orderSums
        ];
    }
}
