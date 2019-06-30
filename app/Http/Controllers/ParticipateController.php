<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Helper\TimeHelper;
use App\Helper\CurrencyHelper;
use Illuminate\Support\Facades\Log;
use App\Events\Orders\NewMenuCreationEvent;
use App\Http\Requests\Orders\StoreNewMenuRequest;

class ParticipateController extends Controller
{
    /**
     * Restrict access
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
        if($order->closed)
            return redirect()->route('home');

        $order = CurrencyHelper::getSum($order);
        $order = CurrencyHelper::formatPriceForOrder($order);

        $order->timeLeft_min = TimeHelper::GetTimeLeft($order->deadline, true);

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
        $menu = event(new NewMenuCreationEvent($request))[0];

        Log::info("Menu #$menu->id has been successfully created.");

        return redirect()->route('home');
    }
}
