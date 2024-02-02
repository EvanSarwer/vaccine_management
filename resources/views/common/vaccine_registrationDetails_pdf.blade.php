{{-- 
                <div class="d-flex justify-content-center py-4">
                  
                    <h3 class="d-none d-lg-block">Vaccine Management Syatem</h3>
                  
                </div><!-- End Logo -->

                <h4 class="card-title">Vaccination - Registration Details</h4>
   --}}
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccine Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 20px;
        }

        h2 {
            color: rgb(56, 31, 218);
            text-align: center;
            margin-bottom: 20px;
        }

        h5 {
            color: #0066cc;
            margin: 5px 0;
            line-height: 1.2;
        }

        h6 {
            margin: 3px 0;
            line-height: 1.2;
        }

        .text-primary {
            color: #0066cc;
        }

        .text-success {
            color: #28a745;
        }

        .text-warning {
            color: #ffc107;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Vaccine Management System</h2>
       <table>
           <tr>
               <th colspan="2"><h6>Registration ID: #{{ $vaccine_take->id }}</h6></th>
           </tr>
           <tr>
               <td colspan="2"><h6>Registration Date: {{ $vaccine_take->order_date }}</h6></td>
           </tr>
       </table>
   
       <table>
           <tr>
               <th colspan="2"><h5 class="text-primary">User Details:</h5></th>
           </tr>
           @if($vaccine_take->user->role == 'user')
                <tr>
                    <td><h6>Name: {{ $vaccine_take->user->username }}</h6></td>
                    <td><h6>Email: {{ $vaccine_take->user->email }}</h6></td>
                </tr>
                <tr>
                    <td><h6>Phone: {{ $vaccine_take->user->phone }}</h6></td>
                    <td><h6>Address: {{ $vaccine_take->user->address }}</h6></td>
                </tr>
            @else
                <tr>
                    <td><img src="{{ (!empty($vaccine_take->patient_photo)) ? url('page_assets/img/'.$vaccine_take->patient_photo) : url('upload/No_Image_Available.jpg') }}" alt="Preview" class="img-fluid" style="max-width: 100px;"></td>
                    <td><h6>Patient Name: {{ $vaccine_take->patient_name }}</h6></td>
                </tr>
                <tr>
                    <td><h6>Patient Phone: {{ $vaccine_take->patient_phone }}</h6></td>
                    <td><h6>Patient Address: {{ $vaccine_take->patient_address }}</h6></td>
                </tr>
            @endif


       </table>
   
       <table>
           <tr>
               <th colspan="2"><h5 class="text-primary">Vaccine Details:</h5></th>
           </tr>
           <tr>
               <td><h6>Name: {{ $vaccine_take->vaccine->name }}</h6></td>
               <td><h6>Center: {{ $vaccine_take->center->hospital }}</h6></td>
           </tr>
           <tr>
               <td><h6>Disease Name: {{ $vaccine_take->vaccine->disease->name }}</h6></td>
               <td><h6>Address: {{ $vaccine_take->center->address ?? 'N/A' }}</h6></td>
           </tr>
           <tr>
               <td><h6>Required Doses: {{ $vaccine_take->vaccine->doses_required }}</h6></td>
               <td><h6>Phone: {{ $vaccine_take->center->phone ?? 'N/A' }}</h6></td>
           </tr>
           <tr>
               <td><h6>Completed Doses: {{ $vaccine_take->completed_doses }}</h6></td>
               <td><h6>Email: {{ $vaccine_take->center->email ?? 'N/A' }}</h6></td>
           </tr>
       </table>
   
       <table>
           <tr>
               <th><h5 class="text-primary">Doses Schedule:</h5></th>
           </tr>
           @foreach ($dose_date_details as $dose)
               <tr>
                   <td>
                        <h6>
                            {{ $dose->dose_number }}-dose Date: {{ $dose->dose_date }}
                            @if($dose->dose_status == 'Completed')
                                <small class="text-success">Completed</small>
                            @else
                                <small class="text-info">Pending</small>
                            @endif
                        </h6>
                   </td>
               </tr>
           @endforeach
       </table>
   
       <table>
           <tr>
               <th><h5>Vaccination Status: <small class="h5 {{ $vaccine_take->vaccine_status == 'Completed' ? 'text-success' : 'text-danger'}}">{{ $vaccine_take->vaccine_status}}</small></h5></th>
           </tr>
       </table>
   </body>
   </html>
   