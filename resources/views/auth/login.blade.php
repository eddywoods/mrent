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
                        <h3>Login To Your Mrent Account</h3>
                     </a>
                  </li>
                 
               </ul>
               <!--TAB CONTENT
                  =========================================================================================-->
               <div class="tab-content">
                  <!--LOGIN TAB
                     =====================================================================================-->
                  <div class="tab-pane active" id="login" role="tabpanel" aria-labelledby="login-tab">
                     <form class="ts-form" id="form-login" action="{{ route('login') }}" method="post" style="padding: 30px">
                        @csrf
                        <div class="form-group">
                           <label for="form-create-account-email">Email:</label>
                           <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                           @error('email')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                           <label for="form-create-account-password">Password:</label>
                           <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                           @error('password')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                           @enderror
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                           <div class="col-md-6 offset-md-1">
                              <div class="form-check">
                                 <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                 <label class="form-check-label" for="remember">
                                 {{ __('Remember Me') }}
                                 </label>
                              </div>
                           </div>
                        </div>
                        <div class="form-group clearfix">
                            <center>
                           <button type="submit" class="btn pull-right btn-info btn-block">Login In My Account</button>
                            </center>
                        </div>
                        <!-- /.form-group -->
                     </form>
                     <hr>
                     <!--Forgot password link-->
                     <a href="{{ route('password.request') }}" class="ts-text-small">
                     <i class="fa fa-sync-alt ts-text-color-primary mr-2"></i>
                     <span class="ts-text-color-light">I have forgot my password</span>
                     </a>
                  </div>
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