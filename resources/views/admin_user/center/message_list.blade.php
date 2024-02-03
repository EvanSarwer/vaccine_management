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
      <h1>Notifications</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('center.index')}}">Home</a></li>
          <li class="breadcrumb-item active">Notifications</li>
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
                

                <div class="card-body">
                  <h5 class="card-title">Notifications <span>| Updated List</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Client Status</th>
                        <th scope="col">Email/Phone</th>
                        <th scope="col">Message</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if(count($messages) > 0)
                      @foreach($messages as $key => $message)
                      <tr class="{{ ($message->status === 'unseen') ? 'table-primary' : '' }}">
                        <td>{{ $message->fromUser != null ? 'Registered User' : 'Unregistered User' }}</td>
                        <td>{{ $message->email ?? 'Email not available' }} </br> {{ $message->phone ?? 'Phone not available' }}</td>
                        <td>
                          @if ($message->status === 'unseen')
                            <b>{{$message->message ?? 'Not available'}}</b>
                          @else
                            {{$message->message ?? 'Not available'}}
                          @endif
                        </td>
                        <td>{{ $message->created_at }} </br> {{ $message->deliver_time }}</td>
                      </tr>
                      @endforeach
                    @else
                        <tr>
                        <td colspan="6">No notification available.</td>
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