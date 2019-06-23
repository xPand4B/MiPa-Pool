<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Helper\TimeHelper;
use Illuminate\Http\Request;
use App\Helper\CurrencyHelper;
use App\Http\Controllers\Controller;
use App\Events\Orders\NewOrderCreationEvent;
use App\Http\Requests\Orders\StoreNewOrderRequest;

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
        $orders = Order::Open()
                        ->orderBy('id', 'desc')
                        ->paginate(15);

        for($i = 0; $i < sizeof($orders); $i++){
            $orders[$i] = CurrencyHelper::getSum($orders[$i]);
            $orders[$i] = CurrencyHelper::formatPriceForOrder($orders[$i]);

            $orders[$i]->timeLeft_min = TimeHelper::GetTimeLeft($orders[$i]->deadline, true);
            $orders[$i]->timeLeft     = TimeHelper::GetTimeLeft($orders[$i]->deadline);

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
        $order = event(new NewOrderCreationEvent($request))[0];

        return redirect()->route('participate.create', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
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
     * @param  \App\Models\Order  $order
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
     * @param  \App\Models\Order  $order
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
