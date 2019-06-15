<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $search = request('q');

        if(! isset($search))
            return redirect()->route('home');

        $users  = User::searchFor($search)->paginate(20);

        $menus  = Menu::searchFor($search)->paginate(20);

        $orders = Order::search($search)
                        ->Open()
                        ->paginate(15);

        return view('pages.search.show', compact([
            'search', 'users', 'menus', 'orders'
        ]));
    }
}
