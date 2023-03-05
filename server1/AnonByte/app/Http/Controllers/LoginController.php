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

    // Con el middleware de autenticación de laravel comprobamos las credenciales
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|string',
        ]);

        // Recuperamos las credenciales
        $input = $request->only('email', 'password');
        $remember = $request->has('remember');
        // Con el metodo attempt nos logeamos, y con el segundo parametro boleano comprovamos si se queda recordada la sesion o no
        if (Auth::attempt($input, $remember) && (Auth::user()->role_id == 1)) {
            // Verificamos si el usuario esta verificado
            if (Auth::user()->email_verified_at == null) {
                return view('usernotverified');
            }

            if (Auth::user()->stack_created == false) {
                return redirect()->route('view-sugests');
            }
            return redirect()->route('dashboard-home');
        }
    }

    // Logout con el middleware de autenticación
    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }
}
