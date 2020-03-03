<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules(){
        return [
            "first_name" => "nullable|min:2",
            "last_name" => "nullable|min:2",
            "dob" => "nullable",
            "gender" => "nullable",
            "bio" => "nullable|min:10",
            "img" => "nullable",
        ];
    }
}
