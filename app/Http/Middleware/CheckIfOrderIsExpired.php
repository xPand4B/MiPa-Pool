<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class CheckIfOrderIsExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $orders = Order::Open()->get();

        foreach($orders as $order){
            if(Carbon::now()->greaterThan($order->deadline)){
                Order::findOrFail($order->id)
                    ->update(['closed' => true]);

                Log::info("Order #$order->id is expired and has been closed.");
            }
        }

        return $next($request);
    }
}
