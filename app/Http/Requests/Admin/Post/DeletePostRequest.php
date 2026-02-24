<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class DeletePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:posts,id',
        ];
    }
}
