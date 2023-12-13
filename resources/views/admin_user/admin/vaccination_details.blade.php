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
      <a class="nav-link" href="{{ route('admin.vaccinationStatus_list') }}">
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
                        <h6>Completed Doses: {{ $vaccine_take->completed_doses }}</h6>
                    </div>
                    <div class="col-2">
                    </div>
                    <div class="col-5">
                        <h6>Center: {{ $vaccine_take->center->hospital}}</h6>
                        <h6>Address: {{ $vaccine_take->center->address ?? 'N/A' }}</h6>
                        <h6>Phone: {{ $vaccine_take->center->phone ?? 'N/A' }}</h6>
                        <h6>Email: {{ $vaccine_take->center->email ?? 'N/A' }}</h6>
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
                            <a href="" class="btn btn-primary">Download Certificate</a>
                        @else
                            <a href="" class="btn btn-primary">Download Vaccination Status</a>
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