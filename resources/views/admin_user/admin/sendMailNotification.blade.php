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
        <h1>Send Mail -Notification</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
            <li class="breadcrumb-item">Notification</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">
  
          <div class="col-lg-2"></div>
  
          <div class="col-lg-8">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Send Reply Mail -Notice</h5>
  
                <!-- Vertical Form -->
                <form method="POST" action="{{ route('admin.send.email.notification.post') }}" class="row g-3">
                  @csrf 
  
                  
                  <div class="col-12">
                    <label for="subject" class="form-label">Main Subject<span class="text-danger">*</span></label>
                    <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" id="subject" value="{{ old('subject') }}">
                    @error('subject')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <label for="email" class="form-label">Receiver Email<span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ (old('email')) ? old('email') : $email }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <label for="message" class="form-label">Notice Message</label>
                    <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" style="height: 100px">{{ old('message') }}</textarea>
                    @error('message')
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