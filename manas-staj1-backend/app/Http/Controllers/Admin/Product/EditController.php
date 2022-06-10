<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class EditController extends Controller
{
    public function __invoke(Product $product){
        return response($product)
        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
}
