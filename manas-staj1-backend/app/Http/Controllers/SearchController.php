<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function __invoke(Request $request){
        $data = $request->validate([
            'name' => '',
            'categoryId' => ''
        ]);

        $products = [];
        // dd($data);
        if(array_key_exists('name', $data) == false){
            $products = Product::all();
            return response($products)
        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
        }
        if($data['categoryId'] == 1){
            $datas = Product::all();
            foreach($datas as $item){
                if(str_contains(strtolower($item->name), strtolower($data['name']))){
                   array_push($products, $item);
                }
            }
        }
        else{
            $datas = Product::where('type', (int)$data['categoryId'])->get();
            foreach($datas as $item){
                if(str_contains(strtolower($item->name), strtolower($data['name']))){
                   array_push($products, $item);
                }
            }
        }


        return response($products)
        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
}
