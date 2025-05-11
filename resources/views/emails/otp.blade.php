<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome to KPFP</title>
        <style>
            body {
                font-family: 'Segoe UI', sans-serif;
                background-color: #f9f9f9;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 90%;
                max-width: 600px;
                margin: 30px auto;
                background: #fff;
                border-radius: 8px;
                padding: 30px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            }
            .header {
                background-color: #0077b6;
                padding: 20px;
                color: white;
                border-radius: 8px 8px 0 0;
                text-align: center;
            }
            .content {
                line-height: 1.7;
            }
            .cta {
                background-color: #0077b6;
                color: white;
                padding: 12px 20px;
                border-radius: 6px;
                text-decoration: none;
                display: inline-block;
                margin-top: 20px;
            }
            .footer {
                font-size: 13px;
                text-align: center;
                margin-top: 30px;
                color: #777;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header" style='background:green; color:white;'>
                <h2>Welcome to KPFP Scholarships Portal</h2>
            </div>

            <div class="content">
                <p>Dear {{ $user }},</p>

                <p>Thank you for registering at <strong>Kenya Paediatric Fellowship Program (KPFP) Scholarships Portal</strong>. </p>

                <p>Welcome to acknowledge your application joining your fellow Applicants. Through the portal you have access to massive scholarships in various institutions that are fully provided you meet the scholarship needs</p>

                <p>Before you proceed however, Your registration details needs to be verified. Please enter the <strong>Verification Code</strong> sent to you in this email</p>

                <p>Your Verification Code is:<strong><h4>{{$otp}}</h4></strong></p>

                <p>Keep checking your email regularly for important updates and next steps.</p>

                <p>We wish you all the best in your application process!</p>

                <p>Warm regards,<br>
                    <strong>KPFP Admissions Team</strong></p>
            </div>

            <div class="footer">
                &copy; {{ date('Y') }} Kenya Paediatric Fellowship Program. All rights reserved.
            </div>
        </div>
    </body>
</html>
