<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class OrderStatusController extends Controller
{
    public function __invoke(Request $request){
        if(array_key_exists('token', $request->header())){
            $user = User::where('password', $request->header()['token'][0])->get();
            $orders = $user[0]->userorder;
            $all_orders = [];
            $i = 0;
            foreach($orders as $order){
                $i += 1;
                $products = [];
                $j = 0;
                // return response($order)
                // ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                // ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
                $o = Order::where('group_id', $order['group_id'])->get();

                foreach($o as $p){
                    $j += 1;
                    $products[$j] = [
                        'name' => $p->product->name,
                        'count' => $p->count
                    ];
                }
                $all_orders[$i] = [
                    'status' => $order['status'],
                    'orders' => $products,
                ];
            }
            return response($all_orders)
                ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
        }
        else{
            $user = 0;
        }
    }
}
