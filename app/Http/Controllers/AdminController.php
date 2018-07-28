<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\Finance;
use App\User;
use App\Payment;
use App\Bankaccount;

class AdminController extends Controller
{
    public function index() {
    	if (\Auth::user()->role == 'Admin')	
    		return view('admin.index');
		else
			return redirect('/user');
    }

    public function users() {
        $users = User::paginate(10);
        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function detailsuser($id) {
        $user = User::findOrFail($id);
        return view('admin.userdetails', [
            'user' => $user
        ]);
    }

    public function deleteuser($id) {
        $user = User::findOrFail($id);
        $payments = $user->payments;
        $bankaccounts = $user->bankaccounts;
        foreach ($payments as $payment)
            Payment::destroy($payment->id);
        foreach ($bankaccounts as $bankaccount)
            Bankaccount::destroy($bankaccount->id);
        User::destroy($id);
        return redirect()->back()->with(['wrong' => 'Usuario eliminado']);
    }

    public function list() {
        $payments = Payment::all();
        return view('list', [
            'payments' => $payments
        ]); 
    }

    public function bank() {
        $banks = Bank::all();
        return view('admin.bank', [
            'banks' => $banks
        ]);
    }

    public function bankcreate(Request $request) {
        $request->validate([
            'bankname' => 'required|max:255',
            'accountcode' => 'required|numeric',
        ],[
            'bankname.required' => 'El nombre  del banco es requerido.',
            'accountcode.required' => 'El codigo del banco es requerido.',
            'accountcode.numeric' => 'El codigo del banco debe ser un numero.',
        ]);
        $data = $request->all();
        Bank::create($data);
        return redirect()->back()->with(['success' => 'Banco habilitado con exito']);
    }

    public function deactivate($id) {
        $currency = Bank::find($id);
        $currency->status = 1;
        $currency->save();
        return redirect()->back()->with(['success' => 'Banco desactivado']);
    }

    public function activate($id) {
        $currency = Bank::find($id);
        $currency->status = 0;
        $currency->save();
        return redirect()->back()->with(['success' => 'Banco activado']);
    }

    public function finances() {
        $finances = Finance::paginate(10);
        return view('admin.finances', [
            'finances' => $finances
        ]);
    }
}
