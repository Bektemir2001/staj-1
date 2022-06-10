<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserOrder;
use App\Models\Order;

class DeleteController extends Controller
{
    public function __invoke(UserOrder $order){
        $ord = Order::where('group_id', $order->group_id)->get();
        foreach($ord as $o){
            $o->delete();
        }
        $order->delete();

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
