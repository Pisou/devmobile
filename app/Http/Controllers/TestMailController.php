<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class TestMailController extends Controller
{
    public function index()
    {
        Mail::raw('Test email from Brevo', function ($message) {
            $message->to('votre_email_personnel@gmail.com')
                ->subject('Test Brevo');
        });

        return 'Email envoyé !';
    }
}
