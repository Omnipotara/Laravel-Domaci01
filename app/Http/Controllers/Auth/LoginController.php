<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo() //Laravel poziva ovu funkciju prilikom logovanja kako bi znao gde da preusmeri korisnika
    //Zna da pozove tacno nju jer je redirectTo trait od AuthenticatesUsers
    {
        // Na primer, ako je korisnik administrator:
        if (auth()->user()->is_admin) {
            return '/admin/dashboard';  // ruta za admina
        }
    
        return '/home';  // ruta za obične korisnike
    }

    public function login(Request $request)
    {
        // Validacija inputa
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Prvi pokušaj logovanja
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Ako je login uspešan, preusmeri korisnika
            return redirect()->intended($this->redirectTo());
        }

        // Ako login nije uspešan, vrati korisnika sa greškom
        return redirect()->back()->withErrors([
            'email' => 'Pogrešan email ili lozinka.',
        ])->withInput($request->only('email'));  // Vraćamo korisnikov email koji je unet (ako je greška u loginu)
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

   
}
