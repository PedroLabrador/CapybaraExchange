<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
    	if (\Auth::user()->role == 'Admin')	
    		return view('admin.index');
		else
			return redirect('/user');
    }

    public function list() {
        $payments = Payment::all();
        return view('list', [
            'payments' => $payments
        ]); 
    }
}
