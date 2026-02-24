<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Contact\ContactFormRequest;
use App\Mail\ContactUs;
use App\Rules\ReCaptcha;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactUsController extends Controller
{
    public function index(): View
    {
        return view('front.contact._index');
    }

    public function store(ContactFormRequest $request): RedirectResponse
    {
        $mail = $request->validated();
        Mail::to(env('MAIL_USERNAME'))->send(new ContactUs($mail['name'], $mail['email'], $mail['text_message']));
        return back()->with('success', 'Thanks for contacting us!');
    }
}
