@extends('common.main')
@section('main')

    


    <!-- ======= SignIn Form ==== -->

    



    
                  <div class="card mb-3">
    
                    <div class="card-body">
    
                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                        <p class="text-center small">Enter your username & password to login</p>
                      </div>
    
                      <form method="POST" action="{{ route('login') }}" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-12">
                          <label for="username_email" class="form-label">Username / Email</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" name="username_email" class="form-control" id="username_email" required>
                            <div class="invalid-feedback">Please enter your username.</div>
                          </div>
                          <x-input-error :messages="$errors->get('username_email')" class="text-danger mt-2" />
                        </div>
    
                        <div class="col-12">
                          <label for="password" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="password" required>
                          <div class="invalid-feedback">Please enter your password!</div>
                          <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
                        </div>
    
                        {{-- <div class="col-12">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                          </div>
                        </div> --}}
                        <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Login</button>
                        </div>
                        <div class="col-12">
                          <p class="small mb-0">Don't have account? <a href="{{ route('signup') }}">Create an account</a></p>
                        </div>
                      </form>
    
                    </div>
                  </div>






    <!-- End #SignIn Form -->






@endsection