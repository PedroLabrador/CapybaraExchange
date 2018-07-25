<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Currency;
use App\Bankaccount;

class ExchangeController extends Controller
{
    public function index() {
        $currencies = Currency::all();
        $user = \Auth::user();
        $bankaccounts = $user->bankaccounts;
    	return view('exchange', [
            'currencies' => $currencies,
            'user' => 'user',
            'bankaccounts' => $bankaccounts
        ]);
    }

    public function main() {
        $currencies = Currency::all();
        return view('index', [
            'currencies' => $currencies,
        ]);
    }

    public function store(Request $request) {
        $user = \Auth::user();
        $bank_id = $request->get('bankaccount');
        $money_from = $request->get('money_from');
        $money_to = $request->get('money_to');
        $link = $request->get('link');

        if (!$link)
            return redirect()->back()->with(['wrong' => 'El correo no puede estar vacio']);

        if (!$bank_id)
            return redirect('/user/profile')->with(['wrong' => 'Por favor registra un banco donde pagar']);
        if ($money_from <= 0 || $money_to <= 0)
            return redirect()->back()->with(['wrong' => 'Saldo incorrecto']);

        $currency = Currency::find($request->get('from'));
        if (!($money_from * $currency->price_bs == $money_to))
            return redirect()->back()->with(['wrong' => 'Saldo incorrecto']);

        $bankaccount = Bankaccount::where('id', $bank_id)->first();
        if (!($bankaccount->user->id == $user->id))
            return redirect()->back()->with(['wrong' => 'Error con la cuenta bancaria']);

        $request->validate([
            'money_from' => 'required|numeric',
            'money_to' => 'required|numeric',
            'from' => 'required|integer',
            'to' => 'required|integer',
            'link' => 'required|url',
            'bankaccount' => 'required'
        ],[
            'money_from.required' => 'La cantidad de la moneda es requerida.',
            'money_to.required' => 'La cantidad de bs es requerida.',
            'from.required' => 'Campo requerido.',
            'to.required' => 'Campo requerido.',
            'link.required' => 'El enlace es requerido.',
            'bankaccount.required' => 'La cuenta bancaria es requerida.',
            'money_from.numeric' => 'La cantidad a vender debe ser numerica.',
            'money_to.numeric' => 'La cantidad a recibir debe ser numerica.',
            'to.integer' => 'Campo debe ser entero.',
            'from.integer' => 'Campo debe ser entero.',
            'link.url' => 'Debe ingresar un enlace.',
        ]);

        Payment::create([
            'user_id' => $user->id,
            'bankaccount_id' => $bankaccount->id,
            'amount' => $money_from,
            'to_pay' => $money_to,
            'link' => $link,
            'currency' => $currency->name
        ]);

        return view('user.success');
    }

    public function main_store(Request $request) {
        dd($request->all());
    }

    public function show($id) {
        $payment = Payment::findOrfail($id);
        return view('admin.exchangeshow', [
            'payment' => $payment
        ]);
    }

    public function approve($id) {
        $payment = Payment::findOrfail($id);
        $payment->done = 1;
        $payment->save();
        return redirect('/admin/exchange/list')->with(['success' => "Venta aprobada satisfactoriamente"]);
    }

    public function disapprove($id) {
        $payment = Payment::findOrfail($id);
        $payment->done = 2;
        $payment->save();
        return redirect('/admin/exchange/list')->with(['wrong' => "Venta no aprobada"]);
    }

    public function create(Request $request) {
        $data = $request->all();
        $user = \Auth::user();
        $data['user_id'] = $user->id;
        Payment::create($data);
        return redirect()->back()->with(['success' => "registrado satisfactoriamente"]);
    }

    public function listapproved() {
        $payments = Payment::where('done', 1)->get();
        return view('admin.exchangelist', [
            'payments' => $payments
        ]);
    }

    public function listdisapproved() {
        $payments = Payment::where('done', 2)->get();
        return view('admin.exchangelist', [
            'payments' => $payments
        ]);
    }

    public function list() {
        $payments = Payment::where('done', 0)->get();
        return view('admin.exchangelist', [
            'payments' => $payments
        ]);
    }
}
