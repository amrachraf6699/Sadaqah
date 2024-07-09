<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\RegisterJob;
use App\Models\User;
use App\Traits\UploadImage;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    use UploadImage;

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

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'uuid' => Str::uuid(),
            'profile_picture' => $request->hasFile('profile_picture') ? $this->uploadImage($request->profile_picture,'images/avatars') : null
        ]);

        RegisterJob::dispatch($user);

        auth()->login($user);

        return redirect()->route('home')->with('success','Welcome, '.$user->name);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->intended()->with('success','Goodbye');
    }
}
