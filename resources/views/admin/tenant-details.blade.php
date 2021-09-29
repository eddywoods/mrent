@extends('layouts.admin')
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
                   {{$tenant->first_name}}  {{$tenant->last_name}}'s   Details
                   
                </div>
             </div>
             <div class="page-title-actions">
               
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">
                       Add {{$tenant->first_name}}  {{$tenant->last_name}} 's Bill
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

                            <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                <div>
                                   <span class="vertical-timeline-element-icon bounce-in"></span>
                                   <div class="vertical-timeline-element-content bounce-in">
                                      <p>Onboard Since: {{ $tenant->created_at }}</p>
                                   </div>
                                </div>
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
                                      <p>Contact Info <span class="text-success">{{ $tenant->contact_number }}</span></p>
                                   </div>
                                </div>
                             </div>
                           
                          </div>
                       </div>
                    </div>
                    <div class="main-card mb-3 card">
                       <div class="card-body">
                          <h5 class="card-title">Bills</h5>
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
             <div class="col col-6">
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

            <div class="col col-6">
                <div class="position-relative form-group">
                  <label for="exampleEmail" class="">Current Reading</label>
                  <input name="number_of_units"  placeholder="Number of Units" type="text" class="form-control">
                </div>
              </div>

            <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">

          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Attach Bill</button>
          </div>
        </form>
       </div>
    </div>
 </div>





@endsection