<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            $user = User::find(Auth::id());

            // if(Auth::user()->hasRole('user')){
            if($user->hasRole('user')){
                return redirect()->route('debt.index');
            }else{
                return redirect()->route('index');
            }
        }else{
            return redirect()->route('login')->with('error', 'Wrong Password Enterred');
        }
    }
}
