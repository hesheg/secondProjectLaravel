<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function getCatalog()
    {
        $products = Product::all();

        return view('catalogPage', ['products' => $products]);
    }

    public function getProduct()
    {

    }
}
