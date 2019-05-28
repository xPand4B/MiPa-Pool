<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Menu;
use Session;

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
        $orders = Order::orderBy('id', 'desc')->paginate(15);

        for($i = 0; $i < sizeof($orders); $i++){
            
            $sum = 0;

            for($j = 0; $j < sizeof($orders[$i]->menus); $j++){
                $price = $orders[$i]->menus[$j]->price * 0.01;
                $sum  += $price;
    
                if($price < 10)
                    $price = '0'.$price;
                
                if(strlen($price) == 4)
                    $price = $price.'0';
    
                if(strlen($price) == 2)
                    $price = $price.'.00';
    
                $orders[$i]->menus[$j]->price = $price;
            }

            if($sum < 10)
                $sum = '0'.$sum;
            
            if(strlen($sum) == 4){
                $sum = $sum.'0';

            }else if(strlen($sum) == 2){
                $sum = $sum.'.00';
            }

            $orders[$i]->sum = str_replace('.', ',', $sum);
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
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_name'            => 'required|min:5|max:128',
            'deadline'              => 'required',
            'max_orders'            => 'required|integer|between:2,20',
            'minimum_order_value'   => 'required|integer|between:0,20',
            'delivery_service'      => 'required|string',
            'site_link'             => 'required|active_url'
        ]);

        $order = new Order;
            $order->user_id     = $request->user()->id;
            $order->name        = $request->order_name;
            $order->site_link   = $request->site_link;
            $order->deadline    = $request->deadline;
            $order->max_orders  = $request->max_orders;

            $order->save();

        Session::flash('success', trans('session.order.created'));

        return redirect()->route('order.participate', [
            'id' => $order->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function participate($id)
    {
        if(!ctype_digit($id))
            return redirect()->back();

        $order = Order::find($id);
        $sum   = 0;

        for($j = 0; $j < sizeof($order->menus); $j++){
            
            $price = $order->menus[$j]->price * 0.01;
            $sum  += $price;

            if($price < 10)
                $price = '0'.$price;
            
            if(strlen($price) == 4)
                $price = $price.'0';

            if(strlen($price) == 2)
                $price = $price.'.00';

            $order->menus[$j]->price = str_replace('.', ',', $price);
        }

        if($sum < 10)
            $sum = '0'.$sum;
        
        if(strlen($sum) == 4){
            $sum = $sum.'0';

        }else if(strlen($sum) == 2){
            $sum = $sum.'.00';
        }
        
        return view('pages.orders.participate', [
            'order' => $order,
            'sum'   => str_replace('.', ',', $sum)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeParticipate(Request $request)
    {
        $request->validate([
            'name'      => 'required|min:5|max:128',
            'number'    => 'required|between:1,10',
            'price'     => 'required|min:0|max:6',
            'comment'   => 'max:255'
        ]);

        $price = str_replace(',', '.', $request->price);

        if(!is_numeric($price)){
            Session::flash('error', trans('session.order.price_is_no_digit'));
            return redirect()->back();
        }

        $menu = new Menu;
            $menu->user_id  = $request->user()->id;
            $menu->order_id = $request->order_id;
            $menu->menu     = $request->name;
            $menu->number   = $request->number;
            $menu->comment  = $request->comment;
            $menu->price    = $price * 100;
            // $menu->price = 10;

            $menu->save();

        Session::flash('success', trans('session.order.participated'));

        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * 
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
     * 
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
