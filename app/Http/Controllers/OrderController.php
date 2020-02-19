<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Menu;
use App\Models\Order;
use App\Helper\TimeHelper;
use App\Helper\CurrencyHelper;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Events\SendFlashMessageEvent;
use App\Events\Orders\UpdateOrderEvent;
use App\Http\Requests\Orders\OrderRequest;
use App\Events\Orders\NewOrderCreationEvent;

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
                        ->paginate(10);

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
     * @param  \App\Http\Requests\Orders\OrderRequest  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $order = event(new NewOrderCreationEvent($request))[0];

        Log::info("Order #$order->id has been successfully created.");

        return redirect()->route('menu.create', [
            'order' => $order
        ]);
    }

    /**
     * Update the specified Order created by Auth::user() in storage.
     *
     * @param  \App\Http\Requests\Orders\OrderRequest  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request)
    {
        $order = Order::findOrFail($request->input("id"));

        if(Auth::user()->id != $order->user_id)
            return redirect()->route('manage.orders.index');

        event(new UpdateOrderEvent($request));

        Log::info("Order #".$request->input('id')." has been successfully updated.");

        return redirect()->route('manage.orders.index');
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
            return redirect()->route('manage.orders.index');

        $order->update([
            'closed' => 1
        ]);

        Log::info("Order #$order->id has been successfully closed.");

        event(new SendFlashMessageEvent('success', trans('session.management.closed')));

        return redirect()->route('manage.orders.index');
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
            return redirect()->route('manage.orders.index');

        $id = $order->id;

        $order->delete();

        Menu::where('order_id', $id)->delete();

        Log::info("Order #$id has been successfully deleted.");

        event(new SendFlashMessageEvent('success', trans('session.management.order.destroyed')));

        return redirect()->route('manage.orders.index');
    }
}
