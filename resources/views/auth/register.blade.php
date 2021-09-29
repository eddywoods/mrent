@extends('layouts.app')
@section('content')
<main id="ts-main" >
   <section id="login-register" style="margin-top: 15%">
      <div class="container">
         <div class="row">
            <div class="offset-md-2 col-md-8 offset-lg-3 col-lg-6 shadow p-3 mb-5 bg-white rounded" style="padding: 20px">
               @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               <ul class="nav nav-tabs" id="login-register-tabs" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">
                        <h3>Create an M-rent Account</h3>
                     </a>
                  </li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="register" role="tabpanel" aria-labelledby="register-tab">
                     <form class="ts-form" id="form-register" role="form" action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="row">
                           <div class="col-md-6 my-3">
                              <label style="padding-right: 80px"><input type="radio" name="customer_type" id="customerRadio" value="individual" checked> Individual</label>
                           </div>
                           <div class="col-md-6 my-3">
                              <label style="padding-right: 80px"><input type="radio" name="customer_type" id="companyRadio" value="company"> Company</label>
                           </div>
                        </div>
                        <div id="conf" class="row hide">
                           <div id="company" class="col-md-12 my-3">
                              <label class="details-title text-small">Company Name</label>
                              <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}"  autocomplete="company_name">
                              <span class="text-danger" role="alert">
                              <strong id="company_name-error"></strong>
                              </span>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 my-3">
                              <label class="details-title text-small">First Name</label>
                              <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                              <span class="text-danger" role="alert">
                              <strong id="first_name-error"></strong>
                              </span>
                           </div>
                           <div class="col-md-6 my-3">
                              <label class="details-title text-small">Middle Name</label>
                              <input id="middle_name" type="middle_name" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autocomplete="middle_name">
                              <span class="text-danger" role="alert">
                              <strong id="middle_name-error"></strong>
                              </span>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 my-3">
                              <label class="details-title text-small">Last Name</label>
                              <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                              <span class="text-danger" role="alert">
                              <strong id="last_name-error"></strong>
                              </span>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 my-3">
                              <label class="details-title text-small">Select User Type</label>
                              <div class="select">
                                 <select name="user_type" class="form-control">
                                    <option value="">select..</option>
                                    <option value="landlord">Landlord</option>
                                    <option value="agent">Agent</option>
                                 </select>
                                 <span class="text-danger" role="alert">
                                 <strong id="user_type-error"></strong>
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-6 my-3">
                              <label class="details-title text-small">Citizenship</label>
                              <div class="select">
                                 <select id="citizenship" name="citizenship" class="form-control">
                                    <option value="">Select..</option>
                                    <option value="kenyan">Kenyan</option>
                                    <option value="foreigner">Non-Citizen</option>
                                 </select>
                                 <span class="text-danger" role="alert">
                                 <strong id="citizenship-error"></strong>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 my-3">
                              <div class="form-group">
                                 <label class="details-title text-small">Email</label>
                                 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                 <span class="text-danger" role="alert">
                                 <strong id="email-error"></strong>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 my-3">
                              <label class="details-title text-small">ID Number</label>
                              <input id="id_number" type="id_number" class="form-control @error('id_number') is-invalid @enderror" name="id_number" value="{{ old('id_number') }}" required autocomplete="id_number">
                              <span class="text-danger" role="alert">
                              <strong  id="id_number-error"></strong>
                              </span>
                           </div>
                           <div class="col-md-6 my-3">
                              <label class="details-title text-small">Phone Number</label>
                              <input id="phone_number" type="phone_number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                              <span class="text-danger" role="alert">
                              <strong  id="phone_number-error"></strong>
                              </span>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 my-3">
                              <label class="details-title text-small">Password</label>
                              <input id="password" type="password" class="form-control" name="password" required>
                              <span class="text-danger" role="alert">
                              <strong  id="password-error"></strong>
                              </span>
                           </div>
                           <div class="col-md-6 my-3">
                              <label class="details-title text-small">Confirm Password</label>
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                           </div>
                        </div>
                        <div class="my-4">
                           <label class="" for="register-check">By creating an account with m-rent, you agree to our <a href="#" class="btn-link">Terms and Conditions</a></label>
                        </div>
                        <div class="loader text-warning">
                           <center>
                              <button class="btn pull-right btn-info btn-block" id="account-submit">Create an Account</button>
                           </center>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>
@endsection
@section('scripts')
<script>
   $(document).ready(function () {
       var company =  $('#company');
       $('#company').detach()
   $('input[type=radio]').click(function(e){
       var c = $('input[name=customer_type]:checked').val();
       if (c == 'company') {
       $('#conf').show();
       $('#conf').append(company)
       } else if(c == 'individual') {
         $('#conf').hide();
         $('#company').detach()
       }
       });
   });
   
</script>
@endsection