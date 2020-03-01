<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\User;

class ProfileController extends Controller {

    public function index($id) {
        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();
        if(empty(Auth::user()->profile->user_id)) {
            $info = new Profile();
            $info->user_id = Auth::user()->id;
            $info->save();
        }
        $info = Auth::user()->profile;
        $profileUserId = $id;
        $profile = $user->findOrFail($profileUserId)->profile;
        $comments = $user->comments;

        return view('profile', ['user' => $user, 'posts' => $posts, 'info' => $info, 'profile' => $profile, 'comments' => $comments]);
    }

    public function updateProfile(UpdateProfileRequest $request) {
        $update = Auth::user()->profile;
        $update->first_name = $request->first_name;
        $update->last_name = $request->last_name;
        $update->dob = $request->dob;
        $update->gender = $request->gender;
        $update->bio = $request->bio;
        $update->img_url = $request->img;
        $update->user_id = Auth::user()->id;
        $update->save();

        return back()->with('success', 'Profile information updated!');
    }

}
