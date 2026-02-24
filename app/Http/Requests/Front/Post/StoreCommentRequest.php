<?php

namespace App\Http\Requests\Front\Post;

use App\Rules\ReCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'url' => 'nullable|url|',
            'text' => 'required|string',
            'id' => 'required|exists:posts,id',
            'g-recaptcha-response' => ['required', new ReCaptcha()],
        ];
    }
}
