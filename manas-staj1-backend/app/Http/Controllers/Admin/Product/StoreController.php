<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StoreController extends Controller
{
    public function __invoke(Request $request){
        $data = $request->validate([
            'name' => '',
            'price' => '',
            'count' => '',
            'photoLink' => '',
            'description' => '',
            'type' => ''
        ]);
        Product::create($data);
        $products = Product::all();
        return response($products)
        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));

    }
}
