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
      <a class="nav-link collapsed" href="{{ route('admin.vaccine.registration') }}">
        <i class="bi bi-grid"></i>
        <span>Vaccine Registration</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.underprivileged.vaccine.registration') }}">
        <i class="bi bi-grid"></i>
        <span>Vaccine Registration (Underprivileged)</span>
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
      <a class="nav-link" href="{{route('admin.center_list', 'Dhaka')}}">
        <i class="bi bi-person"></i>
        <span>Veccine Centers</span>
      </a>
    </li>


  </ul>

</aside>
<!-- End Sidebar-->





<main id="main" class="main" style="min-height: 85vh">

    <div class="pagetitle">
      <h1>Center</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
          <li class="breadcrumb-item active">Center</li>
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Update Vaccine Info</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{ route('admin.center.edit.post') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $center->id }}">


                    <div class="row mb-3">
                      <label for="hospital" class="col-md-4 col-lg-3 col-form-label">Hospital/Center Name<span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="hospital" type="text" class="form-control @error('hospital') is-invalid @enderror" id="hospital" value="{{ (old('hospital')) ? old('hospital') : $center->hospital }}">
                        @error('hospital')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                        <label for="division" class="col-md-4 col-lg-3 col-form-label">Select Division<span class="text-danger">*</span></label>
                        <div class="col-md-8 col-lg-9">
                          
                          <select name="division" class="form-select @error('division') is-invalid @enderror" id="division">
                            <option value="Dhaka" {{ ((old('division')) ? old('division') : $center->division) == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                            <option value="Chattogram" {{ ((old('division')) ? old('division') : $center->division) == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
                            <option value="Rajshahi" {{ ((old('division')) ? old('division') : $center->division) == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                            <option value="Mymensingh" {{ ((old('division')) ? old('division') : $center->division) == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                            <option value="Sylhet" {{ ((old('division')) ? old('division') : $center->division) == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                            <option value="Khulna" {{ ((old('division')) ? old('division') : $center->division) == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                            <option value="Rangpur" {{ ((old('division')) ? old('division') : $center->division) == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                            <option value="Barishal" {{ ((old('division')) ? old('division') : $center->division) == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                          </select>
                          
                          @error('division')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-lg-3 col-form-label">Address<span class="text-danger">*</span></label>
                        <div class="col-md-8 col-lg-9">
                          <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" value="{{ (old('address')) ? old('address') : $center->address }}">
                          @error('address')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="location_link" class="col-md-4 col-lg-3 col-form-label">Location Link (Embed Map)<span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="location_link" class="form-control @error('location_link') is-invalid @enderror" id="location_link" style="height: 100px">{{ (old('location_link')) ? old('location_link') : $center->location_link }}</textarea>
                        @error('location_link')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                      </div>
                    </div>

            


                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row g-2">
                          <div class="col-md-6">
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ (old('email')) ? old('email') : $center->email }}" >
                            @error('email')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        </div>
                        
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone<span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row g-2">
                          <div class="col-md-6">
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ (old('phone')) ? old('phone') : $center->phone }}" >
                            @error('phone')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
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