<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserOrder;

class StatusController extends Controller
{
    public function __invoke(UserOrder $order){
        $order->update([
            'status' => 'ready'
        ]);
        return response(['message' => 'success'])
                ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));

    }
}
