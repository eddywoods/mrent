@extends('layouts.agent')
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
              
               <a href="{{ url('agent/services') }}">
               <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-dark text-white btn-sm">
               <span class="mr-1"> Vendor Services</span>
               </button>
               </a>
               <a href="{{ url('agent/payments') }}">
               <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-dark text-white btn-sm">
               <span class="mr-1"> Payment Reports</span>
               </button>
               </a>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-lg-3">
            <a href="{{ url('agent/list-buildings') }}">
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
         <a href="{{ url('agent/list-tenants') }}">
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
                  <div class="widget-title opacity-5 text-uppercase">Total Expected</div>
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
                  <div class="widget-title opacity-5 text-uppercase">Total Collected</div>
                  <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                     <div class="widget-chart-flex align-items-center">
                        <div>

                           <small class="opacity-5 pr-1">KES</small>
                           @if($total_collected)
                           @if ($total_collected <= 0)
                           <span>0.00</span>
                           @elseif($total_collected >= 1000000)
                           {{ number_format($total_collected/1000000, 2, '.', ',') }} M
                           @elseif($total_collected < 1000000)
                           {{ number_format($total_collected, 2, '.', ',') }}
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
                  <div class="widget-title opacity-5 text-uppercase">Arrears</div>
                  <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                     <div class="widget-chart-flex align-items-center">
                        <div>

                              <small class="opacity-5 pr-1">KES</small>
                              @if($expected_monthly_amount)
                              @if ($expected_monthly_amount - $total_collected <= 0)
                              <span>0.00</span>
                              @elseif($expected_monthly_amount - $total_collected >= 1000000)
                              {{ number_format(($expected_monthly_amount - $total_collected)/1000000, 2, '.', ',') }} M
                              @elseif($expected_monthly_amount - $total_collected < 1000000)
                              {{ number_format(($expected_monthly_amount - $total_collected), 2, '.', ',') }}
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
                  <div class="widget-title opacity-5 text-uppercase">SERVICE REQUESTS</div>
                  <div class="widget-numbers mt-2 fsize-4 mb-0 w-100">
                     <div class="widget-chart-flex align-items-center">
                        <div>
                           <small class="text-success pr-1">+</small>
                           @if ($requestcount)
                           {{ $requestcount }}
                           @else
                           <span>0</span>
                           @endif
                           <small class="opacity-5 pl-1">Requests</small>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
         <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="main-card mb-3 card">
               <div class="card-header">
                  <div class="card-header-title font-size-lg text-capitalize font-weight-normal">LATEST MOVED IN TENANTS</div>
               </div>
               <div class="table-responsive">
                  <table class="align-middle text-truncate mb-0 table table-borderless table-hover">
                     <thead>
                        <tr>
                           <th>Name</th>
                           <th>Id Number</th>
                           <th>Mobile Number</th>
                           <th>Created At</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if ($tenants)
                        @foreach ($tenants as $t)
                        <tr>
                           <td>{{$t->first_name}} {{$t->last_name}}</td>
                           <td>{{$t->id_number}}</td>
                           <td>{{$t->phone_number}}</td>
                           <td>{{$t->created_at}}</td>
                           <td class="text-center">
                           </td>
                        </tr>
                        @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
             
            </div>
         </div>
         <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="main-card mb-3 card">
               <div class="card-header">
                  <div class="card-header-title font-size-lg text-capitalize font-weight-normal">LATEST PAYMENTS MADE</div>
               </div>
               <div class="table-responsive">
                     <table class="align-middle text-truncate mb-0 table table-borderless table-hover">
                           <thead>
                           <tr>
                              <th>Name</th>
                              <th>Phone Number</th>
                              <th>Payment Method</th>
                              <th>Amount (kes)</th>
                              
                           </tr>
                           </thead>
                           <tbody>
                                 @if($payments)
                                 @foreach ($payments as $p)
                              <tr>
                              <td>{{ $p->first_name }} {{ $p->last_name }} </td>
                              <td>{{ $p->phone_number }}</td>
                              <td>{{ $p->payment_method }}</td>
                              <td>{{ $p->amount }}</td>
                              
                              </tr>
                              @endforeach
                              @endif
                     
                           </tbody>
                        
                     </table>
               </div>
            </div>
         </div>
      </div>
   {{-- <div class="row">
      <div class="col-sm-12 col-md-7 col-lg-8">
         <div class="mb-3 card">
            <div class="card-header-tab card-header">
               <div class="card-header-title font-size-lg text-capitalize font-weight-normal">Income Report</div>
               <div class="btn-actions-pane-right text-capitalize">
                  <button class="btn btn-warning">Actions</button>
               </div>
            </div>
            <div class="pt-0 card-body">
               <div id="chart-combined"></div>
            </div>
         </div>
      </div>
      <div class="col-sm-12 col-md-5 col-lg-4">
         <div class="mb-3 card">
            <div class="card-header-tab card-header">
               <div class="card-header-title font-size-lg text-capitalize font-weight-normal">Occupancy Rate</div>
            </div>
            <div class="p-0 card-body">
               <div id="chart-radial"></div>
               <div class="widget-content pt-0 w-100">
                  <div class="widget-content-outer">
                     <div class="widget-content-wrapper">
                        <div class="widget-content-left pr-2 fsize-1">
                           <div class="widget-numbers mt-0 fsize-3 text-warning">32%</div>
                        </div>
                        <div class="widget-content-right w-100">
                           <div class="progress-bar-xs progress">
                              <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%;"></div>
                           </div>
                        </div>
                     </div>
                     <div class="widget-content-left fsize-1">
                        <div class="text-muted opacity-6">Spendings Target</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> --}}

</div>
@endsection