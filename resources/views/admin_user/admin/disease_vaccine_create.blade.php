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
          <li class="breadcrumb-item">Item</li>
          <li class="breadcrumb-item active">Disease - Veccine</li>
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Add Vaccine</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{ route('admin.disease.vaccine.create.post') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="disease_id" value="{{ $disease->id }}">


                    <div class="row mb-3">
                      <label for="name" class="col-md-4 col-lg-3 col-form-label">Name<span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                        @error('name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                        <label for="disease_name" class="col-md-4 col-lg-3 col-form-label">Disease Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="disease_name" type="text" disabled class="form-control @error('disease_name') is-invalid @enderror" id="disease_name" value="{{ $disease->name }}">
                          @error('disease_name')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="manufacturer" class="col-md-4 col-lg-3 col-form-label">Manufacturer Co.</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="manufacturer" type="text" class="form-control @error('manufacturer') is-invalid @enderror" id="manufacturer" value="{{ old('manufacturer') }}">
                          @error('manufacturer')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                      <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" style="height: 100px">{{ old('description') }}</textarea>
                        @error('description')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                      </div>
                    </div>

                    {{-- <div class="row mb-3">
                      <label for="category_id" class="col-md-4 col-lg-3 col-form-label">DiseaseName</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" aria-label="Select a category" id="category_id">
                          <option value="" selected>Choose a balloon category</option>
                          @foreach ($balloon_categories as $category)
                              <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>
                                  {{ $category['category_name'] }}
                              </option>
                          @endforeach
                        </select>
                        @error('category_id')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div> --}}

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Dose Details</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row g-3">

                          <div class="col-md-4">
                            <label for="doses_required" class="form-label">Dose Required<span class="text-danger">*</span></label>
                            <input type="text" name="doses_required" class="form-control @error('doses_required') is-invalid @enderror" id="doses_required" value="{{ old('doses_required') }}" >
                            @error('doses_required')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="col-md-4">
                            <label for="dose_gap_number" class="form-label">Dose Gape</label>
                            <input type="text" name="dose_gap_number" class="form-control @error('dose_gap_number') is-invalid @enderror" id="dose_gap_number" value="{{ old('dose_gap_number') }}" >
                            @error('dose_gap_number')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="col-md-4">
                            <label for="dose_gap_time" class="form-label">Timeline</label>
                            <select name="dose_gap_time" class="form-select @error('dose_gap_time') is-invalid @enderror" id="dose_gap_time">
                                <option value="day" {{ old('dose_gap_time') == 'day' ? 'selected' : '' }}>Day</option>
                                <option value="month" {{ old('dose_gap_time') == 'month' ? 'selected' : '' }}>Month</option>
                                <option value="year" {{ old('dose_gap_time') == 'year' ? 'selected' : '' }}>Year</option>
                            </select>
                            @error('dose_gap_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        </div>
                        
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Details<span class="text-danger">*</span></label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row g-2">

                          <div class="col-md-6">
                            <label for="stock_quantity" class="form-label">Quantity<span class="text-danger">*</span></label>
                            <input type="text" name="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" value="{{ old('stock_quantity') }}" >
                            @error('stock_quantity')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                          {{-- <div class="col-md-6">
                            <label for="offer_percent" class="form-label">Offer in (%)</label>
                            <input type="text" name="offer_percent" class="form-control @error('offer_percent') is-invalid @enderror" id="offer_percent" value="{{ old('offer_percent') }}" >
                            @error('offer_percent')
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