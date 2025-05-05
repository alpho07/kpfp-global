<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>KPFP - Candidate Shortlisted</title>
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
                <h2>Scholarship Application Status Update</h2>
            </div>

            <div class="content">
                <p>Dear {{ $user }},</p>

                <p>We're excited to inform you that your have successfully been shortlisted to be enrolled for <strong>{{ $courseName }}</strong> course.</p>
           
                <p>The institution you enrolled in will be in contact with you and ask you to do the following:</p>
                <ul>
                    <li>Download the bonding form</li>
                    <li>Fill it in <strong>triplicates</strong></li>
                    <li>Upload the completed form together with the <strong>Release Form</strong></li>
                </ul>

                <p>Keep checking your email regularly for important updates and next steps.</p>

                <p>We wish you all the best.</p>

                <p>Warm regards,<br>
                    <strong>KPFP Admissions Team</strong></p>
            </div>

            <div class="footer">
                &copy; {{ date('Y') }} Kenya Public Fellowship Program. All rights reserved.
            </div>
        </div>
    </body>
</html>
