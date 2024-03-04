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



      <li class="nav-heading">Other Operation</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{route('center.vaccine_list')}}">
          <i class="bi bi-person"></i>
          <span>Vaccines</span>
        </a>
      </li>


    </ul>

  </aside>
  <!-- End Sidebar-->

  

  <main id="main" class="main" style="min-height: 85vh">

    <div class="pagetitle">
      <h1>Center Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          {{-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> --}}
          {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">


      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            

            
            
            <!-- Recent Sales -->
            <div class="col-12">
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
                  <a href="{{ route('center.vaccine.registration') }}" class="btn btn-primary">Vaccine Registration</a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Vaccination Status AppUsers<span>| {{$center->hospital}}</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Vaccine Reg.</th>
                        <th scope="col">User</th>
                        <th scope="col">Vaccine</th>
                        <th scope="col">Center</th>
                        <th scope="col">Registration Date</th>
                        <th scope="col">First Dose At</th>
                        <th scope="col">Completed Doses</th> 
                        <th scope="col">Doses Left</th>
                        <th scope="col">Details</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(count($vaccine_takes_user) > 0)
                      @foreach($vaccine_takes_user as $key => $vaccine_take)
                      <tr>
                        <th scope="row"><a href="">#{{$vaccine_take->id}}</a>
                        </th>
                        <td>
                          @if($vaccine_take->user->role == 'user')
                          <div class="row">
                              <div class="col"><img src="{{ (!empty($vaccine_take->user->photo)) ? url('page_assets/img/'.$vaccine_take->user->photo) : url('upload/No_Image_Available.jpg') }}" alt="Preview" class="img-fluid" style="max-width: 100px;"></div>
                                <div class="col">Name: {{ $vaccine_take->user->username ?? 'Not available' }}</div>
                          </div>
                          @else
                          <div class="row">
                            <div class="col"><img src="{{ (!empty($vaccine_take->patient_photo)) ? url('page_assets/img/'.$vaccine_take->patient_photo) : url('upload/No_Image_Available.jpg') }}" alt="Preview" class="img-fluid" style="max-width: 100px;"></div>
                              <div class="col">Name: {{ $vaccine_take->patient_name ?? 'Not available' }} </br>
                              NID: {{ $vaccine_take->patient_nid ?? 'Not available' }}</div>
                          </div>
                          @endif
                        </td>

                        <td>{{ $vaccine_take->vaccine->name ?? 'Not available' }}</td>
                        <td>{{ $vaccine_take->center->hospital ?? 'Not available' }}</td>
                        <td>{{ $vaccine_take->order_date ?? 'Not available' }}</td>
                        <td>{{ $vaccine_take->first_dose_date ?? 'Not available' }}</td>
                        <td>{{ $vaccine_take->completed_doses ?? 'Not available' }}</td>
                        <td>{{ ($vaccine_take->vaccine->doses_required - $vaccine_take->completed_doses) ?? 'Not available' }}</td>
                        <td>
                            <a href="{{ route('center.vaccine.registration.update', ['id' => $vaccine_take->id]) }}" class="btn btn-primary btn-sm">Update</a>
                            <a href="{{ route('center.vaccination.details', ['id' => $vaccine_take->id]) }}" class="btn btn-info btn-sm">View Details</a>

                        </td>
                      </tr>
                      @endforeach
                    @else
                        <tr>
                        <td colspan="6">No Vaccination Status is Available.</td>
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

    </br>

    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          

          
          
          <!-- Recent Sales -->
          <div class="col-12">
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
                <a href="{{ route('center.underprivileged.vaccine.registration') }}" class="btn btn-primary">Vaccine Registration</a>
              </div>

              <div class="card-body">
                <h5 class="card-title">Vaccination Status Underprivileged<span>| {{$center->hospital}}</span></h5>

                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">Vaccine Reg.</th>
                      <th scope="col">User</th>
                      <th scope="col">Vaccine</th>
                      <th scope="col">Center</th>
                      <th scope="col">Registration Date</th>
                      <th scope="col">First Dose At</th>
                      <th scope="col">Completed Doses</th> 
                      <th scope="col">Doses Left</th>
                      <th scope="col">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($vaccine_takes_underprivileged) > 0)
                    @foreach($vaccine_takes_underprivileged as $key => $vaccine_take)
                    <tr>
                      <th scope="row"><a href="">#{{$vaccine_take->id}}</a>
                      </th>
                      <td>
                        @if($vaccine_take->user->role == 'user')
                        <div class="row">
                            <div class="col"><img src="{{ (!empty($vaccine_take->user->photo)) ? url('page_assets/img/'.$vaccine_take->user->photo) : url('upload/No_Image_Available.jpg') }}" alt="Preview" class="img-fluid" style="max-width: 100px;"></div>
                              <div class="col">Name: {{ $vaccine_take->user->username ?? 'Not available' }}</div>
                        </div>
                        @else
                        <div class="row">
                          <div class="col"><img src="{{ (!empty($vaccine_take->patient_photo)) ? url('page_assets/img/'.$vaccine_take->patient_photo) : url('upload/No_Image_Available.jpg') }}" alt="Preview" class="img-fluid" style="max-width: 100px;"></div>
                            <div class="col">Name: {{ $vaccine_take->patient_name ?? 'Not available' }} </br>
                            NID: {{ $vaccine_take->patient_nid ?? 'Not available' }}</div>
                        </div>
                        @endif
                      </td>

                      <td>{{ $vaccine_take->vaccine->name ?? 'Not available' }}</td>
                      <td>{{ $vaccine_take->center->hospital ?? 'Not available' }}</td>
                      <td>{{ $vaccine_take->order_date ?? 'Not available' }}</td>
                      <td>{{ $vaccine_take->first_dose_date ?? 'Not available' }}</td>
                      <td>{{ $vaccine_take->completed_doses ?? 'Not available' }}</td>
                      <td>{{ ($vaccine_take->vaccine->doses_required - $vaccine_take->completed_doses) ?? 'Not available' }}</td>
                      <td>
                          <a href="{{ route('center.vaccine.registration.update', ['id' => $vaccine_take->id]) }}" class="btn btn-primary btn-sm">Update</a>
                          <a href="{{ route('center.vaccination.details', ['id' => $vaccine_take->id]) }}" class="btn btn-info btn-sm">View Details</a>

                      </td>
                    </tr>
                    @endforeach
                  @else
                      <tr>
                      <td colspan="6">No Vaccination Status is Available.</td>
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

  </br>

    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          

          
          
          <!-- Recent Sales -->
          <div class="col-12">
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
                {{-- <a href="{{ route('center.vaccine.registration') }}" class="btn btn-primary">Vaccine Registration</a> --}}
              </div>

              <div class="card-body">
                <h5 class="card-title">Vaccination History<span>| Updated All List</span></h5>

                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">Vaccine Reg.</th>
                      <th scope="col">User</th>
                      <th scope="col">Vaccine</th>
                      <th scope="col">Center</th>
                      <th scope="col">Registration Date</th>
                      <th scope="col">First Dose At</th>
                      <th scope="col">Completed Doses</th> 
                      <th scope="col">Doses Left</th>
                      <th scope="col">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($vaccine_takes_all) > 0)
                    @foreach($vaccine_takes_all as $key => $vaccine_take)
                    <tr>
                      <th scope="row"><a href="">#{{$vaccine_take->id}}</a>
                      </th>
                      <td>
                        @if($vaccine_take->user->role == 'user')
                        <div class="row">
                            <div class="col"><img src="{{ (!empty($vaccine_take->user->photo)) ? url('page_assets/img/'.$vaccine_take->user->photo) : url('upload/No_Image_Available.jpg') }}" alt="Preview" class="img-fluid" style="max-width: 100px;"></div>
                              <div class="col">Name: {{ $vaccine_take->user->username ?? 'Not available' }}</div>
                        </div>
                        @else
                        <div class="row">
                          <div class="col"><img src="{{ (!empty($vaccine_take->patient_photo)) ? url('page_assets/img/'.$vaccine_take->patient_photo) : url('upload/No_Image_Available.jpg') }}" alt="Preview" class="img-fluid" style="max-width: 100px;"></div>
                            <div class="col">Name: {{ $vaccine_take->patient_name ?? 'Not available' }} </br>
                            NID: {{ $vaccine_take->patient_nid ?? 'Not available' }}</div>
                        </div>
                        @endif
                      </td>

                      <td>{{ $vaccine_take->vaccine->name ?? 'Not available' }}</td>
                      <td>{{ $vaccine_take->center->hospital ?? 'Not available' }}</td>
                      <td>{{ $vaccine_take->order_date ?? 'Not available' }}</td>
                      <td>{{ $vaccine_take->first_dose_date ?? 'Not available' }}</td>
                      <td>{{ $vaccine_take->completed_doses ?? 'Not available' }}</td>
                      <td>{{ ($vaccine_take->vaccine->doses_required - $vaccine_take->completed_doses) ?? 'Not available' }}</td>
                      <td>
                          {{-- <a href="{{ route('center.vaccine.registration.update', ['id' => $vaccine_take->id]) }}" class="btn btn-primary btn-sm">Update</a> --}}
                          <a href="{{ route('center.vaccination.details', ['id' => $vaccine_take->id]) }}" class="btn btn-info btn-sm">View Details</a>

                      </td>
                    </tr>
                    @endforeach
                  @else
                      <tr>
                      <td colspan="6">No Vaccination Status is Available.</td>
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



    </section><!-- End Dashboard Section -->


  </main>




@endsection