<?php

namespace App\Http\Controllers;

use App\Mail\BacancyMail;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
        $email = $data['email'];

        $body = [
            'name' => $data['name'],
            'url_a' => 'https://www.bacancytechnology.com/',
            'url_b' => 'https://punjabi.linguistscollective.com/',
        ];

        Mail::to($email)->send(new BacancyMail($body));
        return back()->with('status', 'Mail sent successfully');;
    }
}
