<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view()
    {
        $username = auth()->user()->username;
        return view('dashboard.home', [
            'username' => $username
        ]);
    }
}
