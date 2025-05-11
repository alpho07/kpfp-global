<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
    <style>
        .container { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        .button { display: inline-block; padding: 10px 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; }
        .footer { margin-top: 20px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Your Password</h2>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <p>
            <a href="{{ $resetUrl }}" class="button">Reset Password</a>
        </p>
        <p>This password reset link will expire in {{ $expireMinutes }} minutes.</p>
        <p>If you did not request a password reset, no further action is required.</p>
        <div class="footer">
            <p>Regards,<br>{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>