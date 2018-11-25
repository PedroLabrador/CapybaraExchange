<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank;
use App\Currency;
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
        $users = User::paginate(1000);
        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function detailsuser($id) {
        $user = User::findOrFail($id);
        if (\Auth::user()->role == 'Admin') 
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
        foreach ($payments as $payment) {
            foreach ($payment->finances as $finance)
                Finance::destroy($finance->id);
            Payment::destroy($payment->id);
        }
        foreach ($bankaccounts as $bankaccount)
            Bankaccount::destroy($bankaccount->id);
        User::destroy($id);
        return redirect()->back()->with(['wrong' => 'Usuario eliminado']);
    }

    public function bank() {
        $banks = Bank::paginate(20);
        return view('admin.bank', [
            'banks' => $banks
        ]);
    }

    public function bankcreate(Request $request) {
        $request->validate([
            'bankname' => 'required|max:255',
            'accountcode' => 'required|numeric',
            'url' => 'required'
        ],[
            'bankname.required' => 'El nombre  del banco es requerido.',
            'accountcode.required' => 'El codigo del banco es requerido.',
            'accountcode.numeric' => 'El codigo del banco debe ser un numero.',
            'url.required' => 'El nombre de imagen es requerido'
        ]);
        $data = $request->all();
        Bank::create($data);
        return redirect()->back()->with(['success' => 'Banco habilitado con exito']);
    }

    public function bankedit($id) {
        $bank = Bank::findOrFail($id);
        return view('admin.bankedit', [
            'bank' => $bank
        ]);
    }

    public function bankupdate(Request $request, $id) {
        $bank = Bank::findOrFail($id);
        $bank->update($request->all());
        return redirect()->back()->with(['success' => 'Banco actualizado exitosamente']);
    }

    public function deactivate($id) {
        $currency = Bank::find($id);
        $currency->status = 1;
        $currency->save();
        return redirect()->back()->with(['success' => 'Banco desactivado']);
    }
    
    public function deactivateall() {
        $banks = Bank::all();
        foreach ($banks as $bank) {
           $bank->status = 1;
           $bank->save();
        }
        return redirect()->back()->with(['success' => 'Bancos desactivados']);
    }

    public function activateall() {
        $banks = Bank::all();
        foreach ($banks as $bank) {
           $bank->status = 0;
           $bank->save();
        }
        return redirect()->back()->with(['success' => 'Bancos activados']);
    }


    public function activate($id) {
        $currency = Bank::find($id);
        $currency->status = 0;
        $currency->save();
        return redirect()->back()->with(['success' => 'Banco activado']);
    }

    public function finances(Request $request) {
        $from_date = $request->get('from_date');
        $to_date = $request->get('to_date');

        if (!empty($from_date) && !empty($to_date))
            $finances = Finance::whereBetween('created_at', [$from_date, $to_date])->get();
        else
            $finances = Finance::orderBy('id', 'desc')->get();
    
        $winning = 0;
        $total_btc_won = 0;
        $total_btc_spent = 0;

        foreach ($finances as $finance) {
            $winning += ($finance->btc_won - $finance->btc_spent);
            $total_btc_won += $finance->btc_won;
            $total_btc_spent += $finance->btc_spent;
        }
        
        return view('admin.finances', [
            'finances' => $finances,
            'winning' => $winning,
            'total_btc_won' => $total_btc_won,
            'total_btc_spent' => $total_btc_spent
        ]);
    }

    public function rates(Request $request) {
        if ($request->btcrateves === 0)
            return redirect()->back()->with(['wrong' => "Division por 0???"]);
        if (!$request->checked)
            return redirect()->back();
        foreach ($request->checked as $checked) {
            $finance = Finance::where('id', $checked)->first();
            $payment = $finance->payment;




            if ($request->btcrateves !== null && $request->cfactor !== null) {
                $finance->cfactor = $request->cfactor;
                $finance->btc_rate = $request->btcrateves;
                $btc_spent = (floatval($payment->to_pay) * floatval($request->cfactor)) / floatval($request->btcrateves);
                $finance->btc_spent = $btc_spent;
            } else {
                if ($request->cfactor !== null) {
                    $finance->cfactor = $request->cfactor;
                    if ($finance->btc_rate == '')
                        $btc_spent = (floatval($payment->to_pay) * floatval($request->cfactor)) / 1;
                    else
                        $btc_spent = (floatval($payment->to_pay) * floatval($request->cfactor)) / floatval($finance->btc_rate);
                    $finance->btc_spent = $btc_spent;
                }
                if ($request->btcrateves !== null) {
                    $finance->btc_rate = $request->btcrateves;
                    if ($finance->cfactor == '')
                        $btc_spent = (floatval($payment->to_pay) * 1) / floatval($request->btcrateves);   
                    else
                        $btc_spent = (floatval($payment->to_pay) * floatval($payment->cfactor)) / floatval($request->btcrateves);   
                    $finance->btc_spent = $btc_spent;
                }
            }
            if ($request->btcrate !== null) {
                $btc_won = floatval($payment->amount) * floatval($request->btcrate);
                $finance->btc_won = $btc_won;
            }
            
            $finance->save();
        }
        return redirect()->back();
    }

    public function financesedit($id) {
        $finance = Finance::findOrFail($id);
        return view('admin.financesedit', [
            'finance' => $finance
        ]);
    }

    public function financesupdate(Request $request, $id) {
        $finance = Finance::findOrFail($id);
        $finance->update($request->all());
        return redirect()->back()->with(['success' => 'Finanza actualizada exitosamente']);
    }

    public function check() {
        return view('admin.checkupdates');
    }

    public function checkupdates(Request $request) {
        $froms      = $request->get('from');
        $tos        = $request->get('to');
        $amounts    = $request->get('amount');
        $memos      = $request->get('memo');
        $timestamps = $request->get('timestamp');
        $counter = 0;

        foreach ($froms as $i => $from) {
            $bankaccount = Bankaccount::where('memo', 'like', '%'.$memos[$i].'%')
                                      ->first();
            
            if ($bankaccount) {
                $created_at = str_replace('T', ' ', $timestamps[$i]);
                $updated_at = str_replace('T', ' ', $timestamps[$i]);

                $n = Payment::where('memo', 'like', '%'.$memos[$i].'%')
                                  ->where('created_at', $created_at)
                                  ->count();

                if ($n == 0) {
                    $counter++;
                    $user_id = $bankaccount->user->id;
                    $bankaccount_id = $bankaccount->id;
                    $amount = explode(" ", $amounts[$i])[0];
                    $currency_name = explode(" ", $amounts[$i])[1];
                    $currency = Currency::where('name', $currency_name)->first();
                    $to_pay = floatval($amount) * floatval($currency->price_bs);
                    $link = "";
                    $reference = "";
                    $memo = $memos[$i];
                    
                    $payment = Payment::create([
                        'user_id' => $user_id,
                        'bankaccount_id' => $bankaccount_id,
                        'currency' => $currency_name,
                        'amount' => $amount,
                        'to_pay' => $to_pay,
                        'link' => $link,
                        'done' => 0,
                        'memo' => $memo
                    ]);

                    $payment->created_at = $created_at;
                    $payment->updated_at = $updated_at;
                    $payment->save();
                }
            }
        }
        if ($counter == 0) {
            return redirect('/admin/exchange/list');
        } else {
            return redirect('/admin/exchange/list')->with(['success' => $counter . ' Transaccion/es registrada/s.']);
        }
    }
}
