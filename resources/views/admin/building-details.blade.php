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
                   {{$building->building_name}}  Building Details
                   
                </div>
             </div>
             <div class="page-title-actions">
                <a href="{{url('agent/list-bills')}}"><button type="button" class="btn mr-2 mb-2 btn-primary">
                   Add Fixed Bill
                 </button>
                </a>
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">
                       Attach Bills
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
             </div>
          </div>
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
                                        <button class="btn-shadow btn btn-success"><i class="fas fa-eye"></i></button>
                                        
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
          <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
             <div class="row">
                <div class="col-md-6">
                   <div class="main-card mb-3 card">
                      <div class="card-body">
                         <h5 class="card-title">Documents</h5>
                         <div class="scroll-area-sm">
                            <div class="scrollbar-container">
                               <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title">All Hands Meeting</h4>
                                           <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a></p>
                                           <span class="vertical-timeline-element-date">10:30 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                                           <p>Yet another one, at <span class="text-success">15:00 PM</span></p>
                                           <span class="vertical-timeline-element-date">12:25 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-danger"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title">Build the production release</h4>
                                           <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p>
                                           <span
                                              class="vertical-timeline-element-date">15:00 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-primary"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title text-success">Something not important</h4>
                                           <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                           <span class="vertical-timeline-element-date">15:00 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title">All Hands Meeting</h4>
                                           <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a></p>
                                           <span class="vertical-timeline-element-date">10:30 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                                           <p>Yet another one, at <span class="text-success">15:00 PM</span></p>
                                           <span class="vertical-timeline-element-date">12:25 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-danger"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title">Build the production release</h4>
                                           <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p>
                                           <span
                                              class="vertical-timeline-element-date">15:00 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-primary"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title text-success">Something not important</h4>
                                           <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                           <span class="vertical-timeline-element-date">15:00 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-success"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title">All Hands Meeting</h4>
                                           <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a></p>
                                           <span class="vertical-timeline-element-date">10:30 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                                           <p>Yet another one, at <span class="text-success">15:00 PM</span></p>
                                           <span class="vertical-timeline-element-date">12:25 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-danger"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title">Build the production release</h4>
                                           <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p>
                                           <span
                                              class="vertical-timeline-element-date">15:00 PM</span>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-primary"> </i></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title text-success">Something not important</h4>
                                           <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                           <span class="vertical-timeline-element-date">15:00 PM</span>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>


                </div>
                <div class="col">
                   <div class="main-card mb-3 card">
                      <div class="card-body">
                         <h5 class="card-title">Notices</h5>
                         <div class="scroll-area-lg">
                            <div class="scrollbar-container">
                               <div class="vertical-time-icons vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in">
                                           <div class="timeline-icon border-primary"><i class="lnr-license icon-gradient bg-night-fade"></i></div>
                                        </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title">All Hands Meeting</h4>
                                           <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a></p>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in">
                                           <div class="timeline-icon border-warning"><i class="lnr-cog fa-spin icon-gradient bg-happy-itmeo"></i></div>
                                        </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                                           <p>Yet another one, at <span class="text-success">15:00 PM</span></p>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in">
                                           <div class="timeline-icon border-success"><i class="lnr-cloud-upload icon-gradient bg-plum-plate"></i></div>
                                        </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title">Build the production release</h4>
                                           <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in">
                                           <div class="timeline-icon border-primary"><i class="lnr-license text-primary"></i></div>
                                        </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title">All Hands Meeting</h4>
                                           <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a></p>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in">
                                           <div class="timeline-icon border-success bg-success">
                                              <svg aria-hidden="true" data-prefix="fas" data-icon="coffee"
                                                 class="fa fa-coffee text-white"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                 <path
                                                    fill="currentColor"
                                                    d="M192 384h192c53 0 96-43 96-96h32c70.6 0 128-57.4 128-128S582.6 32 512 32H120c-13.3 0-24 10.7-24 24v232c0 53 43 96 96 96zM512 96c35.3 0 64 28.7 64 64s-28.7 64-64 64h-32V96h32zm47.7 384H48.3c-47.6 0-61-64-36-64h583.3c25 0 11.8 64-35.9 64z"></path>
                                              </svg>
                                           </div>
                                        </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title text-success">FontAwesome Icons</h4>
                                           <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in">
                                           <div class="timeline-icon border-warning bg-warning">
                                              <svg aria-hidden="true" data-prefix="fas" data-icon="archive"
                                                 class="fa fa-archive fa-w-16 text-white"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                 <path
                                                    fill="currentColor"
                                                    d="M32 448c0 17.7 14.3 32 32 32h384c17.7 0 32-14.3 32-32V160H32v288zm160-212c0-6.6 5.4-12 12-12h104c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-8zM480 32H32C14.3 32 0 46.3 0 64v48c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16V64c0-17.7-14.3-32-32-32z"></path>
                                              </svg>
                                           </div>
                                        </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <h4 class="timeline-title">Build the production release</h4>
                                           <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p>
                                        </div>
                                     </div>
                                  </div>
                                  <div class="vertical-timeline-item vertical-timeline-element">
                                     <div>
                                        <span class="vertical-timeline-element-icon bounce-in">
                                           <div class="timeline-icon bg-danger border-danger"><i class="pe-7s-cloud-upload text-white"></i></div>
                                        </span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                           <p>Another meeting today, at <b class="text-warning">12:00 PM</b></p>
                                           <p>Yet another one, at <span class="text-dark">15:00 PM</span></p>
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
          <form action="{{url('agent/attach-bill')}}" method="POST">
          <div class="modal-body">
         
             @csrf
             <div class="col col-6">
                <div class="position-relative form-group">
                   <label for="exampleEmail5">Select bill</label>
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
                   <label for="exampleEmail5">Bill Frequency</label>
                   <select name="bill_frequency" class="form-control">
                      <option value="">Select Bill Frequency..</option>
                      <option value="daily">Daily</option>
                      <option value="weekly">Weekly</option>
                      <option value="monthly">Monthly</option>
                      <option value="quarterly">Quarterly</option>
                   </select>
                </div>
            </div>

            <div class="col col-6">
                <div class="position-relative form-group">
                  <label for="exampleEmail" class="">Bill Amount</label>
                  <input name="bill_amount"  placeholder="Bill Amount" type="text" class="form-control">
                </div>
              </div>
              
            <input type="hidden" name="building_id" value="{{$building->bid}}">

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