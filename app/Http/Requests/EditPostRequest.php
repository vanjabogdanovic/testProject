<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            "post_content" => "required"
        ];
    }
}
