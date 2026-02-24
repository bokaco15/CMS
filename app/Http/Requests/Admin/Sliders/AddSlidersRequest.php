<?php

namespace App\Http\Requests\Admin\Sliders;

use Illuminate\Foundation\Http\FormRequest;

class AddSlidersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'heading' => 'required|string|max:255',
            'btnText' => 'nullable|string|max:255',
            'btnLink' => 'nullable|string|max:255',
            'show_on_index' => 'required|in:0,1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ];
    }
}
