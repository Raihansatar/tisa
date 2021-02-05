<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function logoutProcess()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function loginProcess(Request $request)
    {
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->route('index');
        }else{
            return redirect()->route('login.index')->with('error', 'Wrong Password Enterred');
        }
    }
}
