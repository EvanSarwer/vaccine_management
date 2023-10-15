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
                <a href="{{route('myVaccine')}}" class="nav-item nav-link active">My Vaccine</a>
                <a href="{{route('conditions')}}" class="nav-item nav-link">Conditions</a>
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
                    <div class="col pt-5">
                        <h1 class="display-3 mb-3 animated slideInDown">My Vaccine</h1>
                        <h4>Harness the power of your health insights</h4>
                        <p>Take control of your health decision-making and priority-setting
                            by tracking symptoms, treatments, labs, and vitals in one easy-
                            to-navigate place.</p>
                    </div>

                    <div class="col">
                        <img class="w-100" src="{{ asset('page_assets/img/Mask-Group.png') }}" alt="Image" style="min-width: 100%; min-height: 115%; object-fit: fill;">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex py-5 px-4">
                        
                        <div class="ps-4 text-center">
                            <img class="w-90 pb-3" src="{{ asset('page_assets/img/Sharing_icon.png') }}" alt="Image" style="width: 170px; height: 170px; object-fit: fill;">
                            <h5 class="mb-3">SHARING</h5>
                            <p>Easily share data with doctors, caregivers, and
                                loved ones for more efficient and effective
                                conversations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="d-flex bg-light py-5 px-4">
                        
                        <div class="ps-4 text-center">
                            <img class="w-90 pb-3" src="{{ asset('page_assets/img/Actionable_insights_icon.png') }}" alt="Image" style="width: 170px; height: 170px; object-fit: fill;">
                            <h5 class="mb-3">ACTIONABLE INSIGHTS</h5>
                            <p>See how your experience compares with others and
                                get suggestions to help inform a healthy path
                                forward.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex py-5 px-4">
                        
                        <div class="ps-4 text-center">
                            <img class="w-90 pb-3" src="{{ asset('page_assets/img/Support_system_icon.png') }}" alt="Image" style="width: 170px; height: 170px; object-fit: fill;">
                            <h5 class="mb-3">SUPPORT SYSTEM</h5>
                            <p>Engage with a vibrant community of peer
                                support that genuinely understands and is there
                                for you when you need it most.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Line Start -->
    <div class="container-xxl py-5">
        <div class="container">
            
            <hr class="divider width-1000">
        </div>
    </div>
    <!-- line End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 text-center">
                    <h1 class="text-center" style="color: black;">
                        <span class="my-health-testimony-quote my-health-testimony-quote-left" style="font-size: 48px; color: rgb(122, 191, 185);">“</span>
                        <span style="font-weight: normal; font-size: 32px;">Chronicling my illness on PLM over the past 8 years has
                            served as a solid longitudinal record of the trajectory of my
                            conditions, a record arguably more significant to me than my
                            formal medical records.</span>
                        <span class="my-health-testimony-quote my-health-testimony-quote-right" style="font-size: 48px; color: rgb(122, 191, 185);">”</span>
                    </h1>
                    <img src="{{ asset('page_assets/img/Doug_headshot.png') }}" alt="Testimonial Person" class="rounded-circle mr-4" width="250" height="250">
                    <h5 class="mt-3 testimonial-label font-20">DOUG <span class="darkcyan-color">//</span><span class="sub-text"> Living with depression</span></h5>
                    <hr class="dotted-line width-640">
                    <br/>
                    <h3>Tracking health data has a measurable impact</h3>
                    <p>A study conducted with the University of California, San Francisco (UCSF) and the Veterans Health Administration (VHA) in
                        the PatientsLikeMe epilepsy community tracked patients over 6 months found that:</p>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Testimonial End -->






    <!-- ======= Speakers Section ======= -->
    <section id="speakers">
        <div class="container" data-aos="fade-up">
          {{-- <div class="section-header">
            <h2>Event Speakers</h2>
            <p>Here are some of our speakers</p>
          </div> --}}


  
          <div class="row">

            @if(isset($vaccines) && $vaccines->count() > 0)

                @foreach ($vaccines as $vaccine)
                    <div class="col-lg-4 col-md-6">
                        <div class="speaker text-center" data-aos="fade-up" data-aos-delay="100">
                            <p style="font-weight: bold; font-size: 70px; color: rgb(122, 191, 185);">{{$vaccine->taken_percent}}%</p>
                            <h3>{{$vaccine->name}}</h3>
                        </div>
                    </div>

                @endforeach
                
            @else
                <h2>No Vaccine Available</h2>
            @endif

            
          </div>
        </div>
  
      </section><!-- End Speakers Section -->



    <!-- Line Start -->
    <div class="container-xxl py-5">
        <div class="container text-center">
            
            <hr class="divider width-1000">


            <h3 class="pb-2">Start tracking your health</h3>
            <a href="{{route('signup')}}" class="btn btn-warning btn-lg" >Join us!</a>
        </div>
    </div>
    <!-- line End -->


    <!-- About Start -->
    {{-- <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 pt-4" style="min-height: 400px;">
                    <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                        <img class="position-absolute img-fluid w-100 h-100" src="img/about.jpg" style="object-fit: cover;" alt="">
                        <div class="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5" style="background: rgba(0, 0, 0, .08);">
                            <h1 class="display-4 text-white mb-0">15 <span class="fs-4">Years</span></h1>
                            <h4 class="text-white">Experience</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h6 class="text-primary text-uppercase">// About Us //</h6>
                    <h1 class="mb-4"><span class="text-primary">CarServ</span> Is The Best Place For Your Auto Care</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <div class="row g-4 mb-3 pb-3">
                        <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">01</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Professional & Expert</h6>
                                    <span>Diam dolor diam ipsum sit amet diam et eos</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">02</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Quality Servicing Center</h6>
                                    <span>Diam dolor diam ipsum sit amet diam et eos</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                            <div class="d-flex">
                                <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                    <span class="fw-bold text-secondary">03</span>
                                </div>
                                <div class="ps-3">
                                    <h6>Awards Winning Workers</h6>
                                    <span>Diam dolor diam ipsum sit amet diam et eos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="" class="btn btn-primary py-3 px-5">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- About End -->


    <!-- Fact Start -->
    {{-- <div class="container-fluid fact bg-dark my-5 py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <i class="fa fa-check fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">1234</h2>
                    <p class="text-white mb-0">Years Experience</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <i class="fa fa-users-cog fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">1234</h2>
                    <p class="text-white mb-0">Expert Technicians</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <i class="fa fa-users fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">1234</h2>
                    <p class="text-white mb-0">Satisfied Clients</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <i class="fa fa-car fa-2x text-white mb-3"></i>
                    <h2 class="text-white mb-2" data-toggle="counter-up">1234</h2>
                    <p class="text-white mb-0">Compleate Projects</p>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Fact End -->


    <!-- Team Start -->
    {{-- <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Our Technicians //</h6>
                <h1 class="mb-5">Our Expert Technicians</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-1.jpg" alt="">
                            <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-2.jpg" alt="">
                            <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-3.jpg" alt="">
                            <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="img/team-4.jpg" alt="">
                            <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="bg-light text-center p-4">
                            <h5 class="fw-bold mb-0">Full Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Team End -->




@endsection