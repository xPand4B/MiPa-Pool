<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Order;
use App\Helper\TimeHelper;
use App\Helper\CurrencyHelper;
use App\Http\Controllers\Controller;
use Kyslik\ColumnSortable\Exceptions\ColumnSortableException;

class OrderManagementController extends Controller
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
            $orders = Order::FromUser(Auth::user()->id)->get();
                        // ->paginate(15);

        } catch (ColumnSortableException $e) {
            return redirect()->back();
        }

        if(sizeof($orders) == 0)
            return redirect()->route('home');

        for($i = 0; $i < sizeof($orders); $i++){
            $orders[$i] = CurrencyHelper::getSum($orders[$i]);
            $orders[$i] = CurrencyHelper::formatPriceForOrder($orders[$i]);

            $orders[$i]->timeLeft_min = TimeHelper::GetTimeLeft($orders[$i]->deadline, true);
            $orders[$i]->timeLeft     = TimeHelper::GetTimeLeft($orders[$i]->deadline);
        }

        if(! empty(request('id'))){
            $selected = Order::FromUser(Auth::user()->id)
                                ->findOrFail(request('id'))
                                ->id;
        }

        return view('pages.manage.orders.index', [
            'orders'    => $orders,
            'timesteps' => TimeHelper::GetTimesteps(),
            'selected'  => empty($selected) ? '' : 'id:'.$selected,
        ]);
    }
}
