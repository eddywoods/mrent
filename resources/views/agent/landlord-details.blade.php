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
                   {{$landlord->first_name}}  {{$landlord->last_name}}'s   Details
                   
                </div>
             </div>
             <div class="page-title-actions">
                 
{{--               
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-3 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">
                       Create Bill
                    </button>
                 
                </div>

                <div class="d-inline-block dropdown">
                     <button type="button" class="btn mr-3 mb-2 btn-primary" data-toggle="modal" data-target="#paymentModal">
                       Make Payment
                     </button>
                  
                 </div> --}}

             </div>
          </div>
       </div>
       <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
          <li class="nav-item">
             <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
             <span>Personal Information</span>
             </a>
          </li>
          {{-- <li class="nav-item">
               <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                     <span>Payment History</span>
                 </a>
            </li> --}}
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
                                  <h4 class="timeline-title">Name: {{ $landlord->first_name }} {{ $landlord->middle_name }} {{ $landlord->last_name }}</h4>
                                  </div>
                               </div>
                            </div>
                            <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                               <div>
                                  <span class="vertical-timeline-element-icon bounce-in"></span>
                                  <div class="vertical-timeline-element-content bounce-in">
                                     <p>Email: {{ $landlord->email }}</p>
                                  </div>
                               </div>
                            </div>
                            <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                <div>
                                   <span class="vertical-timeline-element-icon bounce-in"></span>
                                   <div class="vertical-timeline-element-content bounce-in">
                                      <h4 class="timeline-title">
                                        ID Number: {{ $landlord->id_number }}
                                      </h4>
                                   </div>
                                </div>
                             </div>
                            <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                <div>
                                   <span class="vertical-timeline-element-icon bounce-in"></span>
                                   <div class="vertical-timeline-element-content bounce-in">
                                      <p>Phone: {{ $landlord->phone_number }}</p>
                                   </div>
                                </div>
                             </div>
                            <div class="vertical-timeline-item dot-success vertical-timeline-element">
                               <div>
                                  <span class="vertical-timeline-element-icon bounce-in"></span>
                                  <div class="vertical-timeline-element-content bounce-in">
                                     <h4 class="timeline-title">
                                        Citizenship: {{ $landlord->citizenship }}
                                     </h4>
                                  </div>
                               </div>
                            </div>

                            <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                <div>
                                   <span class="vertical-timeline-element-icon bounce-in"></span>
                                   <div class="vertical-timeline-element-content bounce-in">
                                      <p>Onboard Since: {{ $landlord->created_at }}</p>
                                   </div>
                                </div>
                             </div>
                          
                         </div>
                      </div>
                   </div>
                   {{-- <div class="main-card mb-3 card">
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
                            <div class="vertical-timeline-item vertical-timeline-element">
                               <div>
                                  <span class="vertical-timeline-element-icon bounce-in">
                                  <i class="badge badge-dot badge-dot-xl badge-danger"> </i>
                                  </span>
                                  <div class="vertical-timeline-element-content bounce-in">
                                     <h4 class="timeline-title">Unit Type: {{ $tenant->unit_type_name }}</h4>
                                  </div>
                               </div>
                            </div>

                            <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                   <span class="vertical-timeline-element-icon bounce-in">
                                   <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                   </span>
                                   <div class="vertical-timeline-element-content bounce-in">
                                      <p> Unit Number  <b class="text-danger">{{ $tenant->unit_number }}</b></p>
                                   </div>
                                </div>
                             </div>
                           
                         </div>
                      </div>
                   </div> --}}
                </div>
{{-- 
                <div class="col-md-6">
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
                          <h5 class="card-title">Bills</h5> <small>(Total Bills Amount Due: Kes 3000)</small>
                          <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                             <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                  
                                   <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                  
                                   <div class="vertical-timeline-element-content bounce-in">
                                      <small>Fixed Bills</small>
                                       @if($mbills)
                                       @foreach ($mbills as $m)
                                       <h4 class="timeline-title">{{$m->bill_name}}</h4>
                                       @endforeach
                                       @endif
                                   </div>

                                  
                                   <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                  
                                   <div class="vertical-timeline-element-content bounce-in">
                                      <small>Variable Bills</small>
                                       @if($vbills)
                                       @foreach ($vbills as $v)
                                       <h4 class="timeline-title">{{$v->bill_name}}</h4>
                                       @endforeach
                                       @endif
                                   </div>


                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div> --}}



             </div>
          </div>
{{-- 
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
                                       <td>{{ $p->paid_amount }}</td>
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

           </div> --}}



       </div>
    </div>
</div>
</div>
</div>


{{-- 
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
                  <label for="exampleEmail" class="">Current Reading</label>
                  <input name="number_of_units"  placeholder="Number of Units" type="text" class="form-control">
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
 --}}



{{-- 

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
                     <small>(Current Amount Past-Due: <span class="text-danger">Kes 400000 </span>)</small>
                  
                  <div class="col col-12">
                     <div class="position-relative form-group">
                        <label for="">Payment For</label>
                        <select name="payment_reason" class="form-control">
                           <option value="">Select Reason..</option>
                           <option value="rent">Rent</option>
                           <option value="utility">Utility Bill</option>
                           <option value="deposit">Deposit</option>
                           <option value="other">Other Fees</option>
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
                       <input name="paid_amount"  placeholder="Amount" type="text" class="form-control">
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
      </div> --}}





@endsection