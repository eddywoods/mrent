@extends('layouts.agent')
@section('content')
<div class="app-main__outer">
   @if ($message = Session::get('success'))
   <div class="alert alert-success">
      <strong>{!! $message !!}</strong>
   </div>
   <?php Session::forget('success');?>
   @endif
   @if ($message = Session::get('error'))
   <div class="alert alert-danger">
      <strong>{!! $message !!}</strong>
   </div>
   <?php Session::forget('error');?>
   @endif
   <div class="app-main__inner">
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif

      <div class="mbg-3 alert alert-warning alert-dismissible fade show" role="alert">
         <span class="pr-2">
         <i class="fa fa-info-circle"></i>
         </span>
         Create unit labels in building Details before adding tenant
      </div>



      <div class="app-page-title">
         <div class="page-title-wrapper">
            <div class="page-title-heading">
               <div class="page-title-icon">
                  <i class="lnr-map text-info">
                  </i>
               </div>
               <div>
                  Add New Tenant
               </div>
            </div>
         </div>
      </div>
      <div class="tab-content">
         <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
               <div class="col-lg-12 col-md-12">
                  <div class="main-card mb-3 card">
                      <div class="row">
                          <div class="col-md-8 offset-md-2 shadow p-3 mb-5 bg-white rounded">
                            <div class="card-header">
                              Add New Tenant
                            </div>
                     <div class="card-body">

                       
                      
                              <form action="{{url('agent/add-tenant')}}" method="POST" style="padding: 40px">
                                 @csrf
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="exampleEmail" class="">First Name</label>
                                             <input name="first_name"  placeholder="first name" type="text" class="form-control" value="{{ old('first_name') }}">
                                          </div>
                                       </div>
                                       <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="exampleEmail" class="">Middle name</label>
                                             <input name="middle_name" placeholder="middle name" type="text" class="form-control" value="{{ old('middle_name') }}">
                                          </div>
                                       </div>
                                       <div class="col col-12">
                                          <div class="position-relative form-group">
                                             <label for="" class="">Last name</label>
                                             <input name="last_name" placeholder="last name" type="text" class="form-control" value="{{ old('last_name') }}">
                                          </div>
                                       </div>
                                       <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="" class="">Mobile Number</label>
                                             <input name="phone_number" placeholder="phone number" type="text" class="form-control" value="{{ old('phone_number') }}">
                                          </div>
                                       </div>
                                       <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="" class="">ID Number</label>
                                             <input name="id_number" placeholder="ID Number" type="text" class="form-control" value="{{ old('id_number') }}">
                                          </div>
                                       </div>
                                       <div class="col col-12">
                                          <div class="position-relative form-group">
                                             <label for="" class="">Email</label>
                                             <input name="email" placeholder="email" type="text" class="form-control" value="{{ old('email') }}">
                                          </div>
                                       </div>
                                       <div class="col col-6">
                                          <input name="user_type" type="hidden" value="tenant">
                                          <div class="position-relative form-group">
                                             <label for="exampleSelect" class="">Citizenship</label>
                                             <select name="citizenship" id="exampleSelect" class="form-control">
                                                <option value="kenyan">kenyan</option>
                                                <option value="foreigner">Foreigner</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="exampleSelect" class="">Select Building</label>
                                             <select name="building_id" id="building" class="form-control">
                                                <option value="">Select Building</option>
                                                @if ($buildings)
                                                @foreach ($buildings as $b)
                                                <option value="{{$b->id}}">{{$b->building_name}}</option>
                                                @endforeach
                                                @endif
                                             </select>
                                          </div>
                                       </div>

                                       <div class="col col-12">
                                             <div class="position-relative form-group">
                                                   <div class="date" id="datetimepicker2">
                                                      <label for="exampleEmail5">Entry Date</label>
                                                     <input type="text" class="form-control"  name="entry_date" autocomplete="off" value="{{ old('entry_date') }}" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                                   </div>
                                               </div>
   
                                       </div>

                                       <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="exampleSelect" class="">Select Unit</label>
                                             <select name="unit_id" id="units" class="form-control">
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="exampleSelect" class="">Select Unit Number</label>
                                             <select name="unit_number" id="labels" class="form-control">
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="" class="">Rent Amount (Optional)</label>
                                             <input name="tenant_rent_amount" placeholder="e.g 20000" type="text" class="form-control" value="{{ old('tenant_rent_amount') }}">
                                          </div>
                                       </div>
                                       <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="" class="">Deposit Amount (Optional)</label>
                                             <input name="tenant_deposit_amount" placeholder="e.g 20000" type="text" class="form-control" value="{{ old('tenant_deposit_amount') }}">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create Tenant</button>
                                 </div>
                              </form>
                            </div>
                        </div>
                          


                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
@section('javascript')
<script>
  $(document).ready(function () {
    $('#building').change(function() {
  
        $.ajax({
            type:"GET",
            url : "getunits/"+$(this).val(),
            success : function(response) {
                data = response;
                var select = $('#units');
                  select.empty();
                  $.each(data, function(index, value) {      
                      select.append(
                          $('<option></option>').val(value.unitid).html(value.unit_type_name)
                      );
            });
  
            var select = $('#labels');
                  select.empty();
                  $.each(data['labels'], function(index, value) {      
                      select.append(
                          $('<option></option>').val(value.id).html(value.label)
                      );
            });
  
  
  
            },
            error: function() {
                console.log('Error occured');
            }
        });
  
      
    });
  });

  $('#datetimepicker2').datepicker({
          weekStart: 0,
          todayBtn: "linked",
          language: "en",
          orientation: "bottom auto",
          keyboardNavigation: false,
          autoclose: true
      });


</script>
@endsection