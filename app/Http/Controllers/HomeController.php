<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function howto() {
        return view('howto');
    }

    public function howdeposit() {
        return view('howdeposit');
    }

    public function termsofservice() {
        return view('termsofservice');
    }
    
    public function testzone() {
        return view('testzone');
    }
}
