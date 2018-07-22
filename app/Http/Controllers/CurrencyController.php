<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use App\Price;

class CurrencyController extends Controller
{
    public function create() {
    	return view('currency');
    }

    public function store(Request $request) {
    	$request->validate([
		    'name' => 'required|max:255',
		    'price_cu' => 'required|numeric',
		    'price_bs' => 'required|numeric',
		],[
			'name.required' => 'El nombre es requerido.',
			'price_cu.required' => 'La cantidad es requerida.',
			'price_cu.numeric' => 'La cantidad debe ser numerica.',
			'price_bs.required' => 'El precio es requerido.',
			'price_bs.numeric' => 'El precio debe ser numerico.',
		]);
    	$currency = Currency::create($request->all());
    	return redirect()->back()->with(['success' => 'Moneda Agregada existosamente']);
    }

    public function pricecreate() {
    	$currencies = Currency::all();
    	return view('price', [
    		'currencies' => $currencies
    	]);
    }

    public function pricestore(Request $request) {
    	$data = $request->all();
    	$currency = Currency::find($data);
    	$data['currency_id'] = $currency->id;
    	$price = Price::create($data);
    	return redirect()->back()->with(['success' => 'Precio agregado existosamente']);
    }
}
