<?php

namespace App\Http\Requests\Admin\Tags;

use Illuminate\Foundation\Http\FormRequest;

class EditTagRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:tags,id',
            'name' => 'required|string|max:64',
            'slug' => 'required|string'
        ];
    }
}
