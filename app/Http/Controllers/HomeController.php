<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke():View
    {
        $products = Product::all();
        return view('product.index', [
            'products' => $products,
            'status' => $products->first()->status
        ]);
    }
}
