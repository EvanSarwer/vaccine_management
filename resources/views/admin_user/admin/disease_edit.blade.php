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
        <a class="nav-link" href="{{ route('admin.disease_list') }}">
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
        <h1>Disease</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Update Disease Info</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">
  
          <div class="col-lg-2"></div>
  
          <div class="col-lg-8">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Update Disease Info</h5>
  
                <!-- Vertical Form -->
                <form method="POST" action="{{ route('admin.disease.edit.post') }}" class="row g-3">
                  @csrf 
  
                  <input type="hidden" name="id" value="{{ $disease->id }}">

                  <div class="col-12">
                    <label for="name" class="form-label">Disease Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ (old('name')) ? old('name') : $disease->name }}">
                    @error('name')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                  </div>


                  <div class="col-12">
                    <label for="symptoms" class="form-label">Symptoms</label>
                    <textarea name="symptoms" class="form-control @error('symptoms') is-invalid @enderror" id="symptoms" style="height: 100px">{{ (old('symptoms')) ? old('symptoms') : $disease->symptoms }}</textarea>
                    @error('symptoms')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label for="prevention" class="form-label">Prevention</label>
                    <textarea name="prevention" class="form-control @error('prevention') is-invalid @enderror" id="prevention" style="height: 100px">{{ (old('prevention')) ? old('prevention') : $disease->prevention }}</textarea>
                    @error('prevention')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label for="treatment" class="form-label">Treatment</label>
                    <textarea name="treatment" class="form-control @error('treatment') is-invalid @enderror" id="treatment" style="height: 100px">{{ (old('treatment')) ? old('treatment') : $disease->treatment }}</textarea>
                    @error('treatment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" style="height: 100px">{{ (old('description')) ? old('description') : $disease->description }}</textarea>
                    @error('description')
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