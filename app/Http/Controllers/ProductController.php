<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::query()->orderBy('updated_at','desc')->paginate(8);
        return view('product.index',['products' => $products]);

    }

    public function show(Product $product)
    {
        return view('product.view',['product' => $product]);


    }
}
