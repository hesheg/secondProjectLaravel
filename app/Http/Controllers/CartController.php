<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\DecreaseProductRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getCart()
    {
        /** @var User $user */

        $user = Auth::user();
        $products = $user->products()->get();
        echo "<pre>";
        print_r($products); die;
        return view('cartPage', ['products' => $products]);
    }

    public function addProduct(AddProductRequest $request)
    {
        $data = $request->only('product_id', 'amount');


    }

    public function decreaseProduct(DecreaseProductRequest $request)
    {
    }
}
