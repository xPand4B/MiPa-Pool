<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Menu;
use App\Models\Order;
use App\Helper\TimeHelper;
use App\Helper\CurrencyHelper;
use Illuminate\Support\Facades\Log;
use App\Events\Menus\UpdateMenuEvent;
use App\Events\SendFlashMessageEvent;
use App\Http\Requests\Menus\MenuRequest;
use App\Events\Orders\NewMenuCreationEvent;

class MenuController extends Controller
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
        
        return view('pages.menu.create', [
            'order' => $order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Menus\MenuRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $menu = event(new NewMenuCreationEvent($request))[0];

        Log::info("Menu #$menu->id has been successfully created.");

        return redirect()->route('home');
    }

    /**
     * Update the specified Menu created by Auth::user() in storage.
     *
     * @param  \App\Http\Requests\Menus\MenuRequest  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request)
    {
        $menu = Menu::findOrFail($request->input("id"));

        if(Auth::user()->id != $menu->user_id)
            return redirect()->route('manage.menus.index');

        event(new UpdateMenuEvent($request));

        Log::info("Menu #".$request->input('id')." has been successfully updated.");

        return redirect()->route('manage.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if(Auth::user()->id != $menu->user_id)
            return redirect()->route('manage.menus.index');

        $id = $menu->id;

        $menu->delete();

        Log::info("menu #$id has been successfully deleted.");

        event(new SendFlashMessageEvent('success', trans('session.management.menu.destroyed')));

        return redirect()->route('manage.menus.index');
    }
}
