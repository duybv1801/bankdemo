<?php

namespace App\Http\Controllers;

use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Otp;

class AjaxController extends Controller
{
    public function receiver(Request $request)
    {
        $accountNumber = $request->account_number;
        $meta = UserMeta::where('accout_number', $accountNumber)->with('user')->first();

        if ($meta) {
            return response()->json(['user_name' => $meta->user->name, 'user_id' => $meta->user->id]);
        } else {
            return response()->json([]);
        }
    }

    public function sendOtp(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(100000, 999999);
        Log::info($otp);
        try {
            Mail::to($email)->send(new Otp($otp));
            session(['otp' => $otp]);

            return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP']);
        }
    }

    public function verifyOtp(Request $request)
    {
        Log::info('request: ' . $request->otp);
        Log::info('session:' . session('otp'));
        if ($request->otp == session('otp')) {
            return response()->json(['success' => true, 'message' => 'OTP verified successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }
    }

}
