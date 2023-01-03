<?php

namespace App\Http\Controllers;

use App\Mail\MailtrapNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    // sendEmail method.
    public function sendEmail($user_email, $notification)
    {

        $mailData = [
            'message' => ['type' => get_class($notification),

            ],
            'email' => $user_email,
        ];
        $mailData['message'] = array_merge($mailData['message'], $notification->toArray($notification));

        Mail::to($mailData['email'])->send(new MailtrapNotification($mailData));

    }
}

