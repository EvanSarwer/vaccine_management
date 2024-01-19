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
      <h1>Center List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
          <li class="breadcrumb-item active">Centers</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">


      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            

            <div class="col-12">
              <div class="card">
                <div class="card-body">

                  <div class="row">
                    <div class="col-2">
                      <label for="division" class="form-label">Select Division</label>
                      <select name="division" class="form-select @error('division') is-invalid @enderror" id="division">
                        <option value="Dhaka" {{ ((old('division')) ? old('division') : $division) == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                        <option value="Chattogram" {{ ((old('division')) ? old('division') : $division) == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
                        <option value="Rajshahi" {{ ((old('division')) ? old('division') : $division) == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                        <option value="Mymensingh" {{ ((old('division')) ? old('division') : $division) == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                        <option value="Sylhet" {{ ((old('division')) ? old('division') : $division) == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                        <option value="Khulna" {{ ((old('division')) ? old('division') : $division) == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                        <option value="Rangpur" {{ ((old('division')) ? old('division') : $division) == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                        <option value="Barishal" {{ ((old('division')) ? old('division') : $division) == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                      </select>                          
                      @error('division')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-8"></div>

                    <div class="col-2">
                      <a href="{{ route('admin.center.create') }}" class="btn btn-primary">Add Center</a>

                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            
            
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">


                <div class="card-body">
                  <h5 class="card-title">Centers <span>| Updated List</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Hospital/Center Name</th>
                        <th scope="col">Division</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(count($centers) > 0)
                      @foreach($centers as $key => $center)
                      <tr>
                        <th scope="row">{{$center->hospital}}</th>
                        <td>{{$center->division}}</td>
                        <td>{{$center->address}}</td>
                        <td>{{$center->email ?? 'Not available'}}</td>
                        <td>{{$center->phone ?? 'Not available'}}</td>
                        <td>
                          <a href="{{ route('admin.center.edit', $center->id) }}" class="btn btn-primary btn-sm">Edit</a> 
                          <a href="{{ route('admin.center.delete', $center->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                          
                      </tr>
                      @endforeach
                    @else
                        <tr>
                        <td colspan="6">No Center available.</td>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <script>
    $(document).ready(function () {
        $('#division').change(function () {
            var selectedDivision = $(this).val();
            window.location.href = "/admin/center_list/" + selectedDivision;
        });
    });
  </script>


@endsection