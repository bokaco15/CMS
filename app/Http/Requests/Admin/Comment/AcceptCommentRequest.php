<?php

namespace App\Http\Requests\Admin\Comment;

use Illuminate\Foundation\Http\FormRequest;

class AcceptCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:comments,id',
            'name' => 'required|string|exists:comments,name',
            'email' => 'required|email|exists:comments,email',
            'status' => 'required|in:0,1',
        ];
    }
}
