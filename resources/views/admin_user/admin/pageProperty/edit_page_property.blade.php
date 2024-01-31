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
        <a class="nav-link collapsed" href="{{ route('admin.vaccine.registration', 'Dhaka') }}">
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







        <div class="row">

          <!-- Left side columns -->
          <div class="col-lg-12">
                <div class="card recent-sales overflow-auto">
  
  
  
  
  
                <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
  
                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Update Page Property</button>
                  </li>
  
                </ul>
                <div class="tab-content pt-2">
  
                  <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
  
                    <!-- Profile Edit Form -->
                    <form method="POST" action="{{ route('admin.pageProperty.edit.post') }}" enctype="multipart/form-data">
                      @csrf

                      <div class="row mb-3">
                        <label for="title" class="col-md-4 col-lg-3 col-form-label">Title</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ (old('title')) ? old('title') : $page_property->title }}">
                          @error('title')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="subtitle" class="col-md-4 col-lg-3 col-form-label">Sub-Title</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="subtitle" type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" value="{{ (old('subtitle')) ? old('subtitle') : $page_property->subtitle }}">
                          @error('subtitle')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="testimonial_text" class="col-md-4 col-lg-3 col-form-label">Testimonial Text</label>
                        <div class="col-md-8 col-lg-9">
                          <textarea name="testimonial_text" class="form-control @error('testimonial_text') is-invalid @enderror" id="testimonial_text" style="height: 80px">{{ (old('testimonial_text')) ? old('testimonial_text') : $page_property->testimonial_text }}</textarea>
                          @error('testimonial_text')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="testimonial_author_name" class="col-md-4 col-lg-3 col-form-label">Testimonial Author Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="testimonial_author_name" type="text" class="form-control @error('testimonial_author_name') is-invalid @enderror" id="testimonial_author_name" value="{{ (old('testimonial_author_name')) ? old('testimonial_author_name') : $page_property->testimonial_author_name }}">
                          @error('testimonial_author_name')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
  
                      <div x-data="{ testimonial_author_photo: '{{ (!empty($page_property->testimonial_author_photo)) ? url('page_assets/img/'.$page_property->testimonial_author_photo) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                          <label for="testimonial_author_photo" class="col-md-4 col-lg-3 col-form-label">Testimonial Author Photo</label>
                          <div class="col-md-8 col-lg-9">
                              <img x-bind:src="testimonial_author_photo" alt="Profile">
                              
                              <div class="pt-2">
                                <input x-on:change="testimonial_author_photo = URL.createObjectURL($event.target.files[0])" name="testimonial_author_photo" type="file" class="form-control @error('testimonial_author_photo') is-invalid @enderror" id="testimonial_author_photo">
                                @error('testimonial_author_photo')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                          </div>
                      </div>

                      <div class="row mb-3">
                        <label for="vaccination_title1" class="col-md-4 col-lg-3 col-form-label">Vaccination Page Title1</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="vaccination_title1" type="text" class="form-control @error('vaccination_title1') is-invalid @enderror" id="vaccination_title1" value="{{ (old('vaccination_title1')) ? old('vaccination_title1') : $page_property->vaccination_title1 }}">
                          @error('vaccination_title1')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="vaccination_description1" class="col-md-4 col-lg-3 col-form-label">Vaccination Page Description1</label>
                        <div class="col-md-8 col-lg-9">
                          <textarea name="vaccination_description1" class="form-control @error('vaccination_description1') is-invalid @enderror" id="vaccination_description1" style="height: 80px">{{ (old('vaccination_description1')) ? old('vaccination_description1') : $page_property->vaccination_description1 }}</textarea>
                          @error('vaccination_description1')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>

                      <div x-data="{ vaccination_image1: '{{ (!empty($page_property->vaccination_image1)) ? url('page_assets/img/'.$page_property->vaccination_image1) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                        <label for="vaccination_image1" class="col-md-4 col-lg-3 col-form-label">Vaccination Page Photo1</label>
                        <div class="col-md-8 col-lg-9">
                            <img x-bind:src="vaccination_image1" alt="Profile">
                            
                            <div class="pt-2">
                              <input x-on:change="vaccination_image1 = URL.createObjectURL($event.target.files[0])" name="vaccination_image1" type="file" class="form-control @error('vaccination_image1') is-invalid @enderror" id="vaccination_image1">
                              @error('vaccination_image1')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>
                    </div>


                    {{-- //  --}}
                    <div class="row mb-3">
                      <label for="vaccination_title2" class="col-md-4 col-lg-3 col-form-label">Vaccination Page Title2</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="vaccination_title2" type="text" class="form-control @error('vaccination_title2') is-invalid @enderror" id="vaccination_title2" value="{{ (old('vaccination_title2')) ? old('vaccination_title2') : $page_property->vaccination_title2 }}">
                        @error('vaccination_title2')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="vaccination_description2" class="col-md-4 col-lg-3 col-form-label">Vaccination Page Description2</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="vaccination_description2" class="form-control @error('vaccination_description2') is-invalid @enderror" id="vaccination_description2" style="height: 80px">{{ (old('vaccination_description2')) ? old('vaccination_description2') : $page_property->vaccination_description2 }}</textarea>
                        @error('vaccination_description2')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div x-data="{ vaccination_image2: '{{ (!empty($page_property->vaccination_image2)) ? url('page_assets/img/'.$page_property->vaccination_image2) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                      <label for="vaccination_image2" class="col-md-4 col-lg-3 col-form-label">Vaccination Page Photo2</label>
                      <div class="col-md-8 col-lg-9">
                          <img x-bind:src="vaccination_image2" alt="Profile">
                          
                          <div class="pt-2">
                            <input x-on:change="vaccination_image2 = URL.createObjectURL($event.target.files[0])" name="vaccination_image2" type="file" class="form-control @error('vaccination_image2') is-invalid @enderror" id="vaccination_image2">
                            @error('vaccination_image2')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                      </div>
                  </div>

                  {{-- // --}}
                    <div class="row mb-3">
                      <label for="vaccination_title3" class="col-md-4 col-lg-3 col-form-label">Vaccination Page Title3</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="vaccination_title3" type="text" class="form-control @error('vaccination_title3') is-invalid @enderror" id="vaccination_title3" value="{{ (old('vaccination_title3')) ? old('vaccination_title3') : $page_property->vaccination_title3 }}">
                        @error('vaccination_title3')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="vaccination_description3" class="col-md-4 col-lg-3 col-form-label">Vaccination Page Description3</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="vaccination_description3" class="form-control @error('vaccination_description3') is-invalid @enderror" id="vaccination_description3" style="height: 80px">{{ (old('vaccination_description3')) ? old('vaccination_description3') : $page_property->vaccination_description3 }}</textarea>
                        @error('vaccination_description3')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div x-data="{ vaccination_image3: '{{ (!empty($page_property->vaccination_image3)) ? url('page_assets/img/'.$page_property->vaccination_image3) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                      <label for="vaccination_image3" class="col-md-4 col-lg-3 col-form-label">Vaccination Page Photo3</label>
                      <div class="col-md-8 col-lg-9">
                          <img x-bind:src="vaccination_image3" alt="Profile">
                          
                          <div class="pt-2">
                            <input x-on:change="vaccination_image3 = URL.createObjectURL($event.target.files[0])" name="vaccination_image3" type="file" class="form-control @error('vaccination_image3') is-invalid @enderror" id="vaccination_image3">
                            @error('vaccination_image3')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                      </div>
                  </div>


                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Item</button>
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




      {{-- //Landing Page 1st tab Update --}}
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
              <div class="card recent-sales overflow-auto">


              <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Update First Tab Property (Landing Page)</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{ route('admin.pageProperty.first-tab.edit.post') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                      <label for="tab_name" class="col-md-4 col-lg-3 col-form-label">First Tab Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="tab_name" type="text" class="form-control @error('tab_name') is-invalid @enderror" id="tab_name" value="{{ (old('tab_name')) ? old('tab_name') : $page_property->first_tab[0]->tab_name }}">
                        @error('tab_name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    {{-- // 1 --}}
                    <div class="row mb-3">
                      <label for="title1" class="col-md-4 col-lg-3 col-form-label">First Title</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="title1" type="text" class="form-control @error('title1') is-invalid @enderror" id="title1" value="{{ (old('title1')) ? old('title1') : $page_property->first_tab[0]->title }}">
                        @error('title1')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="description1" class="col-md-4 col-lg-3 col-form-label">First Description</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="description1" class="form-control @error('description1') is-invalid @enderror" id="description1" style="height: 80px">{{ (old('description1')) ? old('description1') : $page_property->first_tab[0]->description }}</textarea>
                        @error('description1')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div x-data="{ image1: '{{ (!empty($page_property->first_tab[0]->image)) ? url('page_assets/img/'.$page_property->first_tab[0]->image) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                        <label for="image1" class="col-md-4 col-lg-3 col-form-label">First Image</label>
                        <div class="col-md-8 col-lg-9">
                            <img x-bind:src="image1" alt="Profile">
                            
                            <div class="pt-2">
                              <input x-on:change="image1 = URL.createObjectURL($event.target.files[0])" name="image1" type="file" class="form-control @error('image1') is-invalid @enderror" id="image1">
                              @error('image1')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>
                    </div>


                    {{-- // 2 --}}
                    <div class="row mb-3">
                      <label for="title2" class="col-md-4 col-lg-3 col-form-label">Second Title</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="title2" type="text" class="form-control @error('title2') is-invalid @enderror" id="title2" value="{{ (old('title2')) ? old('title2') : $page_property->first_tab[1]->title }}">
                        @error('title2')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="description2" class="col-md-4 col-lg-3 col-form-label">Second Description</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="description2" class="form-control @error('description2') is-invalid @enderror" id="description2" style="height: 80px">{{ (old('description2')) ? old('description2') : $page_property->first_tab[1]->description }}</textarea>
                        @error('description2')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div x-data="{ image2: '{{ (!empty($page_property->first_tab[1]->image)) ? url('page_assets/img/'.$page_property->first_tab[1]->image) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                        <label for="image2" class="col-md-4 col-lg-3 col-form-label">Second Image</label>
                        <div class="col-md-8 col-lg-9">
                            <img x-bind:src="image2" alt="Profile">
                            
                            <div class="pt-2">
                              <input x-on:change="image2 = URL.createObjectURL($event.target.files[0])" name="image2" type="file" class="form-control @error('image2') is-invalid @enderror" id="image2">
                              @error('image2')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>
                    </div>


                    {{-- // 3 --}}
                    <div class="row mb-3">
                      <label for="title3" class="col-md-4 col-lg-3 col-form-label">Third Title</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="title3" type="text" class="form-control @error('title3') is-invalid @enderror" id="title3" value="{{ (old('title3')) ? old('title3') : $page_property->first_tab[2]->title }}">
                        @error('title3')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="description3" class="col-md-4 col-lg-3 col-form-label">Third Description</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="description3" class="form-control @error('description3') is-invalid @enderror" id="description3" style="height: 80px">{{ (old('description3')) ? old('description3') : $page_property->first_tab[2]->description }}</textarea>
                        @error('description3')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div x-data="{ image3: '{{ (!empty($page_property->first_tab[2]->image)) ? url('page_assets/img/'.$page_property->first_tab[2]->image) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                        <label for="image3" class="col-md-4 col-lg-3 col-form-label">Third Image</label>
                        <div class="col-md-8 col-lg-9">
                            <img x-bind:src="image3" alt="Profile">
                            
                            <div class="pt-2">
                              <input x-on:change="image3 = URL.createObjectURL($event.target.files[0])" name="image3" type="file" class="form-control @error('image3') is-invalid @enderror" id="image3">
                              @error('image3')
                                <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                        </div>
                    </div>



                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Update Item</button>
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




    {{-- //Landing Page 2nd tab Update --}}
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
            <div class="card recent-sales overflow-auto">


            <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Update Second Tab Property (Landing Page)</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form method="POST" action="{{ route('admin.pageProperty.second-tab.edit.post') }}" enctype="multipart/form-data">
                  @csrf

                  <div class="row mb-3">
                    <label for="tab_name" class="col-md-4 col-lg-3 col-form-label">Second Tab Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="tab_name" type="text" class="form-control @error('tab_name') is-invalid @enderror" id="tab_name" value="{{ (old('tab_name')) ? old('tab_name') : $page_property->second_tab[0]->tab_name }}">
                      @error('tab_name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  {{-- // 1 --}}
                  <div class="row mb-3">
                    <label for="title1" class="col-md-4 col-lg-3 col-form-label">First Title</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="title1" type="text" class="form-control @error('title1') is-invalid @enderror" id="title1" value="{{ (old('title1')) ? old('title1') : $page_property->second_tab[0]->title }}">
                      @error('title1')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="description1" class="col-md-4 col-lg-3 col-form-label">First Description</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="description1" class="form-control @error('description1') is-invalid @enderror" id="description1" style="height: 80px">{{ (old('description1')) ? old('description1') : $page_property->second_tab[0]->description }}</textarea>
                      @error('description1')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div x-data="{ image1: '{{ (!empty($page_property->second_tab[0]->image)) ? url('page_assets/img/'.$page_property->second_tab[0]->image) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                      <label for="image1" class="col-md-4 col-lg-3 col-form-label">First Image</label>
                      <div class="col-md-8 col-lg-9">
                          <img x-bind:src="image1" alt="Profile">
                          
                          <div class="pt-2">
                            <input x-on:change="image1 = URL.createObjectURL($event.target.files[0])" name="image1" type="file" class="form-control @error('image1') is-invalid @enderror" id="image1">
                            @error('image1')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                      </div>
                  </div>


                  {{-- // 2 --}}
                  <div class="row mb-3">
                    <label for="title2" class="col-md-4 col-lg-3 col-form-label">Second Title</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="title2" type="text" class="form-control @error('title2') is-invalid @enderror" id="title2" value="{{ (old('title2')) ? old('title2') : $page_property->second_tab[1]->title }}">
                      @error('title2')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="description2" class="col-md-4 col-lg-3 col-form-label">Second Description</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="description2" class="form-control @error('description2') is-invalid @enderror" id="description2" style="height: 80px">{{ (old('description2')) ? old('description2') : $page_property->second_tab[1]->description }}</textarea>
                      @error('description2')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div x-data="{ image2: '{{ (!empty($page_property->second_tab[1]->image)) ? url('page_assets/img/'.$page_property->second_tab[1]->image) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                      <label for="image2" class="col-md-4 col-lg-3 col-form-label">Second Image</label>
                      <div class="col-md-8 col-lg-9">
                          <img x-bind:src="image2" alt="Profile">
                          
                          <div class="pt-2">
                            <input x-on:change="image2 = URL.createObjectURL($event.target.files[0])" name="image2" type="file" class="form-control @error('image2') is-invalid @enderror" id="image2">
                            @error('image2')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                      </div>
                  </div>


                  {{-- // 3 --}}
                  <div class="row mb-3">
                    <label for="title3" class="col-md-4 col-lg-3 col-form-label">Third Title</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="title3" type="text" class="form-control @error('title3') is-invalid @enderror" id="title3" value="{{ (old('title3')) ? old('title3') : $page_property->second_tab[2]->title }}">
                      @error('title3')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="description3" class="col-md-4 col-lg-3 col-form-label">Third Description</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="description3" class="form-control @error('description3') is-invalid @enderror" id="description3" style="height: 80px">{{ (old('description3')) ? old('description3') : $page_property->second_tab[2]->description }}</textarea>
                      @error('description3')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div x-data="{ image3: '{{ (!empty($page_property->second_tab[2]->image)) ? url('page_assets/img/'.$page_property->second_tab[2]->image) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                      <label for="image3" class="col-md-4 col-lg-3 col-form-label">Third Image</label>
                      <div class="col-md-8 col-lg-9">
                          <img x-bind:src="image3" alt="Profile">
                          
                          <div class="pt-2">
                            <input x-on:change="image3 = URL.createObjectURL($event.target.files[0])" name="image3" type="file" class="form-control @error('image3') is-invalid @enderror" id="image3">
                            @error('image3')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                      </div>
                  </div>



                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update Item</button>
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




  {{-- //Landing Page 3rd tab Update --}}
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
          <div class="card recent-sales overflow-auto">


          <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Update Third Tab Property (Landing Page)</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form method="POST" action="{{ route('admin.pageProperty.third-tab.edit.post') }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                  <label for="tab_name" class="col-md-4 col-lg-3 col-form-label">Third Tab Name</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="tab_name" type="text" class="form-control @error('tab_name') is-invalid @enderror" id="tab_name" value="{{ (old('tab_name')) ? old('tab_name') : $page_property->third_tab[0]->tab_name }}">
                    @error('tab_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                {{-- // 1 --}}
                <div class="row mb-3">
                  <label for="title1" class="col-md-4 col-lg-3 col-form-label">First Title</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="title1" type="text" class="form-control @error('title1') is-invalid @enderror" id="title1" value="{{ (old('title1')) ? old('title1') : $page_property->third_tab[0]->title }}">
                    @error('title1')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="description1" class="col-md-4 col-lg-3 col-form-label">First Description</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="description1" class="form-control @error('description1') is-invalid @enderror" id="description1" style="height: 80px">{{ (old('description1')) ? old('description1') : $page_property->third_tab[0]->description }}</textarea>
                    @error('description1')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div x-data="{ image1: '{{ (!empty($page_property->third_tab[0]->image)) ? url('page_assets/img/'.$page_property->third_tab[0]->image) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                    <label for="image1" class="col-md-4 col-lg-3 col-form-label">First Image</label>
                    <div class="col-md-8 col-lg-9">
                        <img x-bind:src="image1" alt="Profile">
                        
                        <div class="pt-2">
                          <input x-on:change="image1 = URL.createObjectURL($event.target.files[0])" name="image1" type="file" class="form-control @error('image1') is-invalid @enderror" id="image1">
                          @error('image1')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>
                </div>


                {{-- // 2 --}}
                <div class="row mb-3">
                  <label for="title2" class="col-md-4 col-lg-3 col-form-label">Second Title</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="title2" type="text" class="form-control @error('title2') is-invalid @enderror" id="title2" value="{{ (old('title2')) ? old('title2') : $page_property->third_tab[1]->title }}">
                    @error('title2')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="description2" class="col-md-4 col-lg-3 col-form-label">Second Description</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="description2" class="form-control @error('description2') is-invalid @enderror" id="description2" style="height: 80px">{{ (old('description2')) ? old('description2') : $page_property->third_tab[1]->description }}</textarea>
                    @error('description2')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div x-data="{ image2: '{{ (!empty($page_property->third_tab[1]->image)) ? url('page_assets/img/'.$page_property->third_tab[1]->image) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                    <label for="image2" class="col-md-4 col-lg-3 col-form-label">Second Image</label>
                    <div class="col-md-8 col-lg-9">
                        <img x-bind:src="image2" alt="Profile">
                        
                        <div class="pt-2">
                          <input x-on:change="image2 = URL.createObjectURL($event.target.files[0])" name="image2" type="file" class="form-control @error('image2') is-invalid @enderror" id="image2">
                          @error('image2')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>
                </div>


                {{-- // 3 --}}
                <div class="row mb-3">
                  <label for="title3" class="col-md-4 col-lg-3 col-form-label">Third Title</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="title3" type="text" class="form-control @error('title3') is-invalid @enderror" id="title3" value="{{ (old('title3')) ? old('title3') : $page_property->third_tab[2]->title }}">
                    @error('title3')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="description3" class="col-md-4 col-lg-3 col-form-label">Third Description</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="description3" class="form-control @error('description3') is-invalid @enderror" id="description3" style="height: 80px">{{ (old('description3')) ? old('description3') : $page_property->third_tab[2]->description }}</textarea>
                    @error('description3')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>

                <div x-data="{ image3: '{{ (!empty($page_property->third_tab[2]->image)) ? url('page_assets/img/'.$page_property->third_tab[2]->image) : url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                    <label for="image3" class="col-md-4 col-lg-3 col-form-label">Third Image</label>
                    <div class="col-md-8 col-lg-9">
                        <img x-bind:src="image3" alt="Profile">
                        
                        <div class="pt-2">
                          <input x-on:change="image3 = URL.createObjectURL($event.target.files[0])" name="image3" type="file" class="form-control @error('image3') is-invalid @enderror" id="image3">
                          @error('image3')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                    </div>
                </div>



                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Update Item</button>
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



{{-- Blog Post Update  --}}
<div class="row">

  <!-- Left side columns -->
  <div class="col-lg-12">
    <div class="row">
      
      
      <!-- Recent Sales -->
      <div class="col-12">
        <div class="card recent-sales overflow-auto">
          
          <div class="filter">

            <form method="POST" action="{{ route('admin.blogPost.add.post') }}" enctype="multipart/form-data">
              @csrf
              <div class="row mb-3">
                <div class="col-md-2 col-lg-3 col-form-label">
                  <button type="submit" class="btn btn-primary ml-4 mt-3">Add Blog</button>
                </div>
                
                <div class="col-md-10 col-lg-9">
                  <div class="row">
                    <div x-data="{ blog_image: '{{ url('upload/No_Image_Available.jpg') }}'  }" class="row mb-3">
                      
                      <div class="col-md-12 col-lg-9">
                        <img x-bind:src="blog_image" alt="Profile" class="img-responsive" style="max-width: 150px; max-height: 100px;">
                              
                        <div class="pt-2">
                          <input x-on:change="blog_image = URL.createObjectURL($event.target.files[0])" name="blog_image" type="file" class="form-control @error('blog_image') is-invalid @enderror" id="blog_image">
                          @error('blog_image')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="row g-4">

                    <div class="col-md-3">
                      <label for="title" class="form-label">Title</label>
                      <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" placeholder="Blog Title">
                      @error('title')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-md-3">
                      <label for="link" class="form-label">Link</label>
                      <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" id="link" value="{{ old('link') }}" placeholder="Blog Link">
                      @error('link')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="description" class="form-label">Description</label>
                      {{-- <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="description" value="{{ old('description') }}" placeholder="Client Feedback"> --}}
                      <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" style="height: 35px" placeholder="Blog Description" >{{ old('description') }}</textarea>
                      @error('description')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                  

                  </div>
                  
                </div>
              </div>
            </form>





          </div>


          <div class="card-body">
            <h5 class="card-title">Blog Posts <span>| Today</span></h5>

            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th scope="col">Blog Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Link</th>
                  <th scope="col">Operation</th>
                </tr>
              </thead>
              <tbody>
              @if(isset($page_property->blog_posts) && count($page_property->blog_posts) > 0)
                @foreach($page_property->blog_posts as $key => $blog_post)
                <tr>
                  <td>
                    {{ $blog_post->title }}
                  </td>
                  <td>{{ $blog_post->description ?? 'Not Available' }}</td>
                  <td><a href="{{$blog_post->link ?? '/'}}">{{ $blog_post->link ?? 'Not Available' }}</a></td>
                  <td>
                    <a href="{{ route('admin.blogPost.delete', $blog_post->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete?')">Delete</a>
                  </td>
                </tr>
                @endforeach
              @else
                  <tr>
                  <td colspan="6">No blog post available.</td>
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