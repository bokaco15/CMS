<?php

namespace App\Http\Requests\Admin\Comment;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:comments,id',
        ];
    }
}
