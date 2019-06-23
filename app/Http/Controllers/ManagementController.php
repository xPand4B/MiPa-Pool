<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Order;
use App\Helper\TimeHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\SendFlashMessageEvent;
use Kyslik\ColumnSortable\Exceptions\ColumnSortableException;

class ManagementController extends Controller
{
    /**
     * Restrict access
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of all Orders created by Auth::user().
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $orders = Order::FromUser(Auth::user()->id)
                        ->paginate(15);
        } catch (ColumnSortableException $e) {
            return redirect()->back();
        }

        return view('pages.manage.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Display the specified Order created by Auth::user().
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if(Auth::user()->id != $order->user_id)
            return redirect()->route('manage.index');

        $order->timeLeft_min = TimeHelper::GetTimeLeft($order->deadline, true);
        $order->timeLeft     = TimeHelper::GetTimeLeft($order->deadline);

        return view('pages.manage.show', compact([
            'order'
        ]));
    }

    /**
     * Show the form for editing the specified Order created by Auth::user().
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if(Auth::user()->id != $order->user_id)
            return redirect()->route('manage.index');

        return view('pages.manage.edit', compact([
            'order'
        ]));
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
        return redirect()->route('manage.edit');
    }

    /**
     * Close the specified Order created by Auth::user() in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function close(Request $request, Order $order)
    {
        //
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

        $order->delete();

        event(new SendFlashMessageEvent('success', trans('session.management.destroyed')));

        return redirect()->route('manage.index');
    }
}
