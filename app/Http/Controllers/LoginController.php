<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }
    
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // $credentials = $request->only('email','password');
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(auth::attempt($credentials)){
        return redirect('/home')->with("success","Login success");
            // app()->call('App\Http\Controllers\HomeController@index');

        }
        return back()->with("error","Invalid email or password");
        // return redirect("login")->withSuccess('Login details are not valid');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Logs the user out
        return redirect('login'); // Redirects the user to the login page after logout
    }
}
