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
                <a href="{{route('conditions')}}" class="nav-item nav-link active">Conditions</a>
                <a href="{{route('vaccination')}}" class="nav-item nav-link">Vaccination</a>
                <a href="contact.html" class="nav-item nav-link">Blogs</a>
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
                        <h1 class="display-3 mb-3 animated slideInDown">Conditions</h1>
                        <p>Learn how to better manage your condition and share your experiences with others.</p>
                    </div>

                    <div class="col-8">
                        <img class="w-100" src="{{ asset('page_assets/img/condition-banner-header.png') }}" alt="Image" style="min-width: 100%; min-height: 110%; object-fit: fill;">
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
                            
                            <h4 class="mb-3">Community Insights</h4>
                            <p>Learn new ways to manage your condition based on the lived experiences of real people like you.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="d-flex py-5 px-4">
                        
                        <div class="ps-4 text-center">
                            
                            <h4 class="mb-3">Ask questions, get answers</h4>
                            <p>Better understand the road ahead from real people who've been in your shoes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex py-5 px-4">
                        
                        <div class="ps-4 text-center">
                            
                            <h4 class="mb-3">Make Helpful Connections</h4>
                            <p>Be part of a safe community that has your back when you need it most.</p>
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
            
            <h4>Browse by category</h4>
            <p>These are the top conditions listed by category. Don't see your condition? Use the search bar above.</p>

            <br />

            <div class="row">
                <!-- Left side for Diseases List -->
                <div class="col-md-6">
                    <h2>Diseases List</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Symptoms</th>
                                <th>Prevention</th>
                                <th>Treatment</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if(isset($diseases) && count($diseases) > 0)
                                @foreach($diseases as $disease)
                                    <tr>
                                        <td>{{$disease->name}}</td>
                                        <td>
                                            {{ substr($disease->symptoms, 0, 80) }}
                                            @if (strlen($disease->symptoms) > 80)
                                                <span>....</span>
                                                <span style="display: none;">{{ substr($disease->symptoms, 80) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ substr($disease->prevention, 0, 80) }}
                                            @if (strlen($disease->prevention) > 80)
                                                <span>....</span>
                                                <span style="display: none;">{{ substr($disease->prevention, 80) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ substr($disease->treatment, 0, 80) }}
                                            @if (strlen($disease->treatment) > 80)
                                                <span>....</span>
                                                <span style="display: none;">{{ substr($disease->treatment, 80) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ substr($disease->description, 0, 80) }}
                                            @if (strlen($disease->description) > 80)
                                                <span>....</span>
                                                <span style="display: none;">{{ substr($disease->description, 80) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <h4>No Diseases Found</h4>
                            @endif

                            {{-- <tr>
                                <td>Flu</td>
                                <td>Fever, Cough, Fatigue</td>
                                <td>Vaccination, Hygiene</td>
                                <td>Rest, Fluids</td>
                                <td>A contagious respiratory illness</td>
                            </tr> --}}
                            <!-- Add more disease rows here -->
                        </tbody>
                    </table>
                </div>
    
                <!-- Right side for Vaccine List -->
                <div class="col-md-6">
                    <h2>Vaccine List</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Doses Required</th>
                                <th>Dose Gap</th>
                            </tr>
                        </thead>
                        <tbody>


                            @if(isset($vaccines) && count($vaccines) > 0)
                            @foreach($vaccines as $vaccine)

                                <tr>
                                    <td>{{$vaccine->name}}</td>
                                    <td>{{$vaccine->doses_required}}</td>
                                    <td>{{$vaccine->dose_gap ?? 'N/A'}}</td>
                                </tr>

                            @endforeach
                            @else
                                <h4>No Vaccines Found</h4>
                            @endif

                            
                            <!-- Add more vaccine rows here -->
                        </tbody>
                    </table>
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
                <h3 class="pb-2">Start learning together and connecting with others
                    living with your specific condition.</h3>
                <a href="{{route('signup')}}" class="btn btn-warning btn-lg" >Join Now!</a>
            </div>
            
        </div>
    </div>
    <!-- line End -->


    




@endsection