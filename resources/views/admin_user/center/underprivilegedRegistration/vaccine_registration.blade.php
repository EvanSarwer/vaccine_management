@extends('admin_user.main')
@section('main')


<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('center.index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('center.vaccine.stock.list') }}">
          <i class="bi bi-grid"></i>
          <span>Vaccine Stock</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('center.vaccine.registration') }}">
          <i class="bi bi-grid"></i>
          <span>Vaccine Registration</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="{{ route('center.underprivileged.vaccine.registration') }}">
          <i class="bi bi-grid"></i>
          <span>Vaccine Registration (Underprivileged)</span>
        </a>
      </li><!-- End Dashboard Nav -->



      <li class="nav-heading">Property Operation</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('center.vaccine_list')}}">
          <i class="bi bi-person"></i>
          <span>Vaccines</span>
        </a>
      </li>


    </ul>

  </aside>
  <!-- End Sidebar-->





<main id="main" class="main">

    <div class="pagetitle">
      <h1>Vaccine Registration - Underprivileged User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('center.index') }}">Home</a></li>
          <li class="breadcrumb-item">Item</li>
          <li class="breadcrumb-item active">Veccine Registration</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
              <div class="card recent-sales overflow-auto">

              <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Vaccine Registration</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{ route('center.underprivileged.vaccine.registration.post') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                      <label for="vaccine_id" class="col-md-4 col-lg-3 col-form-label">Select Image<span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <div x-data="{ patient_photo: '{{ url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                      
                          <div class="col-md-12 col-lg-9">
                            <img x-bind:src="patient_photo" alt="Profile" class="img-responsive" style="max-width: 150px; max-height: 100px;">
                                  
                            <div class="pt-2">
                              <input x-on:change="patient_photo = URL.createObjectURL($event.target.files[0])" name="patient_photo" type="file" class="form-control @error('patient_photo') is-invalid @enderror" id="patient_photo">
                              @error('patient_photo')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="row mb-3">
                    <label for="patient_name" class="col-md-4 col-lg-3 col-form-label">Patient Name<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="patient_name" type="text" class="form-control @error('patient_name') is-invalid @enderror" id="patient_name" value="{{ old('patient_name') }}">
                      @error('patient_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="patient_phone" class="col-md-4 col-lg-3 col-form-label">Patient Phone<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="patient_phone" type="text" class="form-control @error('patient_phone') is-invalid @enderror" id="patient_phone" value="{{ old('patient_phone') }}">
                      @error('patient_phone')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="patient_address" class="col-md-4 col-lg-3 col-form-label">Patient Address<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="patient_address" type="text" class="form-control @error('patient_address') is-invalid @enderror" id="patient_address" value="{{ old('patient_address') }}">
                      @error('patient_address')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="patient_dob" class="col-md-4 col-lg-3 col-form-label">Date of Birth<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="patient_dob" type="date" class="form-control @error('patient_dob') is-invalid @enderror" id="patient_dob" value="{{ old('patient_dob') }}">
                      @error('patient_dob')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="patient_nid" class="col-md-4 col-lg-3 col-form-label">NID / BID<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <input name="patient_nid" type="text" class="form-control @error('patient_nid') is-invalid @enderror" id="patient_nid" value="{{ old('patient_nid') }}">
                      @error('patient_nid')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="vaccine_id" class="col-md-4 col-lg-3 col-form-label">Select Vaccine<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      {{-- <input name="vaccine_id" type="text" class="form-control @error('vaccine_id') is-invalid @enderror" id="vaccine_id" value="{{ $disease->name }}"> --}}
                      <select class="form-select @error('vaccine_id') is-invalid @enderror" name="vaccine_id" aria-label="Select Vaccine" id="vaccine_id">
                        <option value="" selected>Choose Vaccine</option>
                        @foreach ($vaccines as $vaccine)
                            <option value="{{ $vaccine['id'] }}" {{ old('vaccine_id') == $vaccine['id'] ? 'selected' : '' }}>
                                {{ $vaccine['name'] }}
                            </option>
                        @endforeach
                      </select>

                      @error('vaccine_id')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                </div>

                    <div class="row mb-3">
                      <label for="division" class="col-md-4 col-lg-3 col-form-label">Center Area (Division)<span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <select name="division" class="form-select @error('division') is-invalid @enderror" id="division">
                          <option value="" selected>Choose Division</option>
                          <option value="Dhaka" {{ old('division') == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                          <option value="Chattogram" {{ old('division') == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
                          <option value="Rajshahi" {{ old('division') == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                          <option value="Mymensingh" {{ old('division') == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                          <option value="Sylhet" {{ old('division') == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                          <option value="Khulna" {{ old('division') == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                          <option value="Rangpur" {{ old('division') == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                          <option value="Barishal" {{ old('division') == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                        </select>                          
                        @error('division')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                  </div>

                  <div class="row mb-3">
                    <label for="center_id" class="col-md-4 col-lg-3 col-form-label">Select Vaccine Center<span class="text-danger">*</span></label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-select @error('center_id') is-invalid @enderror" name="center_id" aria-label="Select Center" id="center_id">
                        <option value="" selected>Choose Center</option>
                    </select>

                      @error('center_id')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                </div>

                    



                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>



              </div><!-- End Bordered Tabs -->

            </div>
          </div>








        </div>
      </div><!-- End Left side columns -->

        <!-- Right side columns -->
        

    </div>

  </section>

</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
  $(document).ready(function () {
      // Function to update centers based on the selected division
      function updateCenters(selectedDivision, selectedCenter) {
          $.ajax({
              type: 'GET',
              url: "/division/to/centers/" + selectedDivision,
              success: function (response) {
                  var centerSelect = $('#center_id');
                  centerSelect.empty();
                  centerSelect.append('<option value="" selected>Choose Center</option>');

                  $.each(response, function (index, center) {
                      centerSelect.append('<option value="' + center.id + '" ' + (center.id == selectedCenter ? 'selected' : '') + '>' + center.hospital + '</option>');
                  });
              },
              error: function (error) {
                  console.error('Error fetching centers:', error);
              }
          });
      }

      // Get the old division and center values
      var oldDivision = "{{ old('division') }}";
      var oldCenter = "{{ old('center_id') }}";

      // Initial load with old division and center values
      updateCenters(oldDivision, oldCenter);

      // Handle division change
      $('#division').change(function () {
          var selectedDivision = $(this).val();
          updateCenters(selectedDivision, ''); // Clear center selection when division changes
      });

      // Handle center change
      $('#center_id').change(function () {
          // You may want to add logic here to handle changes to the selected center if needed
      });
  });
</script>






@endsection