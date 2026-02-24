<?php

namespace App\Http\Requests\Admin\Sliders;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSliderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:sliders,id'
        ];
    }
}
