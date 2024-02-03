@extends('admin_user.main')
@section('main')



<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('center.index') }}">
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
        <a class="nav-link" href="{{route('center.vaccine_list')}}">
          <i class="bi bi-person"></i>
          <span>Vaccines</span>
        </a>
      </li>


    </ul>

  </aside>
  <!-- End Sidebar-->

  <main id="main" class="main" style="min-height: 85vh">

    <div class="pagetitle">
      <h1>Vaccine List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('center.index')}}">Home</a></li>
          <li class="breadcrumb-item active">Vaccines</li>
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

                
                <div class="filter">
                  <a href="{{ route('admin.vaccine.create') }}" class="btn btn-primary">Add New</a>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Vaccines <span>| Updated List</span></h5>

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
                        {{-- <th scope="col">Action</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                    @if(count($vaccines) > 0)
                      @foreach($vaccines as $key => $vaccine)
                      <tr>
                        <th scope="row"><a href="">{{$vaccine->name}}</a>
                        </th>
                        <td>{{ $vaccine->disease_name ?? 'Not available' }}</td>
                        <td>{{ $vaccine->doses_required ?? 'Not available' }}</td>
                        <td>{{ $vaccine->given_quantity ?? 'Not available' }}</td>
                        <td>{{ $vaccine->booked_quantity ?? 'Not available' }}</td>
                        <td>{{ $vaccine->available_quantity ?? 'Not available' }}</td>
                        <td>{{ $vaccine->vaccine_stocks->sum('quantity') ?? 'Not available' }}</td>
                        <td>{{ $vaccine->manufacturer ?? 'Not available' }}</td>
                        {{-- <td>
                            <a href="{{ route('admin.vaccine.edit', ['id' => $vaccine->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ route('admin.vaccine.delete', $vaccine->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                        </td> --}}
                      </tr>
                      @endforeach
                    @else
                        <tr>
                        <td colspan="6">No vaccines available.</td>
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