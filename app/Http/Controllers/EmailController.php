<?php

namespace App\Http\Controllers;

use App\Mail\MyEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function addFeedback(Request $request)
    {
        Mail::send('emails.test', ['name' => $request->name,], function ($email){
            $email->to('maihung1372002@gmail.com', 'Huy');
        });
        return response()->json(['message' => " email sent"], 200);
    }
}
