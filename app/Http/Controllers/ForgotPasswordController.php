<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgotPasswordForm(){
        return view('forgot_password');
    }


    public function sendResetLink(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);

        // dd($token);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,

        ]);

        $name = DB::table('users')->where('email', $request->email)->value('name');

        $resetLink = url('/reset-password-form/' . $token);
        Mail::send('emails.reset-password', ['resetLink' => $resetLink, 'name' => $name], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Reset Password');
        });

        return back()->with('success', 'Password reset link sent successfully!');
    }


    public function showResetForm($token)
{
    return view('reset-password-form', ['token' => $token]);
}


public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email|exists:password_resets,email',
        'password' => 'required|confirmed|min:6',
    ]);

    $reset = DB::table('password_resets')->where([
        ['email', $request->email],
        ['token', $request->token],
    ])->first();

    if (!$reset) {
        return back()->withErrors(['email' => 'Invalid token or email. Please try again']);
    }


    DB::table('users')->where('email', $request->email)->update([
        'password' => Hash::make($request->password),
    ]);


    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect('/')->with('success', 'Password reset successfully.');
}
}
