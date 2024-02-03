@extends('admin_user.main')
@section('main')


<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="{{ route('center.index') }}">
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
        <a class="nav-link collapsed" href="{{ route('center.underprivileged.vaccine.registration') }}">
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
      <h1>Vaccination Update</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('center.index') }}">Home</a></li>
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
                  <form method="POST" action="{{ route('center.vaccine.registration.update.post') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $vaccine_take->id }}">

                    <div class="row mb-3">
                      <label for="photo" class="col-md-4 col-lg-3 col-form-label">Photo</label>
                      <div class="col-md-8 col-lg-9">
                        @if($vaccine_take->user->role == 'user')
                          <img src="{{ (!empty($vaccine_take->user->photo)) ? url('upload/user_images/'.$vaccine_take->user->photo) : url('upload/No_Image_Available.jpg') }}" alt="Preview" class="img-fluid" style="max-width: 150px;">
                        @else
                          <img src="{{ (!empty($vaccine_take->patient_photo)) ? url('page_assets/img/'.$vaccine_take->patient_photo) : url('upload/No_Image_Available.jpg') }}" alt="Preview" class="img-fluid" style="max-width: 150px;">
                        @endif
                        @error('photo')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                  </div>

                    <div class="row mb-3">
                        <label for="user_id" class="col-md-4 col-lg-3 col-form-label">User</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="text" name="user_id" disabled class="form-control @error('user_id') is-invalid @enderror" id="user_id" value="{{ $vaccine_take->user->role == 'user' ? $vaccine_take->user->username : $vaccine_take->patient_name }}" readonly>
                          @error('user_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="nid" class="col-md-4 col-lg-3 col-form-label">NID</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="nid" disabled class="form-control @error('nid') is-invalid @enderror" id="nid" value="{{ $vaccine_take->user->role == 'user' ? $vaccine_take->user->nid : $vaccine_take->patient_nid }}" readonly>
                        @error('nid')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                  </div>
                    

                    <div class="row mb-3">
                        <label for="vaccine_id" class="col-md-4 col-lg-3 col-form-label">Vaccine</label>
                        <div class="col-md-8 col-lg-9">
                          <input type="text" name="vaccine_id" disabled class="form-control @error('vaccine_id') is-invalid @enderror" id="vaccine_id" value="{{ $vaccine_take->vaccine->name }}" readonly>                     
                          @error('vaccine_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="division" class="col-md-4 col-lg-3 col-form-label">Center Area (Division)</label>
                        <div class="col-md-8 col-lg-9">
                            <input type="text" name="division" disabled class="form-control @error('division') is-invalid @enderror" id="division" value="{{ $vaccine_take->division }}" readonly>
                          @error('division')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="center" class="col-md-4 col-lg-3 col-form-label">Center Name</label>
                      <div class="col-md-8 col-lg-9">
                          <input type="text" name="center" disabled class="form-control @error('center') is-invalid @enderror" id="center" value="{{ $vaccine_take->center->hospital }}" readonly>
                        @error('center')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="center" class="col-md-4 col-lg-3 col-form-label">Completed Doses</label>
                      <div class="col-md-8 col-lg-9">
                        @if($vaccine_take->completed_doses > 0)
                          @foreach ($dose_date_details as $dose)
                            <h6>
                                @if($dose->dose_status == 'completed')
                                {{ $dose->dose_number }}-dose Date: {{ $dose->dose_date }}
                                    <small class="text-success">Completed</small>
                                @endif
                            </h6>
                          @endforeach
                        @else
                            <label for="dose" class="col-md-4 col-lg-3 col-form-label">No Dose Completed</label>
                        @endif
                      </div>
                    </div>

                    <input type="hidden" name="next_dose_number" value="{{ $vaccine_take->completed_doses + 1 }}">


                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Dose Details</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row g-3">

                          <div class="col-md-4">

                            @if($vaccine_take->completed_doses < $vaccine_take->vaccine->doses_required)
                              <label for="next_dose_date" class="form-label">{{$vaccine_take->completed_doses + 1 }} Dose<span class="text-danger">*</span></label>
                              <input type="date" name="next_dose_date" {{ $vaccine_take->completed_doses < $vaccine_take->vaccine->doses_required ? '' : 'disabled' }} class="form-control @error('next_dose_date') is-invalid @enderror" id="next_dose_date" value="{{ old('next_dose_date') }}" >
                              @error('next_dose_date')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            @else
                              <label for="next_dose_date" class="form-label">All Doses Completed</label>
                            @endif


                          </div>


                          <div class="col-md-4">

                            @if($vaccine_take->completed_doses < $vaccine_take->vaccine->doses_required)
                              <label for="next_dose_assigned_date" class="form-label">Assigned Date: {{$dose_date_details[$vaccine_take->completed_doses]->dose_date}}<span class="text-danger">*</span></label>
                              <input type="hidden" name="next_dose_assigned_date" value="{{$dose_date_details[$vaccine_take->completed_doses]->dose_date}}">
                              @error('next_dose_assigned_date')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            @endif


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