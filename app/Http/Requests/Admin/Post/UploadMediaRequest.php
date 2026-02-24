<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UploadMediaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'upload' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'], // 5MB
        ];
    }
}
