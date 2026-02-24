<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:categories,id',
        ];
    }
}
