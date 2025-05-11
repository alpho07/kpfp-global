<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class CustomResetPasswordController extends Controller {

    public function showResetForm(Request $request, $token = null) {
        return view('auth.passwords.reset')->with(
                        ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request) {
        // Validate the input
        $validator = Validator::make($request->all(), [
                    'token' => 'required',
                    'email' => 'required|email|exists:users,email',
                    'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Find the reset token in the password_resets table
        $passwordReset = DB::table('password_resets')
                ->where('email', $request->email)
                ->first();

        // Check if token exists and matches
        if (!$passwordReset || $passwordReset->token !== $request->token) {
            return back()->withErrors(['email' => 'Invalid or expired password reset token.']);
        }

        // Check token expiration (default 60 minutes)
        $createdAt = Carbon::parse($passwordReset->created_at);
        if ($createdAt->addMinutes(config('auth.passwords.users.expire', 60)) < now()) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return back()->withErrors(['email' => 'Password reset token has expired.']);
        }

        // Find the user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // Update the user's password
        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        // Delete the password reset token
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Your password has been reset successfully.');
    }
}
