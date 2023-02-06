<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Renderizamos la vista del formulario
    public function viewForm()
    {
        return view('login');
    }

    // Con el middleware de autenticaciónd de laravel comprovamos las credenciales
    public function login(Request $request)
    {
        // Recuperamos las credenciales
        $input = $request->only('email', 'password');
        $remember = $request->has('remember');
        // Con el metodo attempt nos logeamos, y con el segundo parametro boleano comprovamos si se queda recordada la sesion o no
        if (Auth::attempt($input, $remember) && (Auth::user()->role_id == 1)) {
            // Verificamos si el usuario esta verificado
            if (Auth::user()->email_verified_at == null) {
                return view('usernotverified');
            }

            return redirect()->route('dashboard-home');
        } else {
            // Si las credencailes son invalidas devolvemos un mensaje de error
            return redirect()->back()->withErrors(['Credentials' => 'Tus credenciales son incorrectas']);
        }
    }

    // Logout con el middleware de autenticación
    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }
}
