<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class MailController extends Controller
{
    function sendEmail(Request $request)
    {
        $data = $request->input('feedbackData');
        $name=$data['name'];
        $msg = json_encode($data);
        $to = 'studentsingh000@gmail.com';
        $subject = 'Feedback from '.$name;
        Mail::to($to)->send(new WelcomeMail($msg, $subject));

        return response()->json(['success' => true, 'message' => 'Mail Sent'])
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
    }
}