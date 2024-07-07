<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    use UploadImage;

    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $user->load('campaigns','donations');

        $donations = $user->donations()->paginate(9);

        return view('user.profile',compact('user','donations'));
    }


    public function edit()
    {
        return view('user.edit');
    }

    public function update(UpdateProfileRequest $request)
    {

        $user = auth()->user();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('profile_picture')) {
            $path = $this->uploadImage($request->file('profile_picture'), 'images/avatars', $user->profile_picture);
            $data['profile_picture'] = $path;
        }

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }

}
