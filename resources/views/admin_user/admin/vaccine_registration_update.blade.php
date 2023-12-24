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
        <a class="nav-link" href="{{ route('admin.vaccinationStatus_list') }}">
          <i class="bi bi-grid"></i>
          <span>Vaccination Status</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.vaccine.registration') }}">
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
      <h1>Vaccination Update</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
          <li class="breadcrumb-item">Item</li>
          <li class="breadcrumb-item active">Vaccination Update</li>
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Update Vaccination Info</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{ route('admin.vaccine.registration.update.post') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $vaccine_take->id }}">

                    <div class="row mb-3">
                        <label for="user_id" class="col-md-4 col-lg-3 col-form-label">User</label>
                        <div class="col-md-8 col-lg-9">
                          
                          <select class="form-select  @error('user_id') is-invalid @enderror" name="user_id" disabled aria-label="Select User" id="user_id">
                            <option value="" selected>Choose User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user['id'] }}" {{ (old('user_id')) ? (old('user_id') == $user['id'] ? 'selected' : '') : ($vaccine_take->user_id == $user['id'] ? 'selected' : '') }}>
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
                          
                          <select class="form-select @error('vaccine_id') is-invalid @enderror" name="vaccine_id" {{ $vaccine_take->completed_doses <= 0 ? '' : 'disabled' }} aria-label="Select Vaccine" id="vaccine_id">
                            <option value="" selected>Choose Vaccine</option>
                            @foreach ($vaccines as $vaccine)
                                <option value="{{ $vaccine['id'] }}" {{ (old('vaccine_id')) ? (old('vaccine_id') == $vaccine['id'] ? 'selected' : '') : ($vaccine_take->vaccine_id == $vaccine['id'] ? 'selected' : '') }}>
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
                        <label for="division" class="col-md-4 col-lg-3 col-form-label">Center Area (Division)</label>
                        <div class="col-md-8 col-lg-9">
                            <select name="division" {{ $vaccine_take->completed_doses <= 0 ? '' : 'disabled' }} class="form-select @error('division') is-invalid @enderror" id="division">
                                <option value="Dhaka" {{ ((old('division')) ? old('division') : $vaccine_take->division) == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                                <option value="Chattogram" {{ ((old('division')) ? old('division') : $vaccine_take->division) == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
                                <option value="Rajshahi" {{ ((old('division')) ? old('division') : $vaccine_take->division) == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                                <option value="Mymensingh" {{ ((old('division')) ? old('division') : $vaccine_take->division) == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                                <option value="Sylhet" {{ ((old('division')) ? old('division') : $vaccine_take->division) == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                                <option value="Khulna" {{ ((old('division')) ? old('division') : $vaccine_take->division) == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                                <option value="Rangpur" {{ ((old('division')) ? old('division') : $vaccine_take->division) == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                                <option value="Barishal" {{ ((old('division')) ? old('division') : $vaccine_take->division) == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                            </select>
                          @error('division')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Dose Details</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row g-3">

                          <div class="col-md-4">
                            <label for="first_dose_date" class="form-label">First Dose<span class="text-danger">*</span></label>
                            <input type="date" name="first_dose_date" {{ $vaccine_take->completed_doses <= 0 ? '' : 'disabled' }} class="form-control @error('first_dose_date') is-invalid @enderror" id="first_dose_date" value="{{ (old('first_dose_date')) ? old('first_dose_date') : $vaccine_take->first_dose_date }}" >
                            @error('first_dose_date')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>

                          <div class="col-md-4">
                            <label for="completed_doses" class="form-label">Completed Dose</label>
                            <input type="text" name="completed_doses" class="form-control @error('completed_doses') is-invalid @enderror" id="completed_doses" value="{{ (old('completed_doses')) ? old('completed_doses') : $vaccine_take->completed_doses }}" >
                            @error('completed_doses')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          {{-- <div class="col-md-4">
                            <label for="dose_gap_time" class="form-label">Timeline</label>
                            <select name="dose_gap_time" class="form-select @error('dose_gap_time') is-invalid @enderror" id="dose_gap_time">
                                <option value="day" {{ ((old('dose_gap_time')) ? old('dose_gap_time') : $vaccine->dose_gap_time) == 'day' ? 'selected' : '' }}>Day</option>
                                <option value="month" {{ ((old('dose_gap_time')) ? old('dose_gap_time') : $vaccine->dose_gap_time) == 'month' ? 'selected' : '' }}>Month</option>
                                <option value="year" {{ ((old('dose_gap_time')) ? old('dose_gap_time') : $vaccine->dose_gap_time) == 'year' ? 'selected' : '' }}>Year</option>
                            </select>
                            @error('dose_gap_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div> --}}
                        </div>
                        
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



@endsection