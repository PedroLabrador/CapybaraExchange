<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Currency;
use App\Bankaccount;
use App\Mail\PagoAprobado;
use App\Mail\PagoDenegado;
use App\Finance;

class ExchangeController extends Controller
{
    public function index() {
        $currencies = Currency::all();
        $user = \Auth::user();
        $bankaccounts = $user->bankaccounts;

        $memodatabase = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $memogenerated = "";
        do {
            for ($i = 0;$i < 8;$i++)
                $memogenerated .= substr($memodatabase, rand(0,61), 1);

            $count = Payment::where('memo', 'like', "%$memogenerated%")
                            ->get()
                            ->count();
        } while ($count != 0);

    	return view('exchange', [
            'currencies' => $currencies,
            'user' => 'user',
            'bankaccounts' => $bankaccounts,
            'memo' => $memogenerated
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
        $memo = $request->get('memo');

        if (!$link && !$memo)
            return redirect()->back()->with(['wrong' => 'El enlace no puede estar vacio']);

        if (!$bank_id)
            return redirect('/user/profile')->with(['wrong' => 'Por favor registra un banco donde pagar']);
        if ($money_from <= 0 || $money_to <= 0)
            return redirect()->back()->with(['wrong' => 'Saldo incorrecto']);

        $currency = Currency::find($request->get('from'));
        if (!($money_from * $currency->price_bs == $money_to))
            return redirect()->back()->with(['wrong' => 'Saldo incorrecto']);
        
        if ($currency->memo == 'on') {
            if (!$link)
                $link = "";
        } else {
            $memo = "";
            $request->validate([
                'link' => 'required|url|unique:payments'
            ], [
                'link.required' => 'El enlace es requerido.',
                'link.unique' => 'El enlace ya ha sido registrado',
                'link.url' => 'Debe ingresar un enlace.',
            ]);
        }

        $bankaccount = Bankaccount::where('id', $bank_id)->first();
        if (!($bankaccount->user->id == $user->id))
            return redirect()->back()->with(['wrong' => 'Error con la cuenta bancaria']);

        $request->validate([
            'money_from' => 'required|numeric',
            'money_to' => 'required|numeric',
            'from' => 'required|integer',
            'to' => 'required|integer',
            'bankaccount' => 'required',
            'memo' => 'unique:payments'
        ],[
            'money_from.required' => 'La cantidad de la moneda es requerida.',
            'money_to.required' => 'La cantidad de bs es requerida.',
            'from.required' => 'Campo requerido.',
            'to.required' => 'Campo requerido.',
            'bankaccount.required' => 'La cuenta bancaria es requerida.',
            'money_from.numeric' => 'La cantidad a vender debe ser numerica.',
            'money_to.numeric' => 'La cantidad a recibir debe ser numerica.',
            'to.integer' => 'Campo debe ser entero.',
            'from.integer' => 'Campo debe ser entero.',
            'memo.unique' => 'El memo ya existe'
        ]);

        Payment::create([
            'user_id' => $user->id,
            'bankaccount_id' => $bankaccount->id,
            'amount' => $money_from,
            'to_pay' => $money_to,
            'link' => $link,
            'currency' => $currency->name,
            'memo' => $memo
        ]);

        return view('user.success');
    }

    public function show($id) {
        $payment = Payment::findOrfail($id);
        return view('admin.exchangeshow', [
            'payment' => $payment
        ]);
    }

    public function approve($id, Request $request) {
        $request->validate([
            'reference' => 'required',
            'btcwon' => 'required',
            'btcspent' => 'required',
        ],[
            'reference.required' => 'El numero de referencia es requerido.',
            'btcwon.required' => 'La cantidad de BTC generados es requerida.',
            'btcspent.required' => 'La cantidad de BTC gastados es requerida.',
        ]);

        $payment = Payment::findOrfail($id);
        if ($payment->done != 0)
            return redirect()->back();
        $payment->done = 1;
        $payment->reference = $request->get('reference');
        $payment->save();

        $finance = Finance::create([
            'payment_id' => $payment->id,
            'btc_won' => $request->get('btcwon'),
            'btc_spent' => $request->get('btcspent')
        ]);

        $user = $payment->user;
        $email = $user->email;
        \Mail::to($email)->send(new PagoAprobado($user, $payment));
        return redirect('/admin/exchange/list')->with(['success' => "Venta aprobada satisfactoriamente"]);
    }

    public function disapprove($id, Request $request) {
        $request->validate([
            'reference' => 'required',
        ],[
            'reference.required' => 'La razon de rechazo es requerida.',
        ]);

        $payment = Payment::findOrfail($id);
        if ($payment->done != 0)
            return redirect()->back();
        $payment->done = 2;
        $payment->reference = $request->get('reference');
        $payment->save();

        $user = $payment->user;
        $email = $user->email;
        \Mail::to($email)->send(new PagoDenegado($user, $payment));
        return redirect('/admin/exchange/list')->with(['wrong' => "Venta no aprobada"]);
    }

    public function create(Request $request) {
        $data = $request->all();
        $user = \Auth::user();
        $data['user_id'] = $user->id;
        Payment::create($data);
        return redirect()->back()->with(['success' => "registrado satisfactoriamente"]);
    }

    public function listdisapproved() {
        $payments = Payment::orderBy('id', 'desc')
                            ->where('done', 2)
                            ->paginate(10);
        return view('admin.exchangelist', [
            'payments' => $payments
        ]);
    }

    public function listapproved() {
        $payments = Payment::orderBy('id', 'desc')
                            ->where('done', 1)
                            ->paginate(10);
        return view('admin.exchangelist', [
            'payments' => $payments
        ]);
    }

    public function list() {
        $payments = Payment::orderBy('id', 'asc')
                            ->where('done', 0)
                            ->paginate(10);
        return view('admin.exchangelist', [
            'payments' => $payments
        ]);
    }
}