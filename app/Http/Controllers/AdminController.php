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
        if ($user->role == 'Admin') 
            return view('admin.userdetails', [
                'user' => $user
            ]);
        else
            return redirect('/user');
        
    }

    public function updatedetails($id, Request $request) {
        $user = User::findOrFail($id);
        $admin = $request->input('admin');
        if (!$admin)
            $user->update(['role' => 'User']);
        else 
            $user->update(['role' => 'Admin']);
        return redirect()->back()->with(['success' => 'Cambios realizados con exito']);
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

    public function bank() {
        $banks = Bank::paginate(10);
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
        $finances = Finance::orderBy('id', 'desc')
                           ->paginate(10);
        return view('admin.finances', [
            'finances' => $finances
        ]);
    }
}
