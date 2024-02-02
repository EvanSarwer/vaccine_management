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
            <li class="breadcrumb-item active">Disease Info</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
      <section class="section">

        <div class="row">
  
          <div class="col-lg-2"></div>
  
          <div class="col-lg-8">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Disease Info</h5>
  
                <!-- Vertical Form -->
                <form method="" action="" class="row g-3">
  
                  <input type="hidden" name="id" value="{{ $disease->id }}">

                  <div class="col-12">
                    <label for="name" class="form-label">Disease Name<span class="text-danger">*</span></label>
                    <input type="text" disabled name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ (old('name')) ? old('name') : $disease->name }}">
                    @error('name')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                  </div>


                  <div class="col-12">
                    <label for="symptoms" class="form-label">Symptoms</label>
                    <textarea name="symptoms" disabled class="form-control @error('symptoms') is-invalid @enderror" id="symptoms" style="height: 100px">{{ (old('symptoms')) ? old('symptoms') : $disease->symptoms }}</textarea>
                    @error('symptoms')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label for="prevention" class="form-label">Prevention</label>
                    <textarea name="prevention" disabled class="form-control @error('prevention') is-invalid @enderror" id="prevention" style="height: 100px">{{ (old('prevention')) ? old('prevention') : $disease->prevention }}</textarea>
                    @error('prevention')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label for="treatment" class="form-label">Treatment</label>
                    <textarea name="treatment" disabled class="form-control @error('treatment') is-invalid @enderror" id="treatment" style="height: 100px">{{ (old('treatment')) ? old('treatment') : $disease->treatment }}</textarea>
                    @error('treatment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" disabled class="form-control @error('description') is-invalid @enderror" id="description" style="height: 100px">{{ (old('description')) ? old('description') : $disease->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>

                  
                </form><!-- Vertical Form -->
  
              </div>
            </div>
  
  
          </div>
  
          <div class="col-lg-2"></div>
        </div>



        <div class="row">
    
                
    
                
            
            <!-- Recent Sales -->
            <div class="col-lg-12">
                <div class="card recent-sales overflow-auto">

                <!-- <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div> -->
                <div class="filter">
                    <a href="{{ route('admin.disease.vaccine.create', $disease->id) }}" class="btn btn-primary">Create New</a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Disease's Vaccines<span>| Updated List</span></h5>

                    <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                        <th scope="col">Vaccine Name</th>
                        <th scope="col">Disease</th>
                        <th scope="col">Doses Required</th>
                        <th scope="col">Given Doses</th>
                        <th scope="col">Booked Stock</th> 
                        <th scope="col">Available Stock</th>
                        <th scope="col">Totak Stock</th>
                        <th scope="col">Manufacturer Co.</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($vaccines) > 0)
                        @foreach($vaccines as $key => $vaccine)
                        <tr>
                          <th scope="row"><a href="">{{$vaccine->name}}</a>
                          </th>
                          <td>{{ $disease->name ?? 'Not available' }}</td>
                          <td>{{ $vaccine->doses_required ?? 'Not available' }}</td>
                          <td>{{ $vaccine->given_quantity ?? 'Not available' }}</td>
                          <td>{{ $vaccine->booked_quantity ?? 'Not available' }}</td>
                          <td>{{ $vaccine->available_quantity ?? 'Not available' }}</td>
                          <td>{{ $vaccine->vaccine_stocks->sum('quantity') ?? 'Not available' }}</td>
                          <td>{{ $vaccine->manufacturer ?? 'Not available' }}</td>
                          <td>
                              <a href="{{ route('admin.disease.vaccine.edit', ['id' => $vaccine->id, 'disease_id' => $disease->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                              <a href="{{ route('admin.disease.vaccine.delete', $vaccine->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                          </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                        <td colspan="6">No vaccine available under this disease.</td>
                        </tr>
                    @endif

                        
                    </tbody>
                    </table>

                </div>

                </div>
            </div><!-- End Recent Sales -->
    
            
            
    
            <!-- Right side columns -->
            
    
          </div>
      </section>

  </main>


@endsection