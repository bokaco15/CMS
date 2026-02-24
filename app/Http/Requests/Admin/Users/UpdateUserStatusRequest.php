<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:users,id|integer',
            'is_banned' => 'required|integer|between:0,1',
        ];
    }
}
