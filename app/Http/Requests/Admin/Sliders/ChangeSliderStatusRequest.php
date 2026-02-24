<?php

namespace App\Http\Requests\Admin\Sliders;

use Illuminate\Foundation\Http\FormRequest;

class ChangeSliderStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:sliders,id',
            'show_on_index' => 'required|in:0,1',
        ];
    }
}
