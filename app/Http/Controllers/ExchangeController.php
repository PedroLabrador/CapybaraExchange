<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Currency;

class ExchangeController extends Controller
{
    public function index() {
        $currencies = Currency::all();
    	return view('exchange', [
            'currencies' => $currencies
        ]);
    }

    public function create(Request $request) {
        $data = $request->all();
        $user = \Auth::user();
        $data['user_id'] = $user->id;
        Payment::create($data);
        return redirect()->back()->with(['success' => "registrado satisfactoriamente"]);
    }

    public function list() {
        $payments = Payment::where('done', 1)->get();
        return view('admin.exchangelist', [
            'payments' => $payments
        ]);
    }
}
