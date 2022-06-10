<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class TopFiveController extends Controller
{
    public function __invoke(){
        $top_five = Product::orderBy('frequency', 'DESC')->get()->take(5);
        return response($top_five)
        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
}
