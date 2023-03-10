<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupUserRequest;
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
    public function viewForm()
    {
        return view('signup');
    }

    public function signup(SignupUserRequest $request)
    {
        // Recuperamos los datos pasados por el formulario, y los validamos.
        $request->validated();

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
        User::create([
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

        // Recuperamos el id del usuario creado previamente
        $id = User::select('id')->where('email', $email)->get();
        $id = $id[0];

        // Enviamos un email para verificar
        Mail::to($email)->send(new VerifyMail($id));

        return redirect()->route('auth.login');
    }

    private function _safePassword($password)
    {
        $password = Hash::make($password);
        return $password;
    }
}
