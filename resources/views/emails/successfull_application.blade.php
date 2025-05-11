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
            <div class="header">
                <h2>Welcome to KPFP Scholarship Platform</h2>
            </div>

            <div class="content">
                <p>Dear {{ $user }},</p>

                <p>Thank you for applying to join the <strong>Kenya Public Fellowship Program (KPFP) Scholarship Program</strong>. We're excited to inform you that your application to be enrolled in the <strong>{{ $courseName }}</strong> course has been started successfully.</p>

                <p>The course you selected will take approximately <strong>{{ $courseDuration }} </strong> to complete.</p>

                <p>From your portal, please download the Pre-Auth Unsigned Form. Take it to the relevant authorities to sign off then come back and upload it to the system through your portal</p>

                <p><strong>Please ensure that you pay the required application fee (if applicable)</strong>. Applications without the fee may not be considered for vetting.</p>

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
