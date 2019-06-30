<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Order;
use App\Helper\TimeHelper;
use Illuminate\Http\Request;
use App\Helper\CurrencyHelper;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Events\SendFlashMessageEvent;
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
        return view('pages.orders.create', [
            'timesteps' => TimeHelper::GetTimesteps()
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

        Log::info("Order #$order->id has been successfully created.");

        return redirect()->route('participate.create', [
            'order' => $order
        ]);
    }

    /**
     * Update the specified Order created by Auth::user() in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // event(new);

        // Log::info("Order #$order->id has been successfully updated.");

        return redirect()->route('manage.index');
    }

    /**
     * Close the specified Order created by Auth::user() in storage.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function close(Order $order)
    {
        if(Auth::user()->id != $order->user_id)
            return redirect()->route('manage.index');

        $order->update([
            'closed' => 1
        ]);

        Log::info("Order #$order->id has been successfully closed.");

        event(new SendFlashMessageEvent('success', trans('session.management.closed')));

        return redirect()->route('manage.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if(Auth::user()->id != $order->user_id)
            return redirect()->route('manage.index');

        $id = $order->id;

        $order->delete();

        Log::info("Order #$id has been successfully deleted.");

        event(new SendFlashMessageEvent('success', trans('session.management.destroyed')));

        return redirect()->route('manage.index');
    }
}
