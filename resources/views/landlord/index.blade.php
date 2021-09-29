@extends('layouts.landlord')
@section('content')
<div class="app-main__outer">
<div class="app-main__inner">
   <div class="app-page-title app-page-title-simple">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div>
               <div class="page-title-head center-elem">
                  <span class="d-inline-block pr-2">
                  <i class="lnr-apartment opacity-6"></i>
                  </span>
                  <span class="d-inline-block">M-rent Dashboard</span>
               </div>
               <div class="page-title-subheading opacity-10">
                  <nav class="" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a>
                           <i aria-hidden="true" class="fa fa-home"></i>
                           </a>
                        </li>
                        <li class="breadcrumb-item">
                           <a>Dashboard</a>
                        </li>
                        <li class="active breadcrumb-item" aria-current="page">
                           Home
                        </li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
         <div class="page-title-actions">
            <div class="d-inline-block pr-3">
              
               <a href="{{ url('landlord/list-buildings') }}">
               <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-dark btn-sm"><i class="fa fa-plus"></i>
               <span class="mr-1"> Add a Building</span>
               </button>
               </a>
               <a href="{{ url('landlord/services') }}">
                  <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-dark btn-sm">
                  <span class="mr-1"> Vendor Services</span>
                  </button>
                  </a>
               <a href="{{ url('landlord/payments') }}">
               <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-dark btn-sm">
               <span class="mr-1"> Payment Reports</span>
               </button>
               </a>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-lg-3">
         <a href="{{ url('landlord/list-buildings') }}">
            <div class="widget-chart widget-chart2 text-left mb-3 card">
               <div class="widget-chat-wrapper-outer">
                  <div class="widget-chart-content">
                     <div class="widget-title opacity-5 text-uppercase">Buildings</div>
                     <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                           <div>
                              
                              @if ($buildings_count)
                              {{$buildings_count}}
                              @else
                              <span>0</span>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            </a>
         </div>
      <div class="col-md-6 col-lg-3">
         <a href="{{ url('landlord/list-tenants') }}">
         <div class="widget-chart widget-chart2 text-left mb-3  card">
            <div class="widget-chat-wrapper-outer">
               <div class="widget-chart-content">
                  <div class="widget-title opacity-5 text-uppercase">Tenants</div>
                  <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                     <div class="widget-chart-flex align-items-center">
                        <div>
                          
                           @if ($tenants)
                           {{$tenants_count}}
                           @else
                           <span>0</span>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </a>
      </div>
      <div class="col-md-6 col-lg-3">
            <div class="widget-chart widget-chart2 text-left mb-3 card">
               <div class="widget-chat-wrapper-outer">
                  <div class="widget-chart-content">
                     <div class="widget-title opacity-5 text-uppercase">Total Expenses</div>
                     <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                           <div>
   
                                 <small class="opacity-5 pr-1">KES</small>
                                 @if($monthly_expense)
                                 @if ($monthly_expense <= 0)
                                 <span>0.00</span>
                                 @elseif($monthly_expense >= 1000000)
                                 {{ number_format($monthly_expense/1000000, 2, '.', ',') }} M
                                 @elseif($monthly_expense < 1000000)
                                 {{ number_format($monthly_expense, 2, '.', ',') }}
                                 @endif
                                 @else
                                 <span>0.00</span>
                                 @endif
   
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <div class="col-md-6 col-lg-3">
         <div class="widget-chart widget-chart2 text-left mb-3 card">
            <div class="widget-chat-wrapper-outer">
               <div class="widget-chart-content">
                  <div class="widget-title opacity-5 text-uppercase">Total Expected On Rent</div>
                  <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                     <div class="widget-chart-flex align-items-center">
                        <div>

                          

                              <small class="opacity-5 pr-1">KES</small>
                              @if($expected_monthly_amount)
                              @if ($expected_monthly_amount <= 0)
                              <span>0.00</span>
                              @elseif($expected_monthly_amount >= 1000000)
                              {{ number_format($expected_monthly_amount/1000000, 2, '.', ',') }} M
                              @elseif($expected_monthly_amount < 1000000)
                              {{ number_format($expected_monthly_amount, 2, '.', ',') }}
                              @endif
                              @else
                              <span>0.00</span>
                              @endif


                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-lg-3">
         <div class="widget-chart widget-chart2 text-left mb-3 card">
            <div class="widget-chat-wrapper-outer">
               <div class="widget-chart-content">
                  <div class="widget-title opacity-5 text-uppercase">Total Units</div>
                  <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                     <div class="widget-chart-flex align-items-center">
                        <div>

                              @if ($total_units)
                              {{$total_units}}
                              @else
                              <span>0</span>
                              @endif

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-lg-3">
         <div class="widget-chart widget-chart2 text-left mb-3 card">
            <div class="widget-chat-wrapper-outer">
               <div class="widget-chart-content">
                  <div class="widget-title opacity-5 text-uppercase">Occupied Units</div>
                  <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                     <div class="widget-chart-flex align-items-center">
                        <div>

                         @if ($occupied_units)
                           {{$occupied_units}}
                           @else
                           <span>0</span>
                           @endif

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-lg-3">
            <div class="widget-chart widget-chart2 text-left mb-3 card">
               <div class="widget-chat-wrapper-outer">
                  <div class="widget-chart-content">
                     <div class="widget-title opacity-5 text-uppercase">Vacant Units</div>
                     <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                        <div class="widget-chart-flex align-items-center">
                           <div>
                              @if ($vacant_count)
                              {{$vacant_count}}
                              @else
                              <span>0</span>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
     
      <div class="col-md-6 col-lg-3">
         <div class="widget-chart widget-chart2 text-left mb-3 card">
            <div class="widget-chat-wrapper-outer">
               <div class="widget-chart-content">
                  <div class="widget-title opacity-5 text-uppercase">Total EXPECTED ON BILLS</div>
                  <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                     <div class="widget-chart-flex align-items-center">
                           <div>

                          

                                 <small class="opacity-5 pr-1">KES</small>
                                 @if($expected_bill_amount)
                                 @if ($expected_bill_amount <= 0)
                                 <span>0.00</span>
                                 @elseif($expected_bill_amount >= 1000000)
                                 {{ number_format($expected_bill_amount/1000000, 2, '.', ',') }} M
                                 @elseif($expected_bill_amount < 1000000)
                                 {{ number_format($expected_bill_amount, 2, '.', ',') }}
                                 @endif
                                 @else
                                 <span>0.00</span>
                                 @endif
   
   
                           </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
         <div class="col-sm-12 col-md-9 col-lg-9">
           
               <div class="main-card mb-3 card">
                     <div class="card-header">
                           <div class="card-header-title font-size-lg text-capitalize font-weight-normal">INCOME STATS</div>
                        </div>
                     <div class="grid-menu grid-menu-2col">
                         <div class="no-gutters row">
                             <div class="col-sm-6">
                                 <div class="widget-chart">
                                     <div class="icon-wrapper rounded-circle">
                                         <div class="icon-wrapper-bg bg-primary"></div>
                                         </div>
                                         <small class="opacity-5 pr-1">KES</small>
                                         @if($total_collected)
                                         @if ($total_collected <= 0)
                                         <div class="widget-numbers">0.00</div>
                                         @elseif($total_collected >= 1000000)
                                         <div class="widget-numbers"><small class="opacity-5 pr-1">KES</small>{{ number_format($total_collected/1000000, 2, '.', ',') }} M </div>
                                         @elseif($total_collected < 1000000)
                                         <div class="widget-numbers"><small class="opacity-5 pr-1">KES</small> {{ number_format($total_collected, 2, '.', ',') }} </div>
                                         @endif
                                         @else
                                         <div class="widget-numbers">0.00</div>
                                         @endif

                                     <div class="widget-subheading">Total Collected On Rent</div>
                                   
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="widget-chart">
                                     <div class="icon-wrapper rounded-circle">
                                         <div class="icon-wrapper-bg bg-info"></div>
                                        
                                     </div>
                                     @if($expected_monthly_amount)
                                     @if ($expected_monthly_amount - $total_collected <= 0)
                                     <div class="widget-numbers">0.00</div>
                                     @elseif($expected_monthly_amount - $total_collected >= 1000000)
                                     <div class="widget-numbers"><small class="opacity-5 pr-1">KES</small> {{ number_format(($expected_monthly_amount - $total_collected)/1000000, 2, '.', ',') }} M </div>
                                     @elseif($expected_monthly_amount - $total_collected < 1000000)
                                     <div class="widget-numbers"><small class="opacity-5 pr-1">KES</small> {{ number_format(($expected_monthly_amount - $total_collected), 2, '.', ',') }} </div>
                                     @endif
                                     @else
                                     <div class="widget-numbers">0.00</div>
                                     @endif
                                     <div class="widget-subheading">Total Arrears On Rent</div>
                                   
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="widget-chart">
                                       <div class="icon-wrapper rounded-circle">
                                             <div class="icon-wrapper-bg bg-primary"></div>
                                             </div>
                                       @if($total_bills_collected)
                                       @if ($total_bills_collected <= 0)
                                       <div class="widget-numbers">0.00</div>
                                       @elseif($total_bills_collected >= 1000000)
                                       <div class="widget-numbers"><small class="opacity-5 pr-1">KES</small>{{ number_format($total_bills_collected/1000000, 2, '.', ',') }} M </div>
                                       @elseif($total_bills_collected < 1000000)
                                       <div class="widget-numbers"><small class="opacity-5 pr-1">KES</small> {{ number_format($total_bills_collected, 2, '.', ',') }} </div>
                                       @endif
                                       @else
                                       <div class="widget-numbers">0.00</div>
                                       @endif
                                     <div class="widget-subheading">Total Collected On Bills</div>
                                    
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="widget-chart br-br">
                                       <div class="icon-wrapper rounded-circle">
                                             <div class="icon-wrapper-bg bg-primary"></div>
                                             </div>
                                             <small class="opacity-5 pr-1">KES</small>
                                       @if($bills_arrears)
                                       @if ($bills_arrears <= 0)
                                       <div class="widget-numbers">0.00</div>
                                       @elseif($bills_arrears >= 1000000)
                                       <div class="widget-numbers"><small class="opacity-5 pr-1">KES</small>{{ number_format($bills_arrears/1000000, 2, '.', ',') }} M </div>
                                       @elseif($bills_arrears < 1000000)
                                       <div class="widget-numbers"><small class="opacity-5 pr-1">KES</small> {{ number_format($bills_arrears, 2, '.', ',') }} </div>
                                       @endif
                                       @else
                                       <div class="widget-numbers">0.00</div>
                                       @endif
                                     <div class="widget-subheading">Total Arrears On Bills</div>
                                    
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
              
         </div>
         <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="main-card mb-3 card">
                
                        <div class="p-0 card-body">
                            <div class="dropdown-menu-header mt-0 mb-0">
                                <div class="dropdown-menu-header-inner bg-heavy-rain">
                                    <div class="menu-header-image opacity-1" style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div>
                                    <div class="menu-header-content text-dark">
                                        <h5 class="menu-header-title">Requests</h5>
                                        <h6 class="menu-header-subtitle">
                                            You have
                                            @if ($requestcount)
                                            <b class="text-danger">{{ $requestcount }} </b>
                                            @else
                                            <b class="text-danger">0</b>
                                            @endif
                                            requests
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                                <li class="nav-item">
                                    <a role="tab" class="nav-link show active" id="tab-c-0" data-toggle="tab" href="#tab-animated-0" aria-selected="true">
                                        <span>Requests</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a role="tab" class="nav-link show" id="tab-c-1" data-toggle="tab" href="#tab-animated-1" aria-selected="false">
                                        <span>Notices</span>
                                    </a>
                                </li>
                              
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="tab-animated-0" role="tabpanel">
                                    <div class="scroll-area-sm">
                                        <div class="scrollbar-container ps ps--active-y">
                                            <div class="p-3">
                                                <div class="notifications-box">
                                                    <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                       
                                                        
                                                        @if($requests)
                                                        @foreach ($requests as $t)
                                                        <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                            <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                                <div class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title">{{$t->request_title}} - created on <span style="color:#794c8a">{{$t->created_at}}</span>
                                                                     <a href="{{url('landlord/service-request-details', $t->serviceid)}}"><span class="badge badge-danger ml-2">show</span></a>
                                                                    </h4>
                                                                    <span class="vertical-timeline-element-date"></span></div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="ps__rail-x" style="left: 0px; bottom: -202px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 202px; height: 200px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 101px; height: 99px;"></div></div></div>
                                    </div>
                                </div>
                                <div class="tab-pane show" id="tab-animated-1" role="tabpanel">
                                    <div class="scroll-area-sm">
                                        <div class="scrollbar-container ps">
                                            <div class="p-3">
                                                <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                   
                                                    @if ($notices)
                                                    @foreach ($notices as $t)
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"><i class="badge badge-dot badge-dot-xl badge-warning"> </i></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><p>{{$t->first_name}} {{$t->last_name}}, <a href="/Documents/Notices/{{$t->vacate_notice}}" download="{{$t->vacate_notice}}">{{$t->vacate_notice}}</a> at <b class="text-danger">{{$t->created_at}}</b></p>
                                                              <span class="vertical-timeline-element-date"></span></div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                   
                                                </div>
                                            </div>
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                                    </div>
                                </div>

                            </div>
                            <ul class="nav flex-column">
                                <li class="nav-item-btn text-center pt-4 pb-3 nav-item">
                                    <a href="{{url('landlord/service-requests')}}"><button class="btn-shadow btn-wide btn-pill btn btn-dark">
                                        <span class="badge badge-dot badge-dot-lg badge-warning badge-pulse">Badge</span>
                                        View All Requests
                                    </button></a>
                                </li>
                            </ul>
                        </div>
                   
            </div>
         </div>
      </div>


</div>
@endsection