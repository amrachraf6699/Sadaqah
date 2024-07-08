<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        if(auth()->attempt($request->only('email','password'),$request->filled('remember_me'))){

            if(auth()->user()->is_admin){
                return redirect()->route('filament.admin.pages.dashboard')->with('success','Welcome, '.auth()->user()->name);
            }

            return redirect()->intended()->with('success','Welcome, '.auth()->user()->name);
        }
        return back()->withErrors(['error'=>'Invalid Email or Password']);
    }

    public function register(AuthRequest $request)
    {
        $user = User::create($request->only('name','email') + ['password'=>bcrypt($request->password)]);
        auth()->login($user);
        return redirect()->route('home')->with('success','Welcome, '.$user->name);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->intended()->with('success','Goodbye');
    }
}