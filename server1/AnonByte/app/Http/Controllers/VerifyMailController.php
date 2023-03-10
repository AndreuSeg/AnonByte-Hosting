<?php

namespace App\Http\Controllers;

use App\Models\User;

class VerifyMailController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $user->updated_at = now();
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('auth.login')->with('message', "Su correo ha sido verificado.");
    }
}
