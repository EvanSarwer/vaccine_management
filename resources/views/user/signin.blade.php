<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CarServ - Car Repair HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('page_assets/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('page_assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('page_assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('page_assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('page_assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('page_assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    


    <!-- ======= SignIn Form ==== -->

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="card">
                    <!-- Blue Bar -->
                    <div class="card-header bg-primary text-white text-center">
                        <i class="fa fa-clinic-medical me-3"></i>Vaccine Management
                    </div>
                    <div class="card-body">
                        <h2 class="card-title text-center">Sign In</h2>
    
                        <!-- Divider Line -->
                        <hr class="mb-4">
    
                        <form method="POST" action="">
                            @csrf
    
                            <div class="mb-3">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
    
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                            </div>
    
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
    
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block btn-lg px-5">Sign In</button>
                            </div>
                        </form>
                        
                        <!-- Create New Account Link -->
                        <div class="text-center mt-3">
                            <a href="{{ route('signup') }}">Create New Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End #SignIn Form -->




    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s" >
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 col-md-6">
                    <h3 class="m-0 text-primary pb-4"><i class="fa fa-clinic-medical me-3"></i>Vaccine Management</h3>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">WORK WITH US</h4>
                    <h6 class="text-light">Our partners</h6>
                    <h6 class="text-light">Research Publications</h6>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">COMPANY</h4>
                    <a class="btn btn-link" href="">My Health</a>
                    <a class="btn btn-link" href="">Conditions</a>
                    <a class="btn btn-link" href="">Treatments</a>
                    <a class="btn btn-link" href="">Blogs</a>
                    <a class="btn btn-link" href="">Vacuam Cleaning</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="/">Vaccine Management</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="/">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('page_assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('page_assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('page_assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('page_assets/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('page_assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('page_assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('page_assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('page_assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('page_assets/js/main.js') }}"></script>
</body>

</html>