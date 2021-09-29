@extends('layouts.caretaker')
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



@endsection
