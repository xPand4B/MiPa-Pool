<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Menu;
use App\Helper\CurrencyHelper;
use App\Http\Controllers\Controller;
use Kyslik\ColumnSortable\Exceptions\ColumnSortableException;

class MenuManagementController extends Controller
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
            $menus  = Menu::FromUser(Auth::user()->id)->get();
                        // ->paginate(15);

        } catch (ColumnSortableException $e) {
            return redirect()->back();
        }

        if(sizeof($menus) == 0)
            return redirect()->route('home');

        for($i = 0; $i < sizeof($menus); $i++)
            $menus[$i]->price = CurrencyHelper::Format($menus[$i]->price);

        if(! empty(request('id'))){
            $selected = Menu::FromUser(Auth::user()->id)
                                ->findOrFail(request('id'))
                                ->id;
        }

        return view('pages.manage.menus.index', [
            'menus'     => $menus,
            'selected'  => empty($selected) ? '' : 'id:'.$selected,
        ]);
    }
}
