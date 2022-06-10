<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Product $product){
        $data = $request->validate([
            'name' => '',
            'price' => '',
            'count' => '',
            'photoLink' => '',
            'description' => '',
            'type' => '',
        ]);
        $product->update($data);
        $products = Product::all();
        return response($products)
        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
}
