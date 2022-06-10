<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\UserOrder;

class IndexController extends Controller
{
    public static $products = [];
    public function __invoke(){

        $orders = [];
        $all_orders = UserOrder::all();

        $i = 0;
        $df = [];
        foreach($all_orders as $order){
            $products = [];
            $i += 1;
            $p = Order::where('group_id', $order->group_id)->get();
            for($j = 0; $j < count($p); $j++){
                array_push($products, ['name' => $p[$j]->product->name,'count' => $p[$j]->count]);
            }
            // dump($products);
            $orders[$i] = [
                'status' => $order->status,
                'group_id' => $order->group_id,
                'user_name' => $order->user->full_name,
                'price' => $order->price,
                'orders' => $products
            ];
        }

        return response($orders)
                ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
}
