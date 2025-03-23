<!-- resources/views/emails/mytestmail.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPFP|Gertrude Scholarship Message Center!</title>
</head>

<body>

    <p>Dear Applicant,<br>
        You have a new message from Gertrude's KPFP regarding your application<br>
    <p>
        <a href="{{ route('messaging.inbox',[$param1,$param2]) }}?inbox=xVwc12TYD9"
            style="background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 5px;">
            View Message
        </a>
    </p>

    </p>

    <p>Powered by KPFP portal</p>
</body>

</html>
