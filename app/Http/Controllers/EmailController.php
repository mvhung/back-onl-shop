<?php

namespace App\Http\Controllers;

use App\Mail\MyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public $otp;
    public function addFeedback(Request $request)
    {
        $user = DB::table('users')->where('id', $request->cartId)->get();

        Mail::send('emails.test', ['name' => $user[0]->name], function ($email) use ($user) {
            $email->to($user[0]->email, 'Huy')
                ->subject('Đơn hàng của bạn đã đặt thành công');
        });
        return response()->json(['message' => "email sent"], 200);
    }

    public function sendOTP(Request $request)
    {
        $email1 = $request->email;
        $randomNumber = rand(111111, 999999); // Tạo số ngẫu nhiên từ 1000 đến 9999
        $randomString = strval($randomNumber);
        $this->otp = $randomString;
            Mail::send('emails.otp', ['phoneNumber' => $request->phoneNumber, 'otp' => $randomString], function ($email) use ($email1) {
                $email->to($email1, 'Huy')
                    ->subject('Mã xác nhận - HHHSHOP');
            });
        return response()->json(['message' => "email sent"], 200);
    }

    public function checkOTP(Request $request)
    {
        if ($request->otp === $this->otp)
        {
            return "true";
        }
        return "false";
    }
}
