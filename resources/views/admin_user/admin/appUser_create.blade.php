@extends('admin_user.main')
@section('main')

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.index') }}">
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
      <a class="nav-link collapsed" href="{{ route('admin.vaccine.registration', 'Dhaka') }}">
        <i class="bi bi-grid"></i>
        <span>Vaccine Registration</span>
      </a>
    </li><!-- End Dashboard Nav -->

    

    <li class="nav-heading">Property Operation</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('admin.disease_list') }}">
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
      <a class="nav-link collapsed" href="{{route('admin.center_list')}}">
        <i class="bi bi-person"></i>
        <span>Veccine Centers</span>
      </a>
    </li>


  </ul>

</aside>
<!-- End Sidebar-->





  <main id="main" class="main">

    
    <div class="pagetitle">
        <h1>App User</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">App User</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">
  
          <div class="col-lg-2"></div>
  
          <div class="col-lg-8">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Create App User Form</h5>
  
                <!-- Vertical Form -->
                <form method="POST" action="{{ route('appUser.create.post') }}" class="row g-3">
                  @csrf 
  
                  {{-- <div class="col-12">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                    @error('name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div> --}}
                  <div class="col-12">
                    <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}">
                    @error('username')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                  </div>
                  <div class="col-12">
                    <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}">
                    @error('email')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                  </div>
                  <div class="col-12">
                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                    @error('password')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                  </div>
                  <div class="col-12">
                    <label for="dob" class="form-label">Date Of Birth<span class="text-danger">*</span></label>
                    <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" id="dob" value="{{ old('dob') }}">
                    @error('dob')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                  </div>
                  <div class="col-12">
                    <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ old('phone') }}">
                    @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                  </div>
                  <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" value="{{ old('address') }}" placeholder="">
                    @error('address')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form><!-- Vertical Form -->
  
              </div>
            </div>
  
  
          </div>
  
          <div class="col-lg-2"></div>
        </div>
      </section>

  </main>


@endsection