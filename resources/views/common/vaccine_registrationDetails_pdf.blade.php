<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('admin_assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('admin_assets/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('admin_assets/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">

            




            <div class="card">
              <div class="card-body">
                <br/>
                <div class="d-flex justify-content-center py-4">
                  <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="assets/img/logo.png" alt="">
                    <span class="d-none d-lg-block">Vaccine Management Syatem</span>
                  </a>
                </div><!-- End Logo -->
                <h4 class="card-title">Vaccination - Registration Details</h4>
  
                <!-- Vertical Form -->
                <form method="POST" action="" class="row">
                  @csrf 
  
                
                  <div class="col">
                    <h6 class="">Registration ID: #{{ $vaccine_take->id }}</h6>
                    <h6 class="">Registration Date: {{ $vaccine_take->order_date }}</h6>
                  </div>

                <br/>
                <br/>
                  <div class="col-12 row">
                    <h5 class="text-primary">User Details:</h5>
                    <div class="col-5">
                        <h6>Name: {{ $vaccine_take->user->username }}</h6>
                        <h6>Email: {{ $vaccine_take->user->email }}</h6>
                    </div>
                    <div class="col-2">
                    </div>
                    <div class="col-5">
                        <h6>Phone: {{ $vaccine_take->user->phone }}</h6>
                        <h6>Address: {{ $vaccine_take->user->address }}</h6>
                    </div>
                  </div>

                  <br/>
                <br/>
                  <div class="col-12 row">
                    <h5 class="text-primary">Vaccine Details:</h5>
                    <div class="col-5">
                        <h6>Name: {{ $vaccine_take->vaccine->name }}</h6>
                        <h6>Required Doses: {{ $vaccine_take->vaccine->doses_required }}</h6>
                        <h6>Completed Doses: {{ $vaccine_take->completed_doses }}</h6>
                    </div>
                    <div class="col-2">
                    </div>
                    <div class="col-5">
                        <h6>Center: {{ $vaccine_take->center->hospital}}</h6>
                        <h6>Address: {{ $vaccine_take->center->address ?? 'N/A' }}</h6>
                        <h6>Phone: {{ $vaccine_take->center->phone ?? 'N/A' }}</h6>
                        <h6>Email: {{ $vaccine_take->center->email ?? 'N/A' }}</h6>
                    </div>
                  </div>

                  <br/>
                <br/>
                  <div class="col-12 row">
                    
                    <h5 class="text-primary">Doses Schedule:</h5>

                    @foreach ($vaccine_doses as $dose)

                    <h6>
                        {{ $dose->dose_number }}-dose Date: {{ $dose->dose_date }}
                        @if($vaccine_take->completed_doses >= $dose->dose_number)
                            <small class="text-success">Done</small>
                        @endif
                    </h6>

                    @endforeach

                  </div>

                
                <br/>
                <br/>
                  <div class="col-12 mt-5 row">
                    <div class="col-6">
                        <h5 class="">Vaccination Status: <small class="h5 {{ $vaccine_take->vaccine_status == 'Completed' ? 'text-success' : 'text-warning'}}">{{ $vaccine_take->vaccine_status}}</small></h5>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-4">
                        {{-- @if($vaccine_take->vaccine_status == 'Completed')
                            <a href="" class="btn btn-primary">Download Certificate</a>
                        @else
                            <a href="" class="btn btn-primary">Download Vaccination Status</a>
                        @endif --}}
                    </div>
                  </div>
                  

                </form><!-- Vertical Form -->
  
              </div>
            </div>










          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('admin_assets/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('admin_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin_assets/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('admin_assets/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('admin_assets/assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('admin_assets/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('admin_assets/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('admin_assets/assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('admin_assets/assets/js/main.js') }}"></script>

</body>

</html>