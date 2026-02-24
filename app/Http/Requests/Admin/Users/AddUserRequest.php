<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|max:50',
            'slug' => 'required|string|alpha_dash|max:255|',
            'phone' => 'required|string|min:5|max:15|unique:users',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
