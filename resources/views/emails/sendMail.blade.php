<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Veccine Management Sys</title>
</head>
<body>
    <h1>{{$mailData['title']}}</h1>
    <h4>Dear <b>{{$mailData['user_name']}}</b>,</h4>
    <p>You are applying for this <b>{{ $mailData['vaccine']}} vaccine</b> by our system at <b>{{$mailData['registration_date']}}.</p>
    <p>Your application is successfully submitted.</p>
    @if(isset($mailData['first_dose_date']) )
        <h5>Your First Dose Date: <b>{{$mailData['first_dose_date']}}</b></h5>
    @else
        <h5>Your Next Dose Date: <b>{{$mailData['next_dose_date']}}</b></h5>
    @endif

    @if(isset($mailData['status']))
        <h4>Vaccination Status: <b>{{$mailData['status']}}</b></h4>
    @endif
    <p>For more information please visit our website.</p>


    <p>Vaccine Management System is a unified vaccine management initiative that aims to ensure the availability of vaccines for all children in Bangladesh. The system is designed to provide real-time information on vaccine stocks and flows, and to facilitate the timely procurement and distribution of vaccines. The system is also designed to provide real-time information on vaccine stocks and flows, and to facilitate the timely procurement and distribution of vaccines. The system is also designed to provide real-time information on vaccine stocks and flows, and to facilitate the timely procurement and distribution of vaccines. The system is also designed to provide real-time information on vaccine stocks and flows, and to facilitate the timely procurement and distribution of vaccines. The system is also designed to provide real-time information on vaccine stocks and flows, and to facilitate the timely procurement and distribution of vaccines.</p>
    <p>Thank you</p>
</body>
</html>