<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            // 'name' => 'required|max:50',
            // 'email' => 'required|email|max:100',
            'token' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        ];
    }
}
