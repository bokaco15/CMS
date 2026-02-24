<?php

namespace App\Http\Requests\Front\Contact;

use App\Rules\ReCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:64',
            'email' => 'required|string|email|',
            'text_message' => 'required|string',
            'g-recaptcha-response' => ['required', new ReCaptcha()],
        ];
    }
}
