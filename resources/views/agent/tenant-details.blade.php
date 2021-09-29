@extends('layouts.agent')
@section('content')
@if($tenant)
<div class="app-main__outer">
   <div class="app-main__inner">
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
      <div class="app-page-title">
         <div class="page-title-wrapper">
            <div class="page-title-heading">
               <div class="page-title-icon">
                  <i class="pe-7s-light icon-gradient bg-malibu-beach">
                  </i>
               </div>
               <div>
                  {{$tenant->first_name}}  {{$tenant->last_name}}
               </div>
            </div>
            <div class="page-title-actions">
               <div class="d-inline-block dropdown">
                  <button type="button" class="btn mr-3 mb-2 btn-dark" data-toggle="modal" data-target="#exampleModal">
                  Generate Bill
                  </button>
               </div>
               <div class="d-inline-block dropdown">
                  <button type="button" class="btn mr-3 mb-2 btn-dark" data-toggle="modal" data-target="#paymentModal">
                  Make Payment
                  </button>
               </div>
               <div class="d-inline-block dropdown">
                  <button type="button" class="btn mr-3 mb-2 btn-dark text-white" data-toggle="modal" data-target="#attachunitModal">
                  Attach A Unit
                  </button>
               </div>
               <div class="d-inline-block dropdown">
                  <button type="button" class="btn mr-3 mb-2 btn-dark" data-toggle="modal" data-target="#documentModal">
                  Upload Document
                  </button>
               </div>
            </div>
         </div>
      </div>
      <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
         <li class="nav-item">
            <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
            <span>Personal Information</span>
            </a>
         </li>
         <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
            <span>Payment History</span>
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
                                    <h4 class="timeline-title">Name: {{ $tenant->first_name }} {{ $tenant->middle_name }} {{ $tenant->last_name }}</h4>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <p>Email: {{ $tenant->email }}</p>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item dot-success vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">
                                       ID Number: {{ $tenant->id_number }}
                                    </h4>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <p>Phone: {{ $tenant->phone_number }}</p>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item dot-success vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">
                                       Citizenship: {{ $tenant->citizenship }}
                                    </h4>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-element-content bounce-in my-3">
                                 <h5 class="card-title">Tenant House Units</h5>
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>Building</th>
                                       <th>Room Type</th>
                                       <th>Room Number</th>
                                       <th>Price (kes)</th>
                                       <th>Occupancy Date</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @if($rentunits)
                                    @foreach ($rentunits as $r)
                                    <tr>
                                       <td>{{$r->building_name}}</td>
                                       <td>{{$r->unit_type_name}}</td>
                                       <td>{{$r->label}}</td>
                                       <td>{{$r->unit_price}}</td>
                                       <td>{{$r->entry_date}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="main-card mb-3 card">
                     <div class="card-body">
                        <h5 class="card-title">Building Information</h5>
                        <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in">
                                 <i class="badge badge-dot badge-dot-xl badge-success"></i>
                                 </span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">Building Name: {{ $tenant->building_name }}</h4>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in">
                                 <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                 </span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <p> Building Location  <b class="text-danger">{{ $tenant->location }}</b></p>
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
                        <h5 class="card-title">Bills</h5>
                        <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <small>Fixed Bills</small>
                                    <table class="table">
                                       <thead>
                                          <tr>
                                             <th>Bill Name</th>
                                             <th>Amount</th>
                                             <th>Payment Frequency</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @if($mbills)
                                          @foreach ($mbills as $m)
                                          <tr>
                                             <td>{{$m->bill_name}}</td>
                                             <td>{{$m->fixed_bill_amount}}</td>
                                             <td>{{$m->bill_frequency}}</td>
                                          </tr>
                                          @endforeach
                                          @endif
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                              <div>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <small>Variable Bills</small>
                                    <table class="table">
                                       <thead>
                                          <tr>
                                             <th>Bill Name</th>
                                             <th>Amount Per Unit</th>
                                             <th>Units</th>
                                             <th>Payment Status</th>
                                             <th>Read On</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @if($vbills)
                                          @foreach ($vbills as $v)
                                          <tr>
                                             <td>{{$v->bill_name}}</td>
                                             <td>{{$v->variable_bill_amount}}</td>
                                             <td>{{$v->number_of_units}}</td>
                                             <td>{{$v->payment_status}}</td>
                                             <td>{{$v->created_at}}</td>
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
                  </div>
                  <div class="main-card mb-3 card">
                     <div class="card-body">
                        <h5 class="card-title">Contact Info</h5>
                        <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <p>Contact Info <span class="text-success">{{ $tenant->contact_number }}</span></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="main-card mb-3 card">
                     <div class="card-body">
                        <h5 class="card-title">Tenant Documents</h5>
                        <small>(Click to download)</small>
                        <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                           <div class="vertical-timeline-item vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    @if($documents)
                                    @foreach($documents as $d)
                                    <div class="vertical-timeline-item vertical-timeline-element">
                                       <div>
                                          <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>
                                          <div class="vertical-timeline-element-content bounce-in">
                                             <p>{{$d->document_name}}</p>
                                             <p><a href="/Documents/Tenant/{{$d->tenant_document}}" download="{{$d->tenant_document}}">{{$d->document_name}}</a></span></p>
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
         <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
            <div class="row">
               <div class="col-md-12">
                  <div class="mb-3 card">
                     <div class="card-body">
                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                           <thead>
                              <tr>
                                 <th>Payment Reason</th>
                                 <th>Payment Method</th>
                                 <th>Amount</th>
                                 <th>Note</th>
                                 <th>Created At</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if($payments)
                              @foreach ($payments as $p)
                              <tr>
                                 <td>{{ $p->payment_reason }}</td>
                                 <td>{{ $p->payment_method }}</td>
                                 <td>{{ $p->amount }}</td>
                                 <td>{{ $p->payment_description }}</td>
                                 <td>{{ $p->created_at }}</td>
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
      </div>
   </div>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Attach Bill</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{url('landlord/attach-tenant-bill')}}" method="POST">
            <div class="modal-body">
               @csrf
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="">Select bill</label>
                     <select name="bill_id" class="form-control">
                        <option value="">Select Bill..</option>
                        @if($bills)
                        @foreach ($bills as $b)
                        <option value="{{$b->id}}">{{ $b->bill_name }}</option>
                        @endforeach
                        @endif
                     </select>
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleEmail" class="">Number of units</label>
                     <input name="number_of_units"  placeholder="Number of Units" type="text" class="form-control">
                  </div>
               </div>
               <div class="col col-12">
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
                     <label for="exampleSelect" class="">Select Unit</label>
                     <select name="unit_id" id="units" class="form-control">
                     </select>
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleSelect" class="">Select Unit Number</label>
                     <select name="unit_number" id="labels" class="form-control">
                     </select>
                  </div>
               </div>
               <input type="hidden" name="tenant_id" value="{{ $tenant->tenant_id }}">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Attach Bill</button>
            </div>
         </form>
      </div>
   </div>
</div>




<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="paymentModalLabel">Make Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{url('receive-payment')}}" method="POST">
            @csrf
            <div class="modal-body">
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="">Payment For</label>
                     <select name="payment_reason" class="form-control">
                        <option value="">Select Reason..</option>
                        <option value="rent">Rent</option>
                        <option value="deposit">Deposit</option>
                        <option value="bills">Bills</option>
                     </select>
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleSelect" class="">Select House Unit</label>
                     <select name="account" id="account" class="form-control" required>
                        <option value="">Select House Unit</option>
                        @if ($rentunits) @foreach ($rentunits as $u)
                        <option value="{{$u->account_number}}">{{$u->building_name}} - {{$u->label}}</option>
                        @endforeach @endif
                     </select>
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="">Payment Method</label>
                     <select name="payment_method" class="form-control">
                        <option value="">Select Method..</option>
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                        <option value="bank">Bank Slip</option>
                     </select>
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleEmail" class="">Amount</label>
                     <input name="amount"  placeholder="Amount" type="number" class="form-control">
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleEmail" class="">Reference Number (optional)</label>
                     <input name="transaction_number"  placeholder="Ref No" type="text" class="form-control">
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleEmail" class="">Payment Notes</label>
                     <textarea name="payment_description" id="paymentText" class="form-control"></textarea>
                  </div>
               </div>
               <input type="hidden" name="tenant_id" value="{{ $tenant->tenant_id }}">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Complete Payment</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="attachunitModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="paymentModalLabel">Attach Tenant To Unit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{url('landlord/attach-tenant-unit')}}" method="POST" style="padding: 40px">
            @csrf
            <div class="modal-body">
               <div class="row">
                  <div class="col col-12">
                     <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Select Building</label>
                        <select name="building_id" id="building2" class="form-control">
                           <option value="">Select Building</option>
                           @if ($buildings)
                           @foreach ($buildings as $b)
                           <option value="{{$b->id}}">{{$b->building_name}}</option>
                           @endforeach
                           @endif
                        </select>
                     </div>
                  </div>
                  <input type="hidden" name="tenant_id" value="{{ $tenant->tenant_id }}">
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
                        <select name="unit_id" id="units1" class="form-control">
                        </select>
                     </div>
                  </div>
                  <div class="col col-6">
                     <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Select Unit Number</label>
                        <select name="unit_number" id="labels1" class="form-control">
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
               <button type="submit" class="btn btn-primary">Attach Unit</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="documentModalLabel">Upload Tenant Documents</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{url('landlord/upload-tenant-document')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               @csrf
               <div class="col col-12">
                  <label for="exampleFile" class="col-sm-12 col-form-label">Document Name</label>
                  <div class="col-sm-12">
                     <input name="document_name"  type="text" class="form-control">
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleFile" class="col-sm-12 col-form-label">Upload Tenant Documents</label>
                     <div class="col-sm-12">
                        <input name="tenant_document" id="tenantFile" type="file" class="form-control-file">
                     </div>
                  </div>
               </div>
               <input type="hidden" name="tenant_id" value="{{ $tenant->tenant_id }}">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Upload Document</button>
            </div>
         </form>
      </div>
   </div>
</div>
@else 
<div>Wrong Tenant Selected</div>
@endif
@endsection
@section('javascript')
<script>
   $(document).ready(function () {
     $('#building').change(function() {
   
         $.ajax({
             type:"GET",
             url : "/landlord/getunits/"+$(this).val(),
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
</script>
<script>
   $(document).ready(function () {
     $('#building2').change(function() {
   
         $.ajax({
             type:"GET",
             url : "/landlord/getunits/"+$(this).val(),
             success : function(response) {
                 data = response;
                
                 var select = $('#units1');
                   select.empty();
                   $.each(data, function(index, value) {      
                       select.append(
                           $('<option></option>').val(value.unitid).html(value.unit_type_name)
                       );
             });
   
             var select = $('#labels1');
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