<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        $user = Auth::user();

        // Update name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');
    
        // Update password if it is set
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
    
        $user->save();
    
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
}
}