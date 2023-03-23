<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function viewForm()
    {
        return view('login');
    }

    public function login(LoginUserRequest $request)
    {
        $request->validated();

        // Recuperamos las credenciales
        $input = $request->only('email', 'password');
        $remember = $request->has('remember');
        // Con el metodo attempt nos logeamos, y con el segundo parametro boleano comprovamos si se queda recordada la sesion o no
        if (Auth::attempt($input, $remember) && (Auth::user()->role_id == 1)) {
            // Verificamos si el usuario esta verificado
            if (Auth::user()->email_verified_at == null) {
                return abort(403);
            }

            if (Auth::user()->stack_created == false) {
                return redirect()->route('view-stack');
            }
            return redirect()->route('dashboard-home');
        } elseif (Auth::attempt($input, $remember) && (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)) {
            return redirect()->route('auth.login-admin');
        } else {
            session()->flash('error', ['message' => "Credenciales Incorrectas"]);
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }
}
