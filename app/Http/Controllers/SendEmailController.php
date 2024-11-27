<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index(){
        $content = [
            'name' => 'nama pengirim',
            'subject' => 'subject email',
            'body' => 'body email'
        ];
        Mail::to('naufalrahmanu113@gmail.com')->send(new SendEmail($content));

        return "Email telah terkirim";
    }
}
