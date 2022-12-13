<?php

namespace App\Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Return view of home blade
     *
     * @return void
     */
    public function create()
    {
        return view('frontend::home');
    }
}
