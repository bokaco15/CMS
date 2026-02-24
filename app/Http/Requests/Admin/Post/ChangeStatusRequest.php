<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:posts,id',
            'published' => 'required|in:0,1',
        ];
    }
}
