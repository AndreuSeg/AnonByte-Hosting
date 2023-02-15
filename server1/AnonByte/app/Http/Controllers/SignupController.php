<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Type\NullType;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SignupController extends Controller
{
    // Renderizamos la vista del formulario
    public function viewForm()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        /**
         * Store a new user.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        // Recuperamos los datos pasados por el formulario, y los validamos.
        $request->validate([
            'username' => 'required|max:50',
            'name' => 'required|string|max:30',
            'lastname' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|string',
        ]);

        $username = $request->input('username');
        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $password = $request->input('password');
        $password = $this->_safePassword($password);

        // Recuperamos el id del rol de users
        $role = Role::find(1);
        $roleId = $role->id;

        // Con el modelo de user registramos al us usuario en la base de datos
        $store = User::create([
            'role_id' => $roleId,
            'username' => $username,
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'email_verified_at' => null,
            'stack_created' => false,
            'password' => $password,
            'remeber_toker' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => null,
            'deleted_At' => null,
        ]);

        $id = User::select('id')->where('email', $email)->get();
        $id = $id[0];

        Mail::to($email)->send(new VerifyMail($id));

        return redirect()->route('login');
    }

    // Hasheamos la contraseña
    private function _safePassword($password)
    {
        $password = Hash::make($password);
        return $password;
    }
}
