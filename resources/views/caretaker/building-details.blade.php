@extends('layouts.caretaker')
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
      <div class="app-page-title">
         <div class="page-title-wrapper">
            <div class="page-title-heading">
               <div class="page-title-icon">
                  <i class="pe-7s-light icon-gradient bg-malibu-beach">
                  </i>
               </div>
               <div>
                  {{$building->building_name}}  Building Details
               </div>
            </div>
            <div class="page-title-actions">
               <div class="d-inline-block dropdown">
                  <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                  Add New Tenant
                  </button>
                 
               </div>
              
            </div>
         </div>
      </div>
      <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
         <li class="nav-item">
            <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
            <span>Building Information</span>
            </a>
         </li>
         <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
            <span>Tenants</span>
            </a>
         </li>
         <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-90">
            <span>Caretakers</span>
            </a>
         </li>
         <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-3">
            <span>Photos</span>
            </a>
         </li>
         <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-8">
            <span>House Units</span>
            </a>
         </li>
         <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-4">
            <span>Unit Labels</span>
            </a>
         </li>
         <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
            <span>Building Docs and Notice Board</span>
            </a>
         </li>
      </ul>
      <div class="tab-content">
         <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
               <div class="col-md-6">
                  <div class="main-card mb-3 card">
                     <div class="card-body">
                        <h5 class="card-title">General Info</h5>
                        <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                           <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">Name: {{ $building->building_name }}</h4>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <p>Location: {{ $building->location }}</p>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item dot-success vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">
                                       Onboard Since: {{ $building->created_at }}
                                    </h4>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="main-card mb-3 card">
                     <div class="card-body">
                        <h5 class="card-title">Banking Info</h5>
                        <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in">
                                 <i class="badge badge-dot badge-dot-xl badge-success"></i>
                                 </span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">Bank Name: {{ $building->bank_name }}</h4>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in">
                                 <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                 </span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <p> Paybill Number  <b class="text-danger">{{ $building->paybill_number }}</b></p>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in">
                                 <i class="badge badge-dot badge-dot-xl badge-danger"> </i>
                                 </span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">Account Number: {{ $building->account_number }}</h4>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="main-card mb-3 card">
                     <div class="card-body">
                        <h5 class="card-title">Contact Info</h5>
                        <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">Owned By: {{ $building->first_name }} {{ $building->last_name }}</h4>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <p>Contact Info <span class="text-success">{{ $building->contact_number }}</span></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="main-card mb-3 card">
                     <div class="card-body">
                        <h5 class="card-title">Attached Bills</h5>
                        <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    @if($mbills)
                                    @foreach ($mbills as $m)
                                    <h4 class="timeline-title">{{$m->bill_name}}</h4>
                                    @endforeach
                                    @endif
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-6">
                  <div class="main-card mb-3 card">
                     <div class="card-body">
                        <h5 class="card-title">Upload Building Images</h5>
                        <div class="scroll-area-sm">
                           <div class="scrollbar-container">
                              <div class="vertical-time-icons vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                 <form action="{{url('landlord/upload-photos')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                       <div class="col-md-12">
                                          <div class="row">
                                             <div class="col-md-6">
                                                <div class="control-group" id="fields">
                                                   <div class="controls">
                                                      <div class="entry input-group col-xs-3">
                                                         <input class="btn btn-warning" name="image" type="file">
                                                         <span class="input-group-btn" style="margin-left: 10px">
                                                         </span>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-6">
                                                <button type="submit" class="btn btn-lg btn-info pull-right">Upload Photo</button>
                                             </div>
                                          </div>
                                       </div>
                                       <input type="hidden" name="building_id" value="{{$building->bid}}">
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




         {{-- tenant list --}}

         <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
            <div class="row">
               <div class="col-md-12">
                  <div class="main-card mb-3 card">
                     <div class="card-body">
                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                           <thead>
                              <tr>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th>Id Number</th>
                                 <th>Mobile Number</th>
                                 <th>Citizenship</th>
                                 <th>Email</th>
                                 <th>Created At</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if ($tenants)
                              @foreach ($tenants as $t)
                              <tr>
                                 <td>{{$t->first_name}}</td>
                                 <td>{{$t->last_name}}</td>
                                 <td>{{$t->id_number}}</td>
                                 <td>{{$t->phone_number}}</td>
                                 <td>{{$t->citizenship}}</td>
                                 <td>{{$t->email}}</td>
                                 <td>{{$t->created_at}}</td>
                                 <td class="text-center">
                                    <div role="group" class="btn-group-sm btn-group">
                                       <a href="{{url('landlord/tenant-details', $t->tenant_id)}}"><button class="btn-shadow btn btn-success"><i class="fas fa-eye"></i></button></a>
                                 </td>
                              </tr>
                              @endforeach
                              @endif
                           </tbody>
                        </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>



            {{-- caretaker list --}}

            <div class="tab-pane tabs-animation fade" id="tab-content-90" role="tabpanel">
               <div class="row">
                  <div class="col-md-12">
                     <div class="main-card mb-3 card">
                        <div class="card-body">
                           <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Id Number</th>
                                    <th>Mobile Number</th>
                                    <th>Citizenship</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if ($caretakers)
                                 @foreach ($caretakers as $t)
                                 <tr>
                                    <td>{{$t->first_name}}</td>
                                    <td>{{$t->last_name}}</td>
                                    <td>{{$t->id_number}}</td>
                                    <td>{{$t->phone_number}}</td>
                                    <td>{{$t->citizenship}}</td>
                                    <td>{{$t->email}}</td>
                                    <td>{{$t->created_at}}</td>
                                 </tr>
                                 @endforeach
                                 @endif
                              </tbody>
                           </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>






            <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
               <div class="row">
                  <div class="col-md-12">
                     <div class="main-card mb-3 card">
                        <div class="card-body">
                           <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th>#ID</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if($photos)
                                 @foreach($photos as $d)
                                 <tr>
                                    <td>{{$d->id}}</td>
                                    <td>
                                       <div class="widget-content p-0">
                                          <div class="widget-content-wrapper">
                                             <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                   <img width="200" class="square" src="/Documents/Photos/{{$d->image_url}}" alt="">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </td>
                                    <td>Building Photo</td>
                                 </tr>
                                 @endforeach
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-8" role="tabpanel">
               <div class="row">
                  <div class="col-md-12">
                     <div class="main-card mb-3 card">
                        <div class="card-body">
                           <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th>Unit Name</th>
                                    <th>No. of Units</th>
                                    <th>Unit Price</th>
                                    <th>Unit Deposit</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if ($houseunits)
                                 @foreach ($houseunits as $h)
                                 <tr>
                                    <td>{{$h->unit_type_name}}</td>
                                    <td>{{$h->number_of_units}}</td>
                                    <td>{{$h->unit_price}}</td>
                                    <td>{{$h->unit_deposit}}</td>
                                 </tr>
                                 @endforeach
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-4" role="tabpanel">
               <div class="row">
                  <div class="col-md-12">
                     <div class="main-card mb-3 card">
                        <div class="card-body">
                           <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                              <thead>
                                 <tr>
                                    <th>#ID</th>
                                    <th>Unit Name</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @if($labels)
                                 @foreach($labels as $d)
                                 <tr>
                                    <td>{{$d->id}}</td>
                                    <td>{{$d->label}}</td>
                                 </tr>
                                 @endforeach
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
               <div class="row">
                  <div class="col-md-12">
                     <div class="main-card mb-3 card">
                        <div class="card-body">
                           <h5 class="card-title">Documents</h5>
                           <div class="scroll-area-sm">
                              <div class="scrollbar-container">
                                 <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                    @if($documents)
                                    @foreach($documents as $d)
                                    <div class="vertical-timeline-item vertical-timeline-element">
                                       <div>
                                          <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>
                                          <div class="vertical-timeline-element-content bounce-in">
                                             <p>{{$d->document_name}}</p>
                                             <p><a href="/Documents/Building/{{$d->building_document}}" download="{{$d->building_document}}">{{$d->document_name}}</a></span></p>
                                          </div>
                                       </div>
                                    </div>
                                    @endforeach
                                    @endif
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
</div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Tenant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{url('landlord/add-tenant')}}" method="POST" style="padding: 40px">
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
                  <input type="hidden" name="building_id" value="{{$building->bid}}">
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
                     <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Select Unit</label>
                        <select name="unit_id" id="units" class="form-control">
                           <option value="">Select Unit</option>
                           @if ($units)
                           @foreach ($units as $b)
                           <option value="{{$b->unitid}}">{{$b->unit_type_name}}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="col col-6">
                     <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Select Unit Number</label>
                        <select name="unit_number" id="labels" class="form-control">
                           <option value="">Select Unit Number</option>
                           @if ($labels)
                           @foreach ($labels as $b)
                           <option value="{{$b->id}}">{{$b->label}}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                  </div>
                  <div class="col col-12">
                     <input name="user_type" type="hidden" value="tenant">
                     <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Citizenship</label>
                        <select name="citizenship" id="exampleSelect" class="form-control">
                           <option value="kenyan">kenyan</option>
                           <option value="foreigner">Non-Citizen</option>
                        </select>
                     </div>
                  </div>
                  <div class="col col-6">
                     <div class="position-relative form-group">
                        <label for="" class="">Rent Amount (Optional)</label>
                        <input name="tenant_rent_amount" placeholder="e.g 20000" type="number" class="form-control" value="{{ old('tenant_rent_amount') }}">
                     </div>
                  </div>
                  <div class="col col-6">
                     <div class="position-relative form-group">
                        <label for="" class="">Deposit Amount (Optional)</label>
                        <input name="tenant_deposit_amount" placeholder="e.g 20000" type="number" class="form-control" value="{{ old('tenant_deposit_amount') }}">
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





@endsection
@section('javascript')
<script>
   $(document).ready(function () {
       var frequency =  $('#frequency');
       var variable_amount =  $('#variable_amount');
       var fixed_amount =  $('#fixed_amount');
   
       $('#abill').click(function(){
         $('#frequency').detach();
         $('#variable_amount').detach();
         $('#fixed_amount').detach();
       });
   
     $('#billtype').change(function(e){
       var c = $('#billtype').find(":selected").text();
       if (c == 'Fixed') {
         $('#freq').append(frequency);
         $('#variable_amount').detach();
         $('#fixed').append(fixed_amount);
       } else if(c == 'Variable') {
         $('#frequency').detach();
         $('#variable').append(variable_amount);
         $('#fixed_amount').detach();
       }
       });
   });
   
</script>
<script>
   $(function()
   {
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();
   
        var controlForm = $('.controls:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
   
        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="fa fa-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
      $(this).parents('.entry:first').remove();
   
   e.preventDefault();
   return false;
   });

   $('#datetimepicker2').datepicker({
          minDate: 0,
          minTime: 0, 
          weekStart: 0,
          todayBtn: "linked",
          language: "en",
          orientation: "bottom auto",
          keyboardNavigation: false,
          autoclose: true

      });



   });
</script>
@endsection