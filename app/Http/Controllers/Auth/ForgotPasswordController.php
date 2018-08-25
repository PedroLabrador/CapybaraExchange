<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validateEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ], [
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
        ]);
    }

    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', 'Te hemos enviado a tu e-mail un enlace para restablecer tu contraseña!');
    }
}
