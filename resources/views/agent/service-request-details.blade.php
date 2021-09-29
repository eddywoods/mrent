@extends('layouts.agent')
@section('content')
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
                  {{$service_request->request_title}} Details
               </div>
            </div>
            <div class="page-title-actions">
               <div class="d-inline-block dropdown">
                  <button type="button" class="btn mr-3 mb-2 btn-info" data-toggle="modal" data-target="#exampleModal">
                  Assign Request
                  </button>
               </div>
               <div class="d-inline-block dropdown">
                  <button type="button" class="btn mr-3 mb-2 btn-success" data-toggle="modal" data-target="#paymentModal">
                 Complete Request
                  </button>
               </div>
             
            </div>
         </div>
      </div>
      <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
         <li class="nav-item">
            <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
            <span> Details</span>
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
                                    <h4 class="timeline-title">Title: {{ $service_request->request_title }} </h4>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <p>Building Name: {{ $service_request->building_name }}</p>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item dot-success vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">
                                       Unit Type: {{ $service_request->unit_type_name }}
                                    </h4>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <p>Unit Number: {{ $service_request->label }}</p>
                                 </div>
                              </div>
                           </div>
                           <div class="vertical-timeline-item dot-success vertical-timeline-element">
                              <div>
                                 <span class="vertical-timeline-element-icon bounce-in"></span>
                                 <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">
                                       Request Status: {{ $service_request->request_status }}
                                    </h4>
                                 </div>
                              </div>
                           </div>
                           @if ($service_request->request_status != 'unassigned')
                           <div class="vertical-timeline-element-content bounce-in my-3">
                              <h5 class="card-title">Service Assignment Details </h5>
                              <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                  <div>
                                     <span class="vertical-timeline-element-icon bounce-in"></span>
                                     <div class="vertical-timeline-element-content bounce-in">
                                        <p>Assigned To: {{ $service_request->vendor_first_name }} {{ $service_request->vendor_last_name }}</p>
                                        @if ($service_request->request_status == 'completed')
                                        <p>Service Cost: ksh. {{ $service_request->service_cost }}</p>
                                        @endif
                                        
                                     </div>
                                  </div>
                               </div>
                        </div>
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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assign Request</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{url('agent/assign-service-request')}}" method="POST">
            <div class="modal-body">
               @csrf
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="">Select vendor</label>
                     <select name="assigned_to" class="form-control">
                        <option value="">Select Vendor..</option>
                        @if($vendors)
                        @foreach ($vendors as $v)
                        <option value="{{$v->id}}">{{ $v->first_name }} {{ $v->last_name }}</option>
                        @endforeach
                        @endif
                     </select>
                  </div>
               </div>
            
               <input type="hidden" name="serviceid" value="{{ $service_request->serviceid }}">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Assign Vendor</button>
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
            <h5 class="modal-title" id="paymentModalLabel">Complete Request</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{url('agent/complete-service-request')}}" method="POST">
            @csrf
            <div class="modal-body">
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleEmail" class="">Service Cost</label>
                     <input name="service_cost"  placeholder="service_cost" type="number" class="form-control">
                  </div>
               </div>
              
               <input type="hidden" name="serviceid" value="{{ $service_request->serviceid }}">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Complete Request</button>
            </div>
         </form>
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