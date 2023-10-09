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
                <a href="/" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">My Health</a>
                <a href="service.html" class="nav-item nav-link">Conditions</a>
                <a href="service.html" class="nav-item nav-link">Treatments</a>
                <a href="contact.html" class="nav-item nav-link">Blogs</a>
            </div>
            <div class="px-2"><button onclick="window.location.href='{{route('signin')}}'" class="nav-item btn btn-outline-dark ">Sign In</button></div>
            <a href="{{route('signup')}}" class="btn btn-warning py-4 px-lg-5 d-none d-lg-block">Join Now!<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    

    <div class="row" style="background-color: #e4f4f2;">
        <div class="col-md-5">

            <div class="text-center text-lg-start pt-5 m-5">
                
                <h1 class="display-3 text-black mb-4 pb-3 animated slideInDown">Striving for a Healthier Bangladesh - Vaccine Management Initiative</h1>
                <div class="pr-5">
                    <h4 class="text-black mb-4 pb-3 animated slideInDown">Facilitating Health and Well-being: Navigating Bangladesh's Vaccine Landscape with Ease and Efficiency.</h4>
                </div>
            </div>
            
        </div>
        <div class="col">


            <div class="container-fluid p-0">
                <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="w-100" src="{{ asset('page_assets/img/home_hero_meet.png') }}" alt="Image" style="max-width: 100%; max-height: 630px; object-fit: fill;">
                        </div>

                        <div class="carousel-item">
                            <img class="w-100" src="{{ asset('page_assets/img/home_hero_learn.png') }}" alt="Image" style="max-width: 100%; max-height: 630px; object-fit: fill;">
                            
                        </div>

                        <div class="carousel-item">
                            <img class="w-100" src="{{ asset('page_assets/img/home_hero_track.png') }}" alt="Image" style="max-width: 100%; max-height: 630px; object-fit: fill;">
                            
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>



        </div>
    </div>


    
    <!-- Carousel End -->


    <!-- Service Start -->
    {{-- <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="d-flex py-5 px-4">
                        <i class="fa fa-certificate fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Quality Servicing</h5>
                            <p>Diam dolor diam ipsum sit amet diam et eos erat ipsum</p>
                            <a class="text-secondary border-bottom" href="">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="d-flex bg-light py-5 px-4">
                        <i class="fa fa-users-cog fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Expert Workers</h5>
                            <p>Diam dolor diam ipsum sit amet diam et eos erat ipsum</p>
                            <a class="text-secondary border-bottom" href="">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex py-5 px-4">
                        <i class="fa fa-tools fa-3x text-primary flex-shrink-0"></i>
                        <div class="ps-4">
                            <h5 class="mb-3">Modern Equipment</h5>
                            <p>Diam dolor diam ipsum sit amet diam et eos erat ipsum</p>
                            <a class="text-secondary border-bottom" href="">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Service End -->


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






    <!-- ======= Schedule Section ======= -->
    <section id="schedule" class="section-with-bg">
        <div class="container" data-aos="fade-up">
          <div class="text-center section-header">
            <h1>Getting started is easy!</h1>
            <br />
            <br />
            <br />
          </div>
  
          <ul class="nav nav-tabs" role="tablist" data-aos="fade-up" data-aos-delay="100">
            <li class="nav-item mx-3">
                <h3>I want to...</h3>
              </li>
            <li class="nav-item mx-3">
              <a class="nav-link active" href="#day-1" role="tab" data-bs-toggle="tab"><i class="fa fa-comment me-1"></i>Meet others like me</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="#day-2" role="tab" data-bs-toggle="tab"><i class="fa fa-book-open me-1"></i>Learn about my condition</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="#day-3" role="tab" data-bs-toggle="tab"><i class="fa fa-heartbeat me-1"></i>Track my health</a>
            </li>
          </ul>
  
          {{-- <h3 class="sub-heading">Voluptatem nulla veniam soluta et corrupti consequatur neque eveniet officia. Eius
            necessitatibus voluptatem quis labore perspiciatis quia.</h3> --}}
  
          <div class="tab-content row justify-content-center" data-aos="fade-up" data-aos-delay="200">
  
            <!-- Schdule Day 1 -->
            <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">
  
                <div class="row ">
                    <div class="columns small-24 large-8">
                        <div class="detail-point">
                            <div class="index mr-3 mr-md-4 meet">1</div>
                            <div class="details mt-2">
                                <strong class="header">Share your story</strong>
                                <div class="description">Introduce yourself to the community. Share as little, or as much, about your health journey and the support you're looking for.</div>
                            </div>
                        </div>
                    </div>
                    <div class="columns small-24 large-8 tab-padding">
                        <div class="detail-point">
                            <div class="index mr-3 mr-md-4 meet">2</div>
                            <div class="details mt-2">
                                <strong class="header">Find your community</strong>
                                <div class="description">We offer 70 communities that cover 2,800 conditions where you can make helpful connections and be part of a safe community.</div>
                            </div>
                        </div>
                    </div>
                    <div class="columns small-24 large-8 tab-padding">
                        <div class="detail-point">
                            <div class="index mr-3 mr-md-4 meet">3</div>
                            <div class="details mt-2">
                                <strong class="header">Join the discussion</strong>
                                <div class="description">Find personalized answers, offer advice and feel supported by people who know what you are going through.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <br />


                <div class="row" style="width:1000px;  min-height: 100%;">
                    <div class="col">
                        <img class="w-100" src="{{ asset('page_assets/img/day-1-1.png') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>
                    <div class="col">
                        <img class="w-100" src="{{ asset('page_assets/img/day-1-2.png') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>
                    <div class="col">
                        <img class="w-100" src="{{ asset('page_assets/img/day-1-3.png') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>

                </div>
  
            </div>
            <!-- End Schdule Day 1 -->
  
            <!-- Schdule Day 2 -->
            <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-2">
  
                <div class="row ">
                    <div class="columns small-24 large-8">
                        <div class="detail-point">
                            <div class="index mr-3 mr-md-4 meet">1</div>
                            <div class="details mt-2">
                                <strong class="header">Discover the next step in your care</strong>
                                <div class="description">Explore first-hand treatment reviews from people living with your condition to uncover personalized and effective options.</div>
                            </div>
                        </div>
                    </div>
                    <div class="columns small-24 large-8 tab-padding">
                        <div class="detail-point">
                            <div class="index mr-3 mr-md-4 meet">2</div>
                            <div class="details mt-2">
                                <strong class="header">Get insights into your condition</strong>
                                <div class="description">Ask questions that matter to you – and get “real, lived experiences” that help you move forward.</div>
                            </div>
                        </div>
                    </div>
                    <div class="columns small-24 large-8 tab-padding">
                        <div class="detail-point">
                            <div class="index mr-3 mr-md-4 meet">3</div>
                            <div class="details mt-2">
                                <strong class="header">Learn new ways to influence your health outcomes</strong>
                                <div class="description">Join in conversations about treatments, diagnosis, and recovery journey.</div>
                            </div>
                        </div>
                    </div>
                </div>


                <br />


                <div class="row" style="width:1000px;  min-height: 100%;">
                    <div class="col">
                        <img class="w-100" src="{{ asset('page_assets/img/day-2-1.png') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>
                    <div class="col">
                        <img class="w-100" src="{{ asset('page_assets/img/day-2-2.png') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>
                    <div class="col">
                        <img class="w-100" src="{{ asset('page_assets/img/day-2-3.png') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>

                </div>
  
            </div>
            <!-- End Schdule Day 2 -->
  
            <!-- Schdule Day 3 -->
            <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-3">
  
                <div class="row ">
                    <div class="columns small-24 large-8">
                        <div class="detail-point">
                            <div class="index mr-3 mr-md-4 meet">1</div>
                            <div class="details mt-2">
                                <strong class="header">Make informed care decisions</strong>
                                <div class="description">Track your conditions, symptoms and treatment effectiveness in one place so you can see your complete health picture.</div>
                            </div>
                        </div>
                    </div>
                    <div class="columns small-24 large-8 tab-padding">
                        <div class="detail-point">
                            <div class="index mr-3 mr-md-4 meet">2</div>
                            <div class="details mt-2">
                                <strong class="header">Take control of your healthcare decision making</strong>
                                <div class="description">Get personalized education, tools, and motivational nudges that will help you take charge of your health.</div>
                            </div>
                        </div>
                    </div>
                    <div class="columns small-24 large-8 tab-padding">
                        <div class="detail-point">
                            <div class="index mr-3 mr-md-4 meet">3</div>
                            <div class="details mt-2">
                                <strong class="header">Get the most out of your care team</strong>
                                <div class="description">Easily share your health data with doctors, caregivers, family or friends to lead to more efficient conversations and effective care plans.</div>
                            </div>
                        </div>
                    </div>
                </div>


                <br />


                <div class="row" style="width:1000px;  min-height: 100%;">
                    <div class="col">
                        <img class="w-100" src="{{ asset('page_assets/img/day-3-1.png') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>
                    <div class="col">
                        <img class="w-100" src="{{ asset('page_assets/img/day-3-2.png') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>
                    <div class="col">
                        <img class="w-100" src="{{ asset('page_assets/img/day-3-3.png') }}" alt="Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>

                </div>
  
            </div>
            <!-- End Schdule Day 3 -->
  
          </div>
  
        </div>
  
    </section><!-- End Schedule Section -->









    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h2 class="mb-5">Join over 850,000 members on the road to better health. &nbsp; &nbsp; <a href="{{route('signup')}}" class="btn btn-warning btn-lg" >Join Now!</a></h2> 
            </div>
            <div class="row g-4">
                
            </div>
        </div>
    </div>
    <!-- Team End -->






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


    <!-- Service Start -->
    {{-- <div class="container-xxl service py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Our Services //</h6>
                <h1 class="mb-5">Explore Our Services</h1>
            </div>
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-4">
                    <div class="nav w-100 nav-pills me-4">
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                            <i class="fa fa-car-side fa-2x me-3"></i>
                            <h4 class="m-0">Diagnostic Test</h4>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                            <i class="fa fa-car fa-2x me-3"></i>
                            <h4 class="m-0">Engine Servicing</h4>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                            <i class="fa fa-cog fa-2x me-3"></i>
                            <h4 class="m-0">Tires Replacement</h4>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-0" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                            <i class="fa fa-oil-can fa-2x me-3"></i>
                            <h4 class="m-0">Oil Changing</h4>
                        </button>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content w-100">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/service-1.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-3">15 Years Of Experience In Auto Servicing</h3>
                                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                    <a href="" class="btn btn-primary py-3 px-5 mt-3">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/service-2.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-3">15 Years Of Experience In Auto Servicing</h3>
                                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                    <a href="" class="btn btn-primary py-3 px-5 mt-3">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/service-3.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-3">15 Years Of Experience In Auto Servicing</h3>
                                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                    <a href="" class="btn btn-primary py-3 px-5 mt-3">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                            <div class="row g-4">
                                <div class="col-md-6" style="min-height: 350px;">
                                    <div class="position-relative h-100">
                                        <img class="position-absolute img-fluid w-100 h-100" src="img/service-4.jpg"
                                            style="object-fit: cover;" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="mb-3">15 Years Of Experience In Auto Servicing</h3>
                                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                    <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                    <a href="" class="btn btn-primary py-3 px-5 mt-3">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Service End -->


    <!-- Booking Start -->
    {{-- <div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                        <h1 class="text-white mb-4">Certified and Award Winning Car Repair Service Provider</h1>
                        <p class="text-white mb-0">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                        <h1 class="text-white mb-4">Book For A Service</h1>
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Your Name" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control border-0" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select border-0" style="height: 55px;">
                                        <option selected>Select A Service</option>
                                        <option value="1">Service 1</option>
                                        <option value="2">Service 2</option>
                                        <option value="3">Service 3</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control border-0 datetimepicker-input"
                                            placeholder="Service Date" data-target="#date1" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control border-0" placeholder="Special Request"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-secondary w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Booking End -->


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


    <!-- Testimonial Start -->
    {{-- <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="text-primary text-uppercase">// Testimonial //</h6>
                <h1 class="mb-5">Our Clients Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item text-center">
                    <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="img/testimonial-1.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="img/testimonial-2.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="img/testimonial-3.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="img/testimonial-4.jpg" style="width: 80px; height: 80px;">
                    <h5 class="mb-0">Client Name</h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Testimonial End -->


@endsection