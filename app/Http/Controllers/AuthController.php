<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\RegisterJob;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email',$request->email)->first();

        if($user){

            $token = Str::random(60);

            DB::table('password_reset_tokens')->where('email',$request->email)->delete();

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now()
            ]);

            Mail::to($request->email)->send(new ResetPasswordMail($user->name,$token, $user->email));
        }

        return redirect()->route('login')->with('success','We have emailed your password reset link!');
    }

    public function reset(Request $request,$token)
    {
        return view('auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed'
        ]);

        $data = DB::table('password_reset_tokens')->where('token',$request->token)->first();

        if(!$data){
            return redirect()->route('login')->withErrors(['error'=>'Something went wrong while resetting your password']);
        }

        User::where('email',$data->email)->update([
            'password' => bcrypt($request->password)
        ]);

        DB::table('password_reset_tokens')->where('token',$request->token)->delete();

        return redirect()->route('login')->with('success','Password reset successfully');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->intended()->with('success','Goodbye');
    }
}
