<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\UserOrder;
use App\Models\User;
use App\Models\Product;

class OrderController extends Controller
{
    private static $order_id = 1;
    public function __invoke(Request $request){
        $orders_a = $request->validate([
            'orders' => '',
            'price' => ''
        ]);
        $orders = $orders_a['orders'];
        $user = User::where('password', $request->header()['token'][0])->get();
        $all_orders = UserOrder::withTrashed()->get();
        // return response(['message' => $orders_a['orders']])
        //         ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        //         ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
        if(count($all_orders)){
            $id = count($all_orders)+1;
        }
        else{
            $id = 1;
        }


        foreach($orders as $order){
            $product = Product::where('id', $order['product_id'])->get();
            if($product[0]->count - $order['count'] < 0){
                return response(['message' => 'not enough quantity', 'product_name' => $product[0]->name])
                ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
                $o = Order::where('group_id', $id)->get();
                foreach($o as $g){
                    $g->forceDelete();
                }
            }
            else{
                $product[0]->update([
                    'count' => $product[0]->count-$order['count'],
                    'frequency' => $product[0]->frequency+1
                ]);
            }
            Order::create([
                'group_id' => $id,
                'product_id' => $order['product_id'],
                'count' => $order['count']
            ]);
        }
        UserOrder::create([
            'group_id' => $id,
            'user_id' => $user[0]->id,
            'price' => $orders_a['price'],
        ]);
        return response(['message' => 'success'])
                ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
}
