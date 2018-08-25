<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bankaccount;
use App\Payment;
use App\Bank;

class UserController extends Controller
{
    public function index() {
    	$user = \Auth::user();
        $bankaccounts = $user->bankaccounts;
        $banks = Bank::all();
    	return view('user.profile', [
    		'user' => $user,
            'bankaccounts' => $bankaccounts,
            'banks' => $banks
    	]);
    }

    public function home() {
        return view('home');
    }

    public function phone(Request $request) {
        $user = \Auth::user();
        $contact = $request->get('contact');
        $user->contact = $contact;
        $user->save();
        return redirect()->back()->with(['success' => 'Información de contacto actualizada']);
    }

    public function update(Request $request) {
        $data = $request->all();
        $data['dni'] = $data['na'] . "-" . $data['dni'];
        $bank = Bank::where('id', $data['bank'])->first();
        if (!(substr($data['account'], 0, 4 ) === $bank->accountcode))
            return redirect()->back()->with(['wrong' => 'Cuenta incorrecta']);
        
        if (!isset($data['account']) || !isset($data['bank']))
            return redirect()->back();
        $request->validate([
            'bank' => 'required',
            'account' => 'required|min:20|max:20',
            'user_name' => 'required',
            'dni' => 'required',
            'account_type' => 'required',
        ],[
            'bank.required' => 'El banco es requerido.',
            'account.required' => 'La cuenta es requerida.',
            'account_type.required' => 'El tipo de cuenta es requerida.',
            'user_name.required' => 'El titular de la cuenta es requerido.',
            'dni.required' => 'La cédula es requerida.',
            'account.min' => 'El numero de cuenta debe tener 20 digitos.',
            'account.max' => 'El numero de cuenta debe tener 20 digitos.',
        ]);
        
        $user = \Auth::user();
        $data['user_id'] = $user->id;
        $data['bank_id'] = $bank->id;

        $bankaccount = Bankaccount::create($data);
    	return redirect()->back()->with(['success' => 'Datos actualizados correctamente']);
    }

    public function delete($id) {
        $bankaccount = Bankaccount::findOrFail($id);
        foreach ($bankaccount->payments as $payment)
            Payment::destroy($payment->id);
        Bankaccount::destroy($id);
        return redirect()->back()->with(['wrong' => 'Numero de cuenta eliminado']);
    }

    public function list() {
        $user = \Auth::user();
        $payments = Payment::where('user_id', $user->id)
                            ->get();
        return view('user.exchangelist', [
            'payments' => $payments
        ]);
    }
}
