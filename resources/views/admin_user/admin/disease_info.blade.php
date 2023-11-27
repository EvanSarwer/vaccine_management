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
  
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span>Alerts</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Badges</span>
            </a>
          </li>
          <li>
            <a href="components-breadcrumbs.html">
              <i class="bi bi-circle"></i><span>Breadcrumbs</span>
            </a>
          </li>
          <li>
            <a href="components-buttons.html">
              <i class="bi bi-circle"></i><span>Buttons</span>
            </a>
          </li>
          <li>
            <a href="components-cards.html">
              <i class="bi bi-circle"></i><span>Cards</span>
            </a>
          </li>
          <li>
            <a href="components-carousel.html">
              <i class="bi bi-circle"></i><span>Carousel</span>
            </a>
          </li>
          <li>
            <a href="components-list-group.html">
              <i class="bi bi-circle"></i><span>List group</span>
            </a>
          </li>
          <li>
            <a href="components-modal.html">
              <i class="bi bi-circle"></i><span>Modal</span>
            </a>
          </li>
          <li>
            <a href="components-tabs.html">
              <i class="bi bi-circle"></i><span>Tabs</span>
            </a>
          </li>
          <li>
            <a href="components-pagination.html">
              <i class="bi bi-circle"></i><span>Pagination</span>
            </a>
          </li>
          <li>
            <a href="components-progress.html">
              <i class="bi bi-circle"></i><span>Progress</span>
            </a>
          </li>
          <li>
            <a href="components-spinners.html">
              <i class="bi bi-circle"></i><span>Spinners</span>
            </a>
          </li>
          <li>
            <a href="components-tooltips.html">
              <i class="bi bi-circle"></i><span>Tooltips</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->
  
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Form Elements</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
          </li>
          <li>
            <a href="forms-editors.html">
              <i class="bi bi-circle"></i><span>Form Editors</span>
            </a>
          </li>
          <li>
            <a href="forms-validation.html">
              <i class="bi bi-circle"></i><span>Form Validation</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->
  
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Data Tables</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
  
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Chart.js</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>ApexCharts</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>ECharts</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->
  
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Remix Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>Boxicons</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav --> --}}
  
      <li class="nav-heading">Property Operation</li>
  
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.disease_list') }}">
          <i class="bi bi-person"></i>
          <span>Diseases</span>
        </a>
      </li><!-- End Profile Page Nav -->
  
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->
  
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->
  
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->
  
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->
  
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->
  
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav --> --}}
  
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
                        <td>{{ $vaccine->stock_quantity ?? 'Not available' }}</td>
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