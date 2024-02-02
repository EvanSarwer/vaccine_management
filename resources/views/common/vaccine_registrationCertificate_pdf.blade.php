<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Completion Certificate</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 20px;
        }

        .certificate {
            border: 2px solid #0066cc;
            padding: 20px;
            text-align: center;
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #0066cc;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }

        .text-success {
            color: #28a745;
        }

        .certificate-info {
            margin-top: 20px;
        }

        .certificate-info h4 {
            color: #0066cc;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>Vaccination Completion Certificate</h1>

        <p>This is to certify that</p>
        <h2>{{ $vaccine_take->user->username }}</h2>
        <p>has successfully completed the required doses of the</p>
        <h3>{{ $vaccine_take->vaccine->name }} Vaccine</h3>

        <div class="certificate-info">
            <h4>Vaccination Details:</h4>
            <p>Completed Doses: {{ $vaccine_take->completed_doses }}</p>
            <p>Vaccination Status: <span class="text-success">{{ $vaccine_take->vaccine_status }}</span></p>
            <p>Disease Name: {{ $vaccine_take->vaccine->disease->name }}</p>
            <p>Completion Date: {{ $dose_date_details[$vaccine_take->completed_doses - 1]->dose_date }}</p>
        </div>

        <p>Issued on {{ now()->format('F d, Y') }}</p>
    </div>
</body>
</html>
