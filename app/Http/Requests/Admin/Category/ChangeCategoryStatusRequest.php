<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class ChangeCategoryStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:categories,id',
            'show_on_index' => 'required|in:0,1'
        ];
    }
}
