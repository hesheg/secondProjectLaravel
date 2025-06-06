<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Service\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }
    public function getOrderForm()
    {
        return view('orderForm');
    }

    public function createOrder(OrderRequest $request)
    {
        $this->orderService->create($request);
        return redirect()->route('catalog')->with('success', 'Ваш заказ успешно оформлен!');
    }

    public function getAllOrders()
    {
        $data = $this->orderService->getAll();
        $userOrders = $data['userOrders'];
        $orderSums = $data['orderSums'];

        return view('userOrder', [
            'orderSums' => $orderSums,
            'userOrders' => $userOrders
        ]);
    }
}
