@extends('main.main')
@section('main')




    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-clinic-medical me-3"></i>Vaccine Management</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{route('index')}}" class="nav-item nav-link">Home</a>
                <a href="{{route('myVaccine')}}" class="nav-item nav-link">My Vaccine</a>
                <a href="{{route('conditions')}}" class="nav-item nav-link">Conditions</a>
                <a href="{{route('vaccination')}}" class="nav-item nav-link active">Vaccination</a>
                <a href="{{route('blogs')}}" class="nav-item nav-link">Blogs</a>
            </div>
            <div class="px-2"><button onclick="window.location.href='{{route('signin')}}'" class="nav-item btn btn-outline-dark ">Sign In</button></div>
            <a href="{{route('signup')}}" class="btn btn-warning py-4 px-lg-5 d-none d-lg-block">Join Now!<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0" style="background-color: #e4f4f2;">
        <div class="container-fluid page-header-inner pb-5">
            <div class="container ">
                <div class="row">
                    <div class="col-4 pt-5">
                        <h1 class="display-3 mb-3 animated slideInDown">Vaccination</h1>
                        <p>Learn from others and find the vaccination details that is right for you.</p>
                    </div>

                    <div class="col-8">
                        <img class="w-100" src="{{ asset('page_assets/img/treatment-banner.png') }}" alt="Image" style="min-width: 100%; min-height: 110%; object-fit: fill;">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex py-5 px-4">
                        
                        <div class="ps-4 text-center">
                            
                            <h4 class="mb-3">{{ $page_property_view?->vaccination_title1 ?? 'Not Available'}}</h4>
                            <p>{{  $page_property_view?->vaccination_description1 ?? 'Not Available' }}</p>
                            <img class="w-100" src="{{ (!empty($page_property_view->vaccination_image1)) ? url('page_assets/img/'.$page_property_view->vaccination_image1) : url('upload/No_Image_Available.jpg') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="d-flex py-5 px-4">
                        
                        <div class="ps-4 text-center">
                            
                            <h4 class="mb-3">{{ $page_property_view?->vaccination_title2 ?? 'Not Available'}}</h4>
                            <p>{{  $page_property_view?->vaccination_description2 ?? 'Not Available' }}</p>
                            <img class="w-100" src="{{ (!empty($page_property_view->vaccination_image2)) ? url('page_assets/img/'.$page_property_view->vaccination_image2) : url('upload/No_Image_Available.jpg') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex py-5 px-4">
                        
                        <div class="ps-4 text-center">
                            
                            <h4 class="mb-3">{{ $page_property_view?->vaccination_title3 ?? 'Not Available'}}</h4>
                            <p>{{  $page_property_view?->vaccination_description3 ?? 'Not Available' }}</p>
                            <img class="w-100" src="{{ (!empty($page_property_view->vaccination_image3)) ? url('page_assets/img/'.$page_property_view->vaccination_image2) : url('upload/No_Image_Available.jpg') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">

                        </div>
                    </div>
                </div>
                <hr class="divider width-1000">
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Line Start -->
    <div class="container-xxl py-5">
        <div class="container">
            
            <h2>Browse by category</h2>
            <p>These are the top conditions listed by category. Don't see your condition? Use the search bar above.</p>

            <br />

            <div class="row">
    
                <!-- Right side for Vaccine List -->
                <div class="col-md-12">

                    <div>
                        <h4>Dhaka Vaccination</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Vaccine Name</th>
                                    <th>Vaccinated</th>
                                    <th>Disease</th>
                                    <th>Doses Required</th>
                                </tr>
                            </thead>
                            <tbody>
    
    
                                @if(isset($dhaka_vaccine_list) && count($dhaka_vaccine_list) > 0)
                                @foreach($dhaka_vaccine_list as $vaccine)
    
                                    <tr>
                                        <td>{{$vaccine->vaccine->name}}</td>
                                        <td>
                                            <div class="percentage-bar">
                                                <div class="progress" style="width: {{$vaccine->vaccine_taken_percent}}%; background-color: #3498db;">
                                                    <span class="percentage-text">{{$vaccine->vaccine_taken_percent}}%</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$vaccine->vaccine->disease->name}}</td>
                                        <td>{{$vaccine->vaccine->doses_required}}</td>
                                    </tr>
    
                                @endforeach
                                @else
                                    <h4>No Vaccines Found</h4>
                                @endif
    
                                
                            </tbody>
                        </table>
                    </div>


                    <br/>
                    <div>
                        <h4>Chattogram Vaccination</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Vaccine Name</th>
                                    <th>Vaccinated</th>
                                    <th>Disease</th>
                                    <th>Doses Required</th>
                                </tr>
                            </thead>
                            <tbody>
    
    
                                @if(isset($chattogram_vaccine_list) && count($chattogram_vaccine_list) > 0)
                                @foreach($chattogram_vaccine_list as $vaccine)
    
                                    <tr>
                                        <td>{{$vaccine->vaccine->name}}</td>
                                        <td>
                                            <div class="percentage-bar">
                                                <div class="progress" style="width: {{$vaccine->vaccine_taken_percent}}%; background-color: #3498db;">
                                                    <span class="percentage-text">{{$vaccine->vaccine_taken_percent}}%</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$vaccine->vaccine->disease->name}}</td>
                                        <td>{{$vaccine->vaccine->doses_required}}</td>
                                    </tr>
    
                                @endforeach
                                @else
                                    <h4>No Vaccines Found</h4>
                                @endif
    
                                
                            </tbody>
                        </table>
                    </div>


                    <br/>
                    <div>
                        <h4>Rajshahi Vaccination</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Vaccine Name</th>
                                    <th>Vaccinated</th>
                                    <th>Disease</th>
                                    <th>Doses Required</th>
                                </tr>
                            </thead>
                            <tbody>
    
    
                                @if(isset($rajshahi_vaccine_list) && count($rajshahi_vaccine_list) > 0)
                                @foreach($rajshahi_vaccine_list as $vaccine)
    
                                    <tr>
                                        <td>{{$vaccine->vaccine->name}}</td>
                                        <td>
                                            <div class="percentage-bar">
                                                <div class="progress" style="width: {{$vaccine->vaccine_taken_percent}}%; background-color: #3498db;">
                                                    <span class="percentage-text">{{$vaccine->vaccine_taken_percent}}%</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$vaccine->vaccine->disease->name}}</td>
                                        <td>{{$vaccine->vaccine->doses_required}}</td>
                                    </tr>
    
                                @endforeach
                                @else
                                    <h4>No Vaccines Found</h4>
                                @endif
    
                                
                            </tbody>
                        </table>
                    </div>


                    <br/>
                    <div>
                        <h4>Mymensingh Vaccination</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Vaccine Name</th>
                                    <th>Vaccinated</th>
                                    <th>Disease</th>
                                    <th>Doses Required</th>
                                </tr>
                            </thead>
                            <tbody>
    
    
                                @if(isset($mymensingh_vaccine_list) && count($mymensingh_vaccine_list) > 0)
                                @foreach($mymensingh_vaccine_list as $vaccine)
    
                                    <tr>
                                        <td>{{$vaccine->vaccine->name}}</td>
                                        <td>
                                            <div class="percentage-bar">
                                                <div class="progress" style="width: {{$vaccine->vaccine_taken_percent}}%; background-color: #3498db;">
                                                    <span class="percentage-text">{{$vaccine->vaccine_taken_percent}}%</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$vaccine->vaccine->disease->name}}</td>
                                        <td>{{$vaccine->vaccine->doses_required}}</td>
                                    </tr>
    
                                @endforeach
                                @else
                                    <h4>No Vaccines Found</h4>
                                @endif
    
                                
                            </tbody>
                        </table>
                    </div>


                    <br/>
                    <div>
                        <h4>Rangpur Vaccination</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Vaccine Name</th>
                                    <th>Vaccinated</th>
                                    <th>Disease</th>
                                    <th>Doses Required</th>
                                </tr>
                            </thead>
                            <tbody>
    
    
                                @if(isset($rangpur_vaccine_list) && count($rangpur_vaccine_list) > 0)
                                @foreach($rangpur_vaccine_list as $vaccine)
    
                                    <tr>
                                        <td>{{$vaccine->vaccine->name}}</td>
                                        <td>
                                            <div class="percentage-bar">
                                                <div class="progress" style="width: {{$vaccine->vaccine_taken_percent}}%; background-color: #3498db;">
                                                    <span class="percentage-text">{{$vaccine->vaccine_taken_percent}}%</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$vaccine->vaccine->disease->name}}</td>
                                        <td>{{$vaccine->vaccine->doses_required}}</td>
                                    </tr>
    
                                @endforeach
                                @else
                                    <h4>No Vaccines Found</h4>
                                @endif
    
                                
                            </tbody>
                        </table>
                    </div>


                    <br/>
                    <div>
                        <h4>Sylhet Vaccination</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Vaccine Name</th>
                                    <th>Vaccinated</th>
                                    <th>Disease</th>
                                    <th>Doses Required</th>
                                </tr>
                            </thead>
                            <tbody>
    
    
                                @if(isset($sylhet_vaccine_list) && count($sylhet_vaccine_list) > 0)
                                @foreach($sylhet_vaccine_list as $vaccine)
    
                                    <tr>
                                        <td>{{$vaccine->vaccine->name}}</td>
                                        <td>
                                            <div class="percentage-bar">
                                                <div class="progress" style="width: {{$vaccine->vaccine_taken_percent}}%; background-color: #3498db;">
                                                    <span class="percentage-text">{{$vaccine->vaccine_taken_percent}}%</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$vaccine->vaccine->disease->name}}</td>
                                        <td>{{$vaccine->vaccine->doses_required}}</td>
                                    </tr>
    
                                @endforeach
                                @else
                                    <h4>No Vaccines Found</h4>
                                @endif
    
                                
                            </tbody>
                        </table>
                    </div>


                    <br/>
                    <div>
                        <h4>Barishal Vaccination</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Vaccine Name</th>
                                    <th>Vaccinated</th>
                                    <th>Disease</th>
                                    <th>Doses Required</th>
                                </tr>
                            </thead>
                            <tbody>
    
    
                                @if(isset($barishal_vaccine_list) && count($barishal_vaccine_list) > 0)
                                @foreach($barishal_vaccine_list as $vaccine)
    
                                    <tr>
                                        <td>{{$vaccine->vaccine->name}}</td>
                                        <td>
                                            <div class="percentage-bar">
                                                <div class="progress" style="width: {{$vaccine->vaccine_taken_percent}}%; background-color: #3498db;">
                                                    <span class="percentage-text">{{$vaccine->vaccine_taken_percent}}%</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$vaccine->vaccine->disease->name}}</td>
                                        <td>{{$vaccine->vaccine->doses_required}}</td>
                                    </tr>
    
                                @endforeach
                                @else
                                    <h4>No Vaccines Found</h4>
                                @endif
    
                                
                            </tbody>
                        </table>
                    </div>


                    <br/>
                    <div>
                        <h4>Khulna Vaccination</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Vaccine Name</th>
                                    <th>Vaccinated</th>
                                    <th>Disease</th>
                                    <th>Doses Required</th>
                                </tr>
                            </thead>
                            <tbody>
    
    
                                @if(isset($khulna_vaccine_list) && count($khulna_vaccine_list) > 0)
                                @foreach($khulna_vaccine_list as $vaccine)
    
                                    <tr>
                                        <td>{{$vaccine->vaccine->name}}</td>
                                        <td>
                                            <div class="percentage-bar">
                                                <div class="progress" style="width: {{$vaccine->vaccine_taken_percent}}%; background-color: #3498db;">
                                                    <span class="percentage-text">{{$vaccine->vaccine_taken_percent}}%</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$vaccine->vaccine->disease->name}}</td>
                                        <td>{{$vaccine->vaccine->doses_required}}</td>
                                    </tr>
    
                                @endforeach
                                @else
                                    <h4>No Vaccines Found</h4>
                                @endif
    
                                
                            </tbody>
                        </table>
                    </div>


                    
                </div>
            </div>
        </div>
    </div>
    <!-- line End -->



    <!-- Line Start -->
    <div class="container-xxl py-5">
        <div class="container row justify-content-center">
            
            <br />

            <div class="col-12 col-md-7 text-center">
                <h3 class="pb-2">Explore more treatment reviews and options
                    personalized to your condition!</h3>
                <a href="{{route('signup')}}" class="btn btn-warning btn-lg" >Join Now!</a>
            </div>
            
        </div>
    </div>
    <!-- line End -->


    




@endsection