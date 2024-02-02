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

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Center - Vaccine Stocks</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
          <li class="breadcrumb-item active">Centers</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">


      {{-- Blog Post Update  --}}
<div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">
        
        
        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <form method="POST" action="{{route('admin.vaccine.stock.add.post')}}" >
                @csrf
                <div class="row mb-3">
                  <div class="col-md-2 col-lg-3 col-form-label">
                    <button type="submit" class="btn btn-primary ml-4 mt-3">Add Stocks</button>
                    <input type="hidden" name="center_id" value="{{ $center->id }}">
                  </div>
                  
                  <div class="col-md-8 col-lg-9">
                    
                    <div class="row">
  
                      <div class="col-md-6">
                        <label for="title" class="form-label">Vaccine Name</label>
                        {{-- <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" placeholder="Blog Title"> --}}
                        <select class="form-select @error('vaccine_id') is-invalid @enderror" name="vaccine_id" aria-label="Select Disease" id="vaccine_id">
                            <option value="" selected>Choose vaccine</option>
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
                      <div class="col-md-3">
                        <label for="new_stock" class="form-label">New Stocks</label>
                        <input type="text" name="new_stock" class="form-control @error('new_stock') is-invalid @enderror" id="new_stock" value="{{ old('new_stock') }}" placeholder="Quantity">
                        @error('new_stock')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="col-md-3">
                        <label for="reserve_stock" class="form-label">Reserve (From new stocks)</label>
                        <input type="text" name="reserve_stock" class="form-control @error('reserve_stock') is-invalid @enderror" id="reserve_stock" value="{{ old('reserve_stock') }}" placeholder="Add reserve quantity">
                        @error('reserve_stock')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
  
                    
  
                    </div>
                    
                  </div>
                </div>
              </form>

            <div class="filter">
  
            </div>
  
  
            <div class="card-body">
              <h5 class="card-title">{{$center->hospital}} <span>| Vaccine Stocks</span></h5>
  
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">Vaccine Name</th>
                    <th scope="col">Given</th>
                    <th scope="col">Given (Underprivileged)</th>
                    <th scope="col">Total Given</th>
                    <th scope="col">Available</th>
                    <th scope="col">Reserved</th>
                    <th scope="col">Total Stocks</th>
                  </tr>
                </thead>
                <tbody>
                @if(isset($vaccine_stocks) && count($vaccine_stocks) > 0)
                  @foreach($vaccine_stocks as $key => $stock)
                  <tr>
                    <td>
                      {{ $stock->vaccine->name ?? 'Not Available' }}
                    </td>
                    <td>{{ $stock->given ?? '0' }}</td>
                    <td>{{ $stock->reserved_given ?? '0' }}</td>
                    <td>{{ $stock->given ?? 0 +  $stock->reserved_given ?? 0 }}</td>
                    <td>{{ $stock->available ?? '0' }}</td>
                    <td>{{ $stock->reserved ?? '0' }}</td>
                    <td>{{ $stock->quantity ?? '0' }}</td>
                  </tr>
                  @endforeach
                @else
                    <tr>
                    <td colspan="6">No Vaccine Stocks available.</td>
                  </tr>
                @endif
  
                  
                </tbody>
              </table>
  
            </div>
  
          </div>
        </div><!-- End Recent Sales -->
  
      </div>
    </div><!-- End Left side columns -->
  
    <!-- Right side columns -->
    
  
  </div>



    </section>

  </main>


@endsection