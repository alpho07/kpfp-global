<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\CustomResetPasswordMail;
use App\Services\ZohoMailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;

class CustomForgotPasswordController extends Controller {

    public function showLinkRequestForm() {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request) {
        // Validate the email input
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Generate a reset token
        $token = Str::random(64);

        // Store the token in the password_resets table
        DB::table('password_resets')->updateOrInsert(
                ['email' => $request->email],
                [
                    'email' => $request->email,
                    'token' => $token, // Store the unhashed token
                    'created_at' => now(),
                ]
        );

        // Find the user
        $user = User::where('email', $request->email)->first();

        // Send the reset email using ZohoMailService
        try {
            $zoho = app(ZohoMailService::class);
            $mailable = new CustomResetPasswordMail($token, $request->email);
            $zoho->sendMailable($request->email, $mailable);

            return back()->with(['status' => 'Password reset link sent successfully.']);
        } catch (\Exception $e) {
            \Log::error('Failed to send password reset email: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Unable to send password reset link. Please try again later.']);
        }
    }
}
