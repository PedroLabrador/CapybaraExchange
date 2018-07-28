<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use App\Price;

class CurrencyController extends Controller
{
    public function create() {
        $currencies = Currency::paginate(10);
    	return view('currency', [
            'currencies' => $currencies
        ]);
    }

    public function deactivate($id) {
        $currency = Currency::find($id);
        $currency->status = 1;
        $currency->save();
        return redirect()->back()->with(['success' => 'Moneda desactivada']);
    }

    public function activate($id) {
        $currency = Currency::find($id);
        $currency->status = 0;
        $currency->save();
        return redirect()->back()->with(['success' => 'Moneda activada']);
    }

    public function store(Request $request) {
        $memo = $request->get('memo');
        $data = $request->all();
        if (!($memo == 'on'))
            $data['memo'] = 'off';
        if (!$request->get('fixedmemo'))
            $data['fixedmemo'] = "";
        
    	$request->validate([
		    'name' => 'required|max:255',
		    'price_cu' => 'required|numeric',
		    'price_bs' => 'required|numeric',
            'deposit' => 'required'
		],[
            'name.required' => 'El nombre es requerido.',
			'deposit.required' => 'La dirección de deposito es requerida.',
			'price_cu.required' => 'La cantidad es requerida.',
			'price_cu.numeric' => 'La cantidad debe ser numerica.',
			'price_bs.required' => 'El precio es requerido.',
			'price_bs.numeric' => 'El precio debe ser numerico.',
		]);
    	$currency = Currency::create($data);
    	return redirect()->back()->with(['success' => 'Moneda Agregada existosamente']);
    }

    public function edit($id) {
        $currency = Currency::find($id);
        return view('currencyedit', [
            'currency' => $currency
        ]);
    }

    public function update(Request $request, $id) {
        $currency = Currency::find($id);
        $currency->update($request->all());
        return redirect()->back()->with(['success' => 'Moneda actualizada existosamente']);
    }
}
