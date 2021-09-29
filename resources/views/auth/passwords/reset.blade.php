@extends('layouts.app')
@section('content')
<main id="ts-main" >
 
   <!--LOGIN / REGISTER SECTION
      =========================================================================================================-->
   <section id="login-register" style="margin-top: 15%">
      <div class="container">
         <div class="row">
            <div class="offset-md-2 col-md-8 offset-lg-3 col-lg-6 shadow p-3 mb-5 bg-white rounded" style="padding: 20px">
               <!--LOGIN / REGISTER TABS
                  =========================================================================================-->
               <ul class="nav nav-tabs" id="login-register-tabs" role="tablist">
                  <!--Login tab-->
                  <li class="nav-item">
                     <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">
                        <h3>Reset Password</h3>
                     </a>
                  </li>
                 
               </ul>
               <!--TAB CONTENT
                  =========================================================================================-->
               <div class="tab-content">
                  <!--LOGIN TAB
                     =====================================================================================-->
               
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-6 col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-6 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-6 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                     <hr>
                     <!--Forgot password link-->
                     <a href="{{ route('password.request') }}" class="ts-text-small">
                     <i class="fa fa-sync-alt ts-text-color-primary mr-2"></i>
                     <span class="ts-text-color-light">I have forgot my password</span>
                     </a>
                
                  <!--end #register.tab-pane-->
               </div>
               <!--end tab-content-->
            </div>
            <!--end offset-4.col-md-4-->
         </div>
         <!--end row-->
      </div>
      <!--end container-->
   </section>
</main>
<!--end #ts-main-->

@endsection
