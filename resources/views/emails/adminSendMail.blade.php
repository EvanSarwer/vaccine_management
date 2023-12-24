<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Veccine Management System</title>
</head>
<body>
    <h1>{{$mailData['title']}}</h1>
    <h4>Dear <b>{{$mailData['user_info'] ?? '' }}</b>,</h4>
    <p>{{ $mailData['message'] }}</p>

    <p>For more information please visit our website.</p>
    <p>Thank you</p>
    <p>{{$mailData['user_info'] ?? '' }} </p>
</body>
</html>