<!-- resources/views/emails/mytestmail.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Pre-Auth Uploaded</title>
</head>
<body>
    <h1>Hello! Admin</h1>

    <p>{{Auth::user()->name}} Has Just uploaded the preauthorization form, please have a look at it for verification </p>

    <p>Powered by kpfp portal</p>
</body>
</html>
