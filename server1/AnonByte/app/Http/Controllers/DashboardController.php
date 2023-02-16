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

    public function viewSugests()
    {
        return view('dashboard.sugests');
    }

    public function viewStackForm()
    {
        return view('dashboard.createstack');
    }

    public function createStack(Request $request)
    {
    }
}
