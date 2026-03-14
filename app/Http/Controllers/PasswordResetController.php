<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    // Forgot Password - send reset link
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(64);
            $user->update(['reset_token' => $token, 'reset_token_expires_at' => now()->addHour()]);

            $resetUrl = config('app.frontend_url') . '/reset-password?token=' . $token . '&email=' . urlencode($user->email);

            Mail::send('emails.reset-password', ['user' => $user, 'resetUrl' => $resetUrl], function ($m) use ($user) {
                $m->to($user->email)->subject('Reset Your Password - UM Tagum Portal');
            });
        }

        return response()->json(['message' => 'If this email exists, a reset link has been sent.']);
    }

    // Reset Password - update password using token
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)
                    ->where('reset_token', $request->token)
                    ->where('reset_token_expires_at', '>', now())
                    ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid or expired reset token.'], 422);
        }

        $user->update([
            'password'               => Hash::make($request->password),
            'reset_token'            => null,
            'reset_token_expires_at' => null,
        ]);

        return response()->json(['message' => 'Password reset successfully.']);
    }

    // Self Register - user submits email, gets access code via email
    public function selfRegister(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Generate 6-digit access code
        $accessCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Create user with no password yet
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make(Str::random(32)),
            'access_code' => $accessCode,
        ]);

        // Send access code via email
        Mail::send('emails.access-code', ['user' => $user, 'accessCode' => $accessCode], function ($m) use ($user) {
            $m->to($user->email)->subject('Your Access Code - UM Tagum Portal');
        });

        return response()->json(['message' => 'Access code sent to your email!']);
    }

    // Create Password - user enters access code and sets password
    public function createPassword(Request $request)
    {
        $request->validate([
            'email'       => 'required|email',
            'access_code' => 'required',
            'password'    => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)
                    ->where('access_code', $request->access_code)
                    ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid access code or email.'], 422);
        }

        $user->update([
            'password'    => Hash::make($request->password),
            'access_code' => null,
        ]);

        return response()->json(['message' => 'Password created successfully! You can now login.']);
    }
}