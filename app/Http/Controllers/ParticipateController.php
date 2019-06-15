<?php

namespace App\Http\Controllers;

use App\Events\Orders\NewMenuHasBeenCreatedEvent;
use App\Http\Requests\Orders\StoreNewMenuRequest;
use App\Helper\Currency;
use Carbon\Carbon;
use App\Order;

class ParticipateController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        if($order->closed)
            return redirect()->route('home');

        $order = Currency::getSum($order);
        $order = Currency::formatPriceForOrder($order);

        $order->timeLeft_min = Carbon::now()->diffInMinutes($order->deadline);

        $order->deadline = date("H:i", strtotime($order->deadline));
        
        return view('pages.participate.create', [
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
    public function store(StoreNewMenuRequest $request)
    {
        event(new NewMenuHasBeenCreatedEvent($request));

        return redirect()->route('home');
    }
}
