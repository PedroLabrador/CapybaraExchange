<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bankaccount;
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

    public function update(Request $request) {
        $data = $request->all();
        
        if (!isset($data['account']) || !isset($data['bank']))
            return redirect()->back();
        $request->validate([
            'bank' => 'required',
            'account' => 'required|min:20|max:20',
        ],[
            'bank.required' => 'El banco es requerido.',
            'account.required' => 'La cuenta es requerida.',
            'account.min' => 'El numero de cuenta debe tener 20 digitos.',
            'account.max' => 'El numero de cuenta debe tener 20 digitos.',
        ]);
        $bank = Bank::where('id', $data['bank'])->first();
        $user = \Auth::user();
        $data['user_id'] = $user->id;
        $data['bank_id'] = $bank->id;

        $bankaccount = Bankaccount::create($data);
    	return redirect()->back()->with(['success' => 'Datos actualizados correctamente']);
    }

    public function delete($id) {
        $bankaccount = Bankaccount::destroy($id);
        return redirect()->back()->with(['wrong' => 'Numero de cuenta eliminado']);
    }
}
