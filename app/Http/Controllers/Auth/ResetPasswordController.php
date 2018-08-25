<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validationErrorMessages()
    {
        return [
            'email.required' => 'La dirección de correo es requerida.',
            'email.email' => 'Debe ingresar uan dirección de correo correcta.',
            'password.required' => 'La contraseña es requerida.' ,
            'password.confirmed' => 'Las contraseñas no concuerdan.',
            'password.min' => 'La contraseña debe tener minimo 6 caracteres.'
        ];
    }

    protected function sendResetResponse($response)
    {
        return redirect($this->redirectPath())
                            ->with('status', 'Tu contraseña ha sido restablecida');
    }
}
