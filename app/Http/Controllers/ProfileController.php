<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Post;
use App\Profile;
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

        $update = Auth::user()->profile;
        $img = $request->file('img');
        if($img) {
            $extension = $img->getClientOriginalExtension();
            Storage::disk('public')->put($img->getFilename() . '.' . $extension, File::get($img));
            $update->img_url = $img->getFilename() . '.' . $extension;
        }
        $update->first_name = $request->first_name;
        $update->last_name = $request->last_name;
        $update->dob = $request->dob;
        $update->gender = $request->gender;
        $update->bio = $request->bio;
        $update->user_id = Auth::user()->id;
        $update->save();

        return back()->with('success', 'Profile information successfully updated!');
    }

    public function deleteImg($id) {

        $imgPath = public_path() . '\\uploads\\' . Profile::find($id)->img_url;
        if(file_exists($imgPath)){
            @unlink($imgPath);
        }
        Profile::where('user_id', $id)
            ->update(['img_url' => null]);

        return back()->with('success', 'Profile image successfully deleted!');
    }

}
