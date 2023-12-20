<?php

namespace App\Http\Controllers;

use App\Mail\MyEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public $otp;
    public function addFeedback(Request $request)
    {
        $email1 = $request->email;

        Mail::send('emails.test', ['name' => $request->name,], function ($email) use ($email1) {
            $email->to($email1, 'Huy')
                ->subject('Đơn hàng của bạn đã đặt thành công');
        });
        return response()->json(['message' => "email sent"], 200);
    }

    public function sendOTP(Request $request)
    {
        $email1 = $request->email;
        $randomNumber = rand(0000, 9999); // Tạo số ngẫu nhiên từ 1000 đến 9999
        $randomString = strval($randomNumber);
        $this->otp = $randomString;
            Mail::send('emails.otp', ['name' => $request->name, 'otp' => $randomString], function ($email) use ($email1) {
                $email->to($email1, 'Huy')
                    ->subject('Mã xác nhận - HHHSHOP');
            });
        return response()->json(['message' => "email sent"], 200);
    }

    public function checkOTP(Request $request)
    {
        if ($request->otp === $this->otp)
        {
            return response()->json(['message' => "verified"], 200);
        }
        return response()->json(['message' => "rejected"], 200);
    }
}
