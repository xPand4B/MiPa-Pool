<?php

namespace MiPaPo\Core\Components\Common\Http\Controllers;

use Illuminate\View\View;

class AppController extends Controller
{
    /**
     * Returns master page so the vue-frontend can load.
     *
     * @return View
     */
    public function index(): View
    {
        return view('pages.master');
    }
}
