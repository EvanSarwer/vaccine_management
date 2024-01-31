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
      <a class="nav-link" href="{{ route('admin.vaccinationStatus_list') }}">
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
        <h1>Vaccination Details -User</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Vaccination Details</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">
        <div class="row">
  
          <div class="col-lg-2"></div>
  
          <div class="col-lg-8">
  
            <div class="card">
              <div class="card-body">
                <br/>
                <h4 class="text-center" > Vaccine Management System </h4>
                <h5 class="card-title">Vaccination Details</h5>
  
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
                        
                    </div>
                    <div class="col-2">
                    </div>
                    <div class="col-5">
                        <h6>Disease: {{ $vaccine_take->vaccine->disease->name}}</h6>
                        <h6>Completed Doses: {{ $vaccine_take->completed_doses }}</h6>
                    </div>
                  </div>

                  <br/>
                <br/>
                  <div class="col-12 row">
                    <h5 class="text-primary">Center Details:</h5>

                    <div class="col-5">
                      <h6>Center: <b>{{ $vaccine_take->center->hospital}}</b></h6>
                      <h6>Address: {{ $vaccine_take->center->address ?? 'N/A' }}</h6>
                      <h6>Phone: {{ $vaccine_take->center->phone ?? 'N/A' }}</h6>
                      <h6>Email: {{ $vaccine_take->center->email ?? 'N/A' }}</h6>
                    </div>

                    <div class="col-7">
                      <div style="max-width: 100%; overflow: hidden;">
                        {!! $vaccine_take->center->location_link !!}
                      </div>
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
                        @if($vaccine_take->vaccine_status == 'Completed')
                            <a href="{{ route('vaccination.pdf.certificate', ['id' => $vaccine_take->id]) }}" class="btn btn-primary">Download Certificate</a>
                        @else
                            <a href="{{ route('vaccination.pdf.details', ['id' => $vaccine_take->id]) }}" class="btn btn-primary">Download Vaccination Status</a>
                        @endif
                    </div>
                  </div>
                  {{-- <div class="col-12">
                    <label for="symptoms" class="form-label">Symptoms</label>
                    <textarea name="symptoms" class="form-control @error('symptoms') is-invalid @enderror" id="symptoms" style="height: 100px">{{ old('symptoms') }}</textarea>
                    @error('symptoms')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <label for="prevention" class="form-label">Prevention</label>
                    <textarea name="prevention" class="form-control @error('prevention') is-invalid @enderror" id="prevention" style="height: 100px">{{ old('prevention') }}</textarea>
                    @error('prevention')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <label for="treatment" class="form-label">Treatment</label>
                    <textarea name="treatment" class="form-control @error('treatment') is-invalid @enderror" id="treatment" style="height: 100px">{{ old('treatment') }}</textarea>
                    @error('treatment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" style="height: 100px">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div> --}}
                  
                  {{-- <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div> --}}
                </form><!-- Vertical Form -->
  
              </div>
            </div>
  
  
          </div>
  
          <div class="col-lg-2"></div>
        </div>
      </section>

  </main>


@endsection