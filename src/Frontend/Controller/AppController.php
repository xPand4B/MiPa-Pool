<?php

namespace MiPaPo\Frontend\Controller;

use Illuminate\View\View;
use MiPaPo\Core\Controller\Controller;

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
