<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    { 
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'active'=> '1',
        ];

        if (Auth::Attempt($data)) {

            $user = Auth::user();

            if ($user->role == 'Guest') {
                return redirect('home');
            } elseif ($user->role == 'Admin') {
                return redirect('homeAdmin');
            }
            
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('login');
        }
    }

    public function actionlogout(Request $req)
    {
        $req->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
