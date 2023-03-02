<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function update(Request $request, User $user){
        if (auth()->user()->id !== $user->user()->id){
            return abort(403);
        }
        $request->validate([
            'name' => 'required',
            'profileImagePath' => 'nullable | image',
            'bio' => 'required',
        ]);
        $name = $request->name;
        $bio = $request->bio;

        if ($request->file('profileImagePath')) {
            File::delete($user->profileImagePath);
            $profileImagePath = 'storage/' . $request->file('file')->store('postsImages', 'public');

            $user->profileImagePath= $profileImagePath;
            $user->name= $name;
            $user->bio = $bio;
            return $user->save();
        }

    }
}
