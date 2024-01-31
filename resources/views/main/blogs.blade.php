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
                <a href="{{route('vaccination')}}" class="nav-item nav-link">Vaccination</a>
                <a href="{{route('blogs')}}" class="nav-item nav-link active">Blogs</a>
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
                        <h1 class="display-3 mb-3 animated slideInDown">Blogs</h1>
                    </div>

                    <div class="col-8">
                        <img class="w-100" src="{{ asset('page_assets/img/condition-banner-header.png') }}" alt="Image" style="min-width: 100%; min-height: 110%; object-fit: fill;">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Blogs Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            



            @if(isset($blog_posts) && count($blog_posts) > 0)
                @foreach($blog_posts as $key => $blog_post)
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-8">
                            <div class="card">
                                <img src="{{ (!empty($blog_post->image)) ? url('page_assets/img/'.$blog_post->image) : url('upload/No_Image_Available.jpg') }}" class="card-img-top" alt="{{ $blog_post->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $blog_post->title }}</h5>
                                    <p class="card-text">{{ $blog_post->description }}</p>
                                    <a href="{{ $blog_post->link }}" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info" role="alert">
                    No blog posts available.
                </div>
            @endif





        </div>
    </div>
    <!-- Blogs End -->




@endsection