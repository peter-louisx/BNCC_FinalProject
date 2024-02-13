<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function authenticate(Request $request) : RedirectResponse{
        $credentials = $request->validate([
            'email' => 'required|email',
            'password'=> 'required|min:6|max:12',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(auth()->user()->name == "Peter Louis Anderson"){
                return redirect()->intended('/admin');
            }else{
                return redirect()->intended('/');
            }
        }

        // session()->flash('loginError', 'Login failed! Please try again later');

        return back()->with('loginError', 'Login failed! Please try again later');
        
        //pake variabel errors
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records',
        // ]);
    }

    public function logout(Request $request){
        Auth::logout();
        //bisa pake request()
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function registerRequest(Request $request){
        $request->validate([
            'name' => 'required|max:40|min:3',
            'email' => 'required|email|unique:users,email|ends_with:@gmail.com',
            'password'=> 'required|min:6|max:12|confirmed',
            'phone_number' => 'required|numeric|starts_with:08',
        ]);

        User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'phone'=> $request->phone_number
        ]);

        session()->flash('success', 'Register success! Please login');

        return redirect('/login');
    }
}