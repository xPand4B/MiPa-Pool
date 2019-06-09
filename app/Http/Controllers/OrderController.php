<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\StoreNewOrderRequest;
use App\Events\Orders\NewOrderHasBeenCreatedEvent;
use App\Events\Orders\NewMenuHasBeenCreatedEvent;
use App\Http\Requests\Orders\StoreNewMenuRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;

class OrderController extends Controller
{
    /**
     * Restrict access
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::NotClosed()
                        ->orderBy('id', 'desc')
                        ->paginate(15);

        for($i = 0; $i < sizeof($orders); $i++){
            $orders[$i] = $this->formatCurrency($orders[$i]);

            $orders[$i]->timeLeft_min = Carbon::now()->diffInMinutes($orders[$i]->deadline);
            $orders[$i]->timeLeft     = Carbon::now()->diffForHumans($orders[$i]->deadline, true, true, 3);

            // If deadline is in past
            if(Carbon::now()->greaterThan($orders[$i]->deadline)){
                Order::findOrFail($orders[$i]->id)
                    ->update(['closed' => true]);
            }
        }

        return view('pages.orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $range = range(strtotime("00:00"), strtotime("24:00"), 15 * 60);
        $current = date("H:i");

        $timesteps = [];
        foreach($range as $step){
            $temp = date("H:i", $step);

            if($temp > $current)
                array_push($timesteps, $temp);
        }
        
        return view('pages.orders.create', [
            'timesteps' => $timesteps
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Orders\StoreNewOrderRequest  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewOrderRequest $request)
    {
        $orderID = event(new NewOrderHasBeenCreatedEvent($request))[0];

        return redirect()->route('order.participate', [
            'id' => $orderID
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * 
     * @return \Illuminate\Http\Response
     */
    public function participate(Order $order)
    {
        if($order->closed)
            return redirect()->back();

        $order = $this->formatCurrency($order);

        $order->timeLeft_min = Carbon::now()->diffInMinutes($order->deadline);

        $order->deadline = date("H:i", strtotime($order->deadline));
        
        return view('pages.orders.participate', [
            'order' => $order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Orders\StoreNewMenuRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeParticipate(StoreNewMenuRequest $request)
    {
        event(new NewMenuHasBeenCreatedEvent($request));

        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * Formats currency to a more viewable format.
     *
     * @param \App\Order $order
     *
     * @return \App\Order
     */
    private function formatCurrency(Order $order): Order
    {
        $sum = 0;

        for($j = 0; $j < sizeof($order->menus); $j++){
            $price = $order->menus[$j]->price * 0.01;
            $sum  += $price;

            if($price < 10)
                $price = '0'.$price;
            
            if(strlen($price) == 4)
                $price = $price.'0';

            if(strlen($price) == 2)
                $price = $price.'.00';

            // $order->menus[$j]->price = str_replace('.', ',', $price);
            $order->menus[$j]->price = $price;
        }

        if($sum < 10)
            $sum = '0'.$sum;
        
        if(strlen($sum) == 4){
            $sum = $sum.'0';

        }else if(strlen($sum) == 2){
            $sum = $sum.'.00';
        }

        // $order->sum = str_replace('.', ',', $sum);
        $order->sum = $sum;

        return $order;
    }
}
