@extends('admin_user.main')
@section('main')


<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.index') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.pageProperty.edit') }}">
          <i class="bi bi-wrench-adjustable-circle"></i>
          <span>Page-Property Update</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.vaccinationStatus_list') }}">
          <i class="bi bi-grid"></i>
          <span>Vaccination Status</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.vaccine.registration', 'Dhaka') }}">
          <i class="bi bi-grid"></i>
          <span>Vaccine Registration</span>
        </a>
      </li><!-- End Dashboard Nav -->

      

      <li class="nav-heading">Property Operation</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.disease_list')}}">
          <i class="bi bi-person"></i>
          <span>Diseases</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.vaccine_list')}}">
          <i class="bi bi-person"></i>
          <span>Vaccines</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('admin.center_list', 'Dhaka')}}">
          <i class="bi bi-person"></i>
          <span>Veccine Centers</span>
        </a>
      </li>


    </ul>

  </aside>
  <!-- End Sidebar-->





<main id="main" class="main">

    <div class="pagetitle">
      <h1>Vaccine Registration - User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
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
                  <form method="POST" action="{{ route('admin.vaccine.registration.post') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                      <label for="division" class="col-md-4 col-lg-3 col-form-label">Center Area (Division)<span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <select name="division" class="form-select @error('division') is-invalid @enderror" id="division">
                          <option value="Dhaka" {{ ((old('division')) ? old('division') : $division) == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                          <option value="Chattogram" {{ ((old('division')) ? old('division') : $division) == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
                          <option value="Rajshahi" {{ ((old('division')) ? old('division') : $division) == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                          <option value="Mymensingh" {{ ((old('division')) ? old('division') : $division) == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                          <option value="Sylhet" {{ ((old('division')) ? old('division') : $division) == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                          <option value="Khulna" {{ ((old('division')) ? old('division') : $division) == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                          <option value="Rangpur" {{ ((old('division')) ? old('division') : $division) == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                          <option value="Barishal" {{ ((old('division')) ? old('division') : $division) == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                        </select>                          
                        @error('division')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                  </div>

                  <div class="row mb-3">
                    <label for="center_id" class="col-md-4 col-lg-3 col-form-label">Select Vaccine Center</label>
                    <div class="col-md-8 col-lg-9">
                      <select class="form-select @error('center_id') is-invalid @enderror" name="center_id" aria-label="Select User" id="center_id">
                        <option value="" selected>Choose Center</option>
                        @foreach ($centers as $center)
                            <option value="{{ $center['id'] }}" {{ old('center_id') == $center['id'] ? 'selected' : '' }}>
                                {{ $center['hospital'] }}
                            </option>
                        @endforeach
                      </select>

                      @error('center_id')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                </div>


                    <div class="row mb-3">
                        <label for="user_id" class="col-md-4 col-lg-3 col-form-label">Select User</label>
                        <div class="col-md-8 col-lg-9">
                          <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" aria-label="Select User" id="user_id">
                            <option value="" selected>Choose User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user['id'] }}" {{ old('user_id') == $user['id'] ? 'selected' : '' }}>
                                    {{ $user['username'] }}
                                </option>
                            @endforeach
                          </select>

                          @error('user_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>
                    

                    <div class="row mb-3">
                        <label for="vaccine_id" class="col-md-4 col-lg-3 col-form-label">Select Vaccine</label>
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


  {{-- <script>
    $(document).ready(function () {
        $('#division').change(function () {
            var selectedDivision = $(this).val();
            window.location.href = "/admin/vaccine-registration/" + selectedDivision;
        });
    });
  </script> --}}


  <script>
    $(document).ready(function () {
        $('#division').change(function () {
            var selectedDivision = $(this).val();

            // Make an AJAX request to get centers based on the selected division
            $.ajax({
                type: 'GET',
                url: "/division/to/centers/" + selectedDivision,
                dataType: 'json', // Specify the expected data type
                success: function (response) {
                    // Update the center dropdown options
                    var centerSelect = $('#center_id');
                    centerSelect.empty(); // Clear existing options
                    centerSelect.append('<option value="" selected>Choose Center</option>'); // Add default option

                    // Check if response.centers exists and is an array
                    if (response.centers && Array.isArray(response.centers)) {
                        // Add options for each center from the response
                        $.each(response.centers, function (index, center) {
                            centerSelect.append('<option value="' + center.id + '">' + center.hospital + '</option>');
                        });
                    } else {
                        console.error('Invalid response format or missing centers array.');
                    }
                },
                error: function (error) {
                    console.error('Error fetching centers:', error);
                }
            });
        });
    });
</script>





@endsection