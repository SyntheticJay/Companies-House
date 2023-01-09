<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the main homepage post-auth
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('home');
    }

    public function flash()
    {
        return redirect()->route('home')->with('success', 'yo');
    }
}
