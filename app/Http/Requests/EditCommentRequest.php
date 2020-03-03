<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCommentRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            "comment_content" => "required|min:3"
        ];
    }
}
