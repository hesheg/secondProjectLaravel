<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrderForm()
    {
        return view('orderForm');
    }

    public function createOrder()
    {

        return redirect()->route('user-order');
    }

    public function getAllOrders()
    {

    }
}
