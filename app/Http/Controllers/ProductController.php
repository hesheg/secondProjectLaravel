<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\Translation\t;

class ProductController extends Controller
{
    public function getCatalog()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $userProduct = UserProduct::query()
                ->where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            if ($userProduct) {
                $product->amount = $userProduct->amount;
            } else {
                $product->amount = 0;
            }
        }
//        dd($products);

        return view('catalogPage', ['products' => $products]);
    }

    public function getProduct(Product $product)
    {
        $reviews = $product->reviews()->with('user')->get();
        $count = $reviews->count();
        $ratingTotal = 0;

        if ($count === 0) {
            $ratingTotal += 0;
        } else {
            $rating = 0;

            foreach ($reviews as $review) {
                $rating += $review->rating;
                $ratingTotal = round($rating / $count, 1);
            }
        }

        $result = false;
        $userOrders = Order::query()->with('orderProducts')->where('user_id', Auth::id())->get();

        foreach ($userOrders as $userOrder) {
            foreach ($userOrder->orderProducts as $orderProduct) {
                if ($orderProduct->product_id === $product->id) {
                    $result = true;
                }
            }
        }

        return view('reviewForm', [
            'product' => $product,
            'count' => $count,
            'reviews' => $reviews,
            'result' => $result,
            'ratingTotal' => $ratingTotal
        ]);
    }

    public function addReview(ReviewRequest $request)
    {
        Review::query()->create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return redirect()->route('catalog')->with('success', 'Отзыв успешно отправлен');
    }
}
