<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules(){
        return [
            "first_name" => "nullable",
            "last_name" => "nullable",
            "dob" => "nullable",
            "gender" => "nullable",
            "bio" => "nullable",
            "img" => "nullable"
        ];
    }
}
