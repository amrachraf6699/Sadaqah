<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {

        if ($user->id === auth()->user()->id) {
            return redirect()->route('user.profile')->withErrors('You are not allowed to view your own profile');
        }

        $user->load([
            'campaigns',
            'donations' => fn ($query) => $query->latest()->take(5),
        ]);
        return view('profile.show', compact('user'));
    }
}
