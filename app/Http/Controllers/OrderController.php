<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\User;

use Session;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(15);
        
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
        $range = range(strtotime("08:00"), strtotime("20:00"), 15 * 60);
        $current = date("H:i");

        $timesteps = [];
        foreach($range as $step){
            $temp = date("H:i", $step);

            if($temp > $current){
                array_push($timesteps, $temp);
            }
        }
        
        return view('pages.orders.create', [
            'timesteps' => $timesteps
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'order_name'            => 'required|min:5|max:128',
        //     'deadline'              => 'required',
        //     'max_orders'            => 'required|integer|between:2,20',
        //     'minimum_order_value'   => 'required|integer|between:0,20',
        //     'delivery_service'      => 'required|string',
        //     'site_link'             => 'required|active_url'
        // ]);

        $order = new Order;
            $order->user_id = $request->user()->id;
            $order->name = $request->order_name;
            $order->site_link = $request->site_link;
            $order->deadline = $request->deadline;
            $order->max_orders = $request->max_orders;

            $order->save();

        Session::flash('success', 'Order created');

        return redirect()->route('order.participate', [
            'id' => $order->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        return view('pages.orders.participate', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
