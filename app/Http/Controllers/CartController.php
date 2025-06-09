<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\DecreaseProductRequest;
use App\Http\Services\CartService;
use App\Models\User;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(private CartService $cartService)
    {
    }
    public function getCart()
    {
        /** @var User $user */

        $user = Auth::user();
        $products = $user->products()->get();
        $sum = 0;

        foreach ($products as $product) {
            $sum += $product->price * $product->pivot->amount;
        }

        return view('cartPage', ['products' => $products, 'sum' => $sum]);
    }

    public function addProduct(AddProductRequest $request)
    {
        $data = $this->cartService->add($request);
        $productId = $data['product_id'];
        $amount = $data['amount'];

            return response()->json([
                'amount' => $amount,
                'product_id' => $productId
            ]);
    }

    public function decreaseProduct(DecreaseProductRequest $request)
    {
        $data = $this->cartService->decrease($request);
        $productId = $data['product_id'];
        $amount = $data['amount'];

        return response()->json([
            'product_id' => $productId,
            'amount' => $amount
        ]);
    }
}
