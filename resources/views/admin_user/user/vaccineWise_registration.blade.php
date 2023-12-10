@extends('admin_user.main')
@section('main')


<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('user.index') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('user.vaccine.registration') }}">
        <i class="bi bi-grid"></i>
        <span>Vaccine Registration</span>
      </a>
    </li><!-- End Dashboard Nav -->



    <li class="nav-heading">Other Operation</li>

    <li class="nav-item">
      <a class="nav-link" href="{{route('user.vaccine_list')}}">
        <i class="bi bi-person"></i>
        <span>Vaccines</span>
      </a>
    </li>


  </ul>

</aside>
<!-- End Sidebar-->





<main id="main" class="main">

    <div class="pagetitle">
      <h1>Vaccine Registration</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
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
                  <form method="POST" action="{{ route('user.vaccine.registration.post') }}" enctype="multipart/form-data">
                    @csrf



                    {{-- <div class="row mb-3">
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
                    </div> --}}
                    <input name="vaccine_id" type="hidden" class="form-control id="vaccine_id" value="{{ $vaccine->id }}">


                    <div class="row mb-3">
                        <label for="vaccine_name" class="col-md-4 col-lg-3 col-form-label">Vaccine Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="vaccine_name" type="text" disabled class="form-control @error('vaccine_name') is-invalid @enderror" id="vaccine_name" value="{{ $vaccine->name }}">
                        

                          @error('vaccine_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="division" class="col-md-4 col-lg-3 col-form-label">Center Area (Division)</label>
                        <div class="col-md-8 col-lg-9">
                            <select name="division" class="form-select @error('division') is-invalid @enderror" id="division">
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