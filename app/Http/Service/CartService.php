<?php

namespace App\Http\Service;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\DecreaseProductRequest;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function add(AddProductRequest $request)
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
            $userProduct = UserProduct::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'amount' => $amount
            ]);
        }

        return [
            'amount' => $userProduct->amount,
            'product_id' => $productId
        ];
    }

    public function decrease(DecreaseProductRequest $request)
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

                return [
                    'product_id' => $productId,
                    'amount' => 0
                ];
            } else {
                $userProduct->amount -= $amount;
                $userProduct->save();

                return [
                    'product_id' => $productId,
                    'amount' => $userProduct->amount
                ];
            }
        } else {
            return ['message' => 'Товар не найден в корзине'];
        }
    }
}
