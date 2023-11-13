@extends('common.main')
@section('main')

    


    <!-- ======= Sign Up Form ==== -->

  
    
                  <div class="card mb-3">
    
                    <div class="card-body">
    
                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                        <p class="text-center small">Enter your personal details to create account</p>
                      </div>
    
                      <form method="POST" action="{{ route('register') }}" class="row g-3 needs-validation" novalidate>
                        @csrf

                        <div class="col-12">
                            <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                            <div class="input-group has-validation">
                              <span class="input-group-text" id="inputGroupPrepend">@</span>
                              <input type="text" name="username" class="form-control" id="username" value="{{old('username')}}" required>
                              <div class="invalid-feedback">Please choose a username.</div>
                            </div>
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>
    
                        <div class="col-12">
                          <label for="yourEmail" class="form-label">Your Email<span class="text-danger">*</span></label>
                          <input type="email" name="email" class="form-control" id="yourEmail" value="{{old('email')}}" required>
                          <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                        </div>
    
                        <div class="col-12">
                          <label for="yourPassword" class="form-label">Password<span class="text-danger">*</span></label>
                          <input type="password" name="password" class="form-control" id="yourPassword" required>
                          <div class="invalid-feedback">Please enter your password!</div>
                          <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="col-12">
                            <label for="yourConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="yourConfirmPassword" required>
                            <div class="invalid-feedback">Please enter your password!</div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="col-12">
                            <label for="yourPhone" class="form-label">Your Phone<span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" id="yourPhone" value="{{old('phone')}}" required>
                            <div class="invalid-feedback">Please, enter your phone number!</div>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>


                        <div class="col-12">
                            <label for="yourAddress" class="form-label">Your Address<span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control" id="yourAddress" value="{{old('address')}}" required>
                            <div class="invalid-feedback">Please, enter your address!</div>
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>


    
                        {{-- <div class="col-12">
                          <div class="form-check">
                            <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                            <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                            <div class="invalid-feedback">You must agree before submitting.</div>
                          </div>
                        </div> --}}
                        <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Create Account</button>
                        </div>
                        <div class="col-12">
                          <p class="small mb-0">Already have an account? <a href="{{ route('signin') }}">Log in</a></p>
                        </div>
                      </form>
    
                    </div>
                  </div>
    
                  

    <!-- End #Sign Up Form -->





@endsection