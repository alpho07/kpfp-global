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
            <div class="header" style="background: green;color:white;">
                <h2>{{$courseName}} Application Accepted</h2>
            </div>

            <div class="content">
                <p>Dear {{ $user }},</p>

                <p>Thank you for applying to join the <strong>Kenya Public Fellowship Program (KPFP)</strong>. We're excited to inform you that your application to be enrolled in the <strong>{{ $courseName }}</strong> course has been successful.</p>

                <p>The course you selected will take approximately <strong>{{ $courseDuration }} </strong> to complete.</p>

                <p>For the next steps: </p>
                <ul>
                    <li>Login to your KPFP Portal</li>
                    <li>Find the application listing in your portal applications for the selected institution</li>
                    <li>Download the bonding form from the link named  "Download" under "Bonding Form" column</li>
                    <li>Fill in the bonding form<li>
                    <li>Scan the <b>Bonding form</b> together with the <b>Release form</b> </li>
                    <li>Upload the scanned documents using the link in the column "Bonding Form"</b> </li>
                    <li>Wait to be contacted by the institution for Admission information</b> </li>
                </ul>

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
