<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\DecreaseProductRequest;
use App\Models\User;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
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
        $userId = Auth::id();
        $productId = $request->product_id;
        $amount = $request->amount;

        $userProduct = UserProduct::query()
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($userProduct) {
            $userProduct->amount += $amount;
            $userProduct->save();
        } else {
            UserProduct::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'amount' => $amount
            ]);
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }

    public function decreaseProduct(DecreaseProductRequest $request)
    {
        $userId = Auth::id();
        $productId = $request->product_id;
        $amount = $request->amount;

        $userProduct = UserProduct::query()
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($userProduct) {
            if ($userProduct->amount === 1) {
                $userProduct->delete();
            } else {
                $userProduct->amount -= $amount;
                $userProduct->save();
            }
        } else {
            return response()->json(['message' => 'Товар не найден в корзине'], 404);
        }

        return redirect($_SERVER['HTTP_REFERER']);
    }
}
