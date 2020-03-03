<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;

class ProfileController extends Controller {

    public function index($id) {
        $user = User::where('id', $id)->orderBy('created_at', 'desc')->first();

        return view('profile', [
            'user' => $user,
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request) {
        $img = $request->file('img');
        if($img) {
            $extension = $img->getClientOriginalExtension();
            Storage::disk('public')->put($img->getFilename() . '.' . $extension, File::get($img));
        }

        $update = Auth::user()->profile;
        $update->first_name = $request->first_name;
        $update->last_name = $request->last_name;
        $update->dob = $request->dob;
        $update->gender = $request->gender;
        $update->bio = $request->bio;
        $update->user_id = Auth::user()->id;
        if($img) {
            $update->img_url = $img->getFilename() . '.' . $extension;
        }
        $update->save();

        return back()->with('success', 'Profile information updated!');
    }

}
