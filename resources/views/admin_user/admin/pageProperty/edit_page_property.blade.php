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
        <a class="nav-link " href="{{ route('admin.pageProperty.edit') }}">
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
      <h1>Page Property</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
          <li class="breadcrumb-item">Item</li>
          <li class="breadcrumb-item active">Page Property</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">



        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
              <div class="row">
                
                <!-- Recent Sales -->
                <div class="col-12">
                  <div class="card recent-sales overflow-auto">
      
                    <div class="filter">
    
      
                      <form method="POST" action="{{ route('admin.sliderImage.add.post') }}" enctype="multipart/form-data">
                        @csrf
    
                        <div x-data="{ slider_image: '{{ url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                          <div class="col-md-4 col-lg-3 col-form-label">
                            <button type="submit" class="btn btn-primary ml-4 mt-3">Add Slider Image</button>
                          </div>
                          <div class="col-md-8 col-lg-9">
                            <img x-bind:src="slider_image" alt="Profile" class="img-responsive" style="max-width: 150px; max-height: 100px;">
                              
                            <div class="pt-2">
                              <input x-on:change="slider_image = URL.createObjectURL($event.target.files[0])" name="slider_image" type="file" class="form-control @error('slider_image') is-invalid @enderror" id="slider_image">
                              @error('slider_image')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
    
                      </form>
      
    
                    </div>
      
                    <div class="card-body">
                      <h5 class="card-title">Slider Images</h5>
      
                      <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th scope="col">Slider Image - Preview</th>
                            <th scope="col">Operation</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(isset($slider_images) && count($slider_images) > 0)
                          @foreach($slider_images as $key => $slider_image)
                          <tr>
                            <th scope="row"><a href="#"><img src="{{ (!empty($slider_image->image)) ? url('page_assets/img/'.$slider_image->image) : url('upload/No_Image_Available.jpg') }}" alt="Preview" class="img-fluid" style="max-width: 150px;"></a></th>
                            
                            <td>
                              <a href="{{ route('admin.sliderImage.delete', $slider_image->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete?')">Delete</a>
                            </td>
                          </tr>
                          @endforeach
                        @else
                            <tr>
                            <td colspan="6">No slider images available.</td>
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