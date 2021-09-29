@extends('layouts.tenant')
@section('content')
@section('styles')
<style>
    .switch-field input {
        position: absolute !important;
        clip: rect(0, 0, 0, 0);
        overflow: hidden;
    }
    
    .switch-field label {
        background-color: #00aae0;
        color: #fff;
        font-size: 14px;
        text-align: center;
        padding: 8px 16px;
        margin-right: -1px;
        border: none;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        transition: all 0.1s ease-in-out;
    }
    
    .switch-field label:hover {
        cursor: pointer;
    }
    
    .switch-field input:checked + label {
        background-color: #111;
        box-shadow: none;
        color: #fff;
    }
    
    .switch-field label:first-of-type {
        border-radius: 10px;
    }
    
    .switch-field label:last-of-type {
        border-radius: 10px;
    }
    
    hr {
        border-bottom: 1px dashed #111;
    }
    #mpesa {
        background: #f4f4f4;
        padding: 20px;
    }
</style>
@endsection
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
                            <span class="d-inline-block">Welcome Back, {{ auth()->user()->first_name }}</span>
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
                                        <a>Customer Area</a>
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
                        <button type="button" class="btn-pill btn-shadow btn-wide fsize-1 btn btn-danger btn-sm" data-toggle="modal" data-target=".bd-vacate-modal-sm">
                        Submit Vacate Notice
                        </button>

                </div>
                </div>
            </div>
        </div>
        <div class="mbg-3 alert alert-info alert-dismissible fade payment-success hide" role="alert">
            Payment Posted Successfully!
        </div>
        <div class="row">
            <div class="col col-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                       <ul>
                          @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                          @endforeach
                       </ul>
                    </div>
                    @endif
                <div class="main-card mb-3 card">

                        <div class="row">
                                <div class="col-md-6 col-xl-3">
                                    <div class="card mb-3 widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Payments</div>
                                                <div class="widget-subheading">This Month</div>
                                            </div>
                                            <div class="widget-content-right">
                                            <div class="widget-numbers"><span>{{$total_paid_this_month}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card mb-3 widget-content bg-arielle-smile">
                                        <div class="widget-content-wrapper text-white">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Rent Paid</div>
                                                <div class="widget-subheading">This Month</div>
                                            </div>
                                            <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span>{{$total_rent_paid_this_month}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                    <div class="card mb-3 widget-content bg-happy-green">
                                        <div class="widget-content-wrapper text-white">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Total Amount Due Last Month</div>
                                            <div class="widget-subheading">Rent + Fixed Bills + Variable Bills</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-white"><span>{{$total_amount_due_last_month}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-3">
                                        <div class="card mb-3 widget-content bg-premium-dark">
                                            <div class="widget-content-wrapper text-white">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Balance Outstanding</div>
                                                    <div class="widget-subheading">Paid - Due Amount</div>
                                                </div>
                                                <div class="widget-content-right">
                                                <div class="widget-numbers text-white"><span>{{$total_outstanding_amount}}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>






                    <div class="no-gutters row">
                            <div class="col-md-6 col-xl-4">
                                    <div class="widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-right ml-0 mr-3">
                                                @if($total)
                                                <div class="widget-numbers text-warning">
                                                    {{$total}}
                                                </div>
                                                @else
                                                <div class="widget-numbers text-warning">
                                                    0
                                                </div>
                                                @endif
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Initial Payment</div>
                                                <div class="widget-subheading">Total Deposit + Rent</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="widget-content">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-right ml-0 mr-3">
                                        @if($upcoming_amount)
                                        <div class="widget-numbers text-success">{{$upcoming_amount}}</div>
                                        @else
                                        <div class="widget-numbers text-success">0</div>
                                        @endif
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Upcoming Payment</div>
                                        <div class="widget-subheading">Payment for Next Month (rent and fixed bills)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                        <div class="col-md-6 col-xl-4">
                            <div class="widget-content">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-right ml-0 mr-3">
                                        <div class="widget-numbers text-danger">0</div>
                                    </div>
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Overdue Amount</div>
                                        <div class="widget-subheading">Unpaid Amount</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                </div>
                <article class="card">
                    <div class="card-body p-5">
                        <div class="text-center" style="margin-bottom: 10px">
                            <h3>Pay for your Rent, Bills and Utilities with Mrent</h3>
                        </div>
                        <hr>
                        <div class="switch-field">
                            <ul class="nav nav-pills rounded nav-fill mb-3" role="tablist">
                                <li class="nav-item">
                                    <input type="radio" id="radio-three" name="category" value="rent"/>
                                    <label for="radio-three"><i class="fa fa-credit-card"></i> Rent Mpesa Payment</label>

                                </li>
                                <li class="nav-item">
                                    <input type="radio" id="radio-four" name="category" value="bills" />
                                    <label for="radio-four"><i class="fa fa-credit-card"></i> Bill Mpesa Payment</label>

                                </li>
                                <li class="nav-item">
                                    <input type="radio" id="radio-five" name="category" value="utilities" />
                                    <label for="radio-five"><i class="fa fa-credit-card"></i> Utilities Mpesa Payment</label>

                                </li>

                                <li class="nav-item">
                                    <input type="radio" id="radio-six" name="category" value="loan" />
                                    <label for="radio-six"><i class="fa fa-credit-card"></i> Pay Via Loan</label>

                                </li>

                            </ul>

                        </div>

                        

                        <div class="switch-field2" style="display:none; margin-top: 5%">
                              <ul class="nav nav-pills rounded nav-fill mb-3" role="tablist">
                                 @if ($billers)
                                 @foreach ($billers as $b)
                               
                                 <li class="nav-item">
                                    <input type="radio" id="radio-ipay-{{$b['biller_code']}}" name="ipay-utility" value="{{$b['biller_name']}}"/>
                                    <label id="{{$b['biller_name']}}" for="radio-ipay-{{$b['biller_code']}}"><i class="fa fa-credit-card"></i> {{$b['biller_name']}}</label>
                                 </li>
                               
                                 @endforeach
                                     
                                 @endif
  
                              </ul>
  
                         
                          <div class="row">
                              <div class="col col-md-8 col-sm-8">
                                    <div id="kplc_prepaid" style="display: none; margin-left: 40%; margin-left: 20%; margin-bottom: 5%; margin-top: 5%">
                                          <div class="input-group" style="margin: 10px">
                                                <label for="username"></label>
                                                <input type="text" class="form-control" name="prepaid_account" id="prepaid_account" placeholder="Prepaid Account Number" required="">
                                                
                                          </div>

                                        
                                    </div>
                              </div>
                              <div class="col col-md-8 col-sm-8">
                                    <div id="airtel" style="display: none; margin-left: 40%; margin-left: 20%; margin-bottom: 5%; margin-top: 5%">
                                          <div class="form-group">
                                              <label for="username">Airtel Mobile Number</label>
                                              <input type="text" class="form-control" name="airtel_account" id="airtel_account" placeholder="" required="">
                                          </div>
                                    </div>
                              </div>
                              <div class="col col-md-8 col-sm-8">
                                    <div id="safaricom" style="display: none; margin-left: 40%; margin-left: 20%; margin-bottom: 5%; margin-top: 5%">
                                          <div class="form-group">
                                              <label for="username">Safaricom Mobile Number</label>
                                              <input type="text" class="form-control" name="safaricom_account" id="safaricom_account" placeholder="" required="">
                                          </div>
                                    </div>
                              </div>
                              <div class="col col-md-8 col-sm-8">
                                    <div id="post_paid" style="display: none; margin-left: 40%; margin-left: 20%; margin-bottom: 5%; margin-top: 5%">
                                            <div class="input-group" style="margin: 10px">
                                            <input type="text" class="form-control" name="postpaid_acc_no" id="postpaid_acc_no" placeholder="Your PostPaid Acc." required="">
                                            <div class="input-group-append">
                                                    <button class="btn btn-success" id="postpaid-fetch">Fetch Bill</button>
                                                    <div style="padding-left: 20px; margin-top: 15px">
                                                    <span id="postpaid-loader" class="hide"><img src="{{asset('base/images/ajax-loader.gif')}}" width="40px"></span>
                                                    <span id="postpaid-data"></span>
                                                    </div>
                                            </div>
                                        </div>

                                    </div>
                              </div>
                              <div class="col col-md-8 col-sm-8">
                                    <div id="telcom" style="display: none; margin-left: 40%; margin-left: 20%; margin-bottom: 5%; margin-top: 5%">
                                          <div class="form-group">
                                              <label for="username">Telkom Mobile Number</label>
                                              <input type="text" class="form-control" name="telkom_account" id="telkom_account" placeholder="" required="">
                                          </div>
                                    </div>
                              </div>
                              <div id="dstv" class="col col-md-6 col-sm-6" style="display:none; margin-left: 20%; margin-bottom: 5%; margin-top: 5%">
                                    <label for="username">Dstv Account Number</label>
                                    <div class="input-group" style="margin: 10px">
                                         
                                          <input type="text" class="form-control" name="gotv_acc_no" id="gotv_acc_no" placeholder="" required="">
                                          <div class="input-group-append">
                                                <button class="btn btn-success" id="gotv-fetch">Fetch Bill</button>
                                                <div style="padding-left: 20px; margin-top: 15px">
                                                <span id="gotv-loader" class="hide"><img src="{{asset('base/images/ajax-loader.gif')}}" width="40px"></span>
                                                <span id="gotv-data"></span>
                                                </div>
                                          </div>
                                    </div>


                              </div>
                          </div>
                        </div>



                        <div id="mpesa-payment" class="tab-content">
                           
                                <div class="col col-8">
                                    <div id="unit-house" class="position-relative form-group hide" style="margin-left: 40%">
                                        <label for="exampleSelect" class="">Select House Unit</label>
                                        <select name="account_number" id="account_number" class="form-control" required>
                                            <option value="">Select House Unit</option>
                                            @if ($units) @foreach ($units as $u)
                                            <option value="{{$u->account_number}}">{{$u->building_name}} - {{$u->label}}</option>
                                            @endforeach @endif
                                        </select>
                                    </div>
                                    <div class="col col-12" style="text-center">
                                            <div id="loading" class="hide">Loading..</div>
                                            <div id="payable" class="hide" style="margin-left: 40%; font-size: 14px; font-weight: bolder; padding-bottom: 20px">
                                            <span>Amount Payable: Ksh </span><span id="amount-payable" class="hide"></span>
                                            </div>
                                        </div>
                                
                                </div>
                           
                           
                    
                            <div id="mpesa" class="row">
                                <div class="col col-md-6 col-sm-12" style="padding-right:20px; border-right: 1px solid #ccc;">
                                    <h6>First Mpesa Payment Option</h6>
                                    </hr>
                                    <form role="form">
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="username">Mobile Number To Charge</label>
                                                <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="" required="">
                                            </div>
                                            <!-- form-group.// -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="username">Enter Amount</label>
                                                <input type="text" class="form-control" name="amount" id="amount" placeholder="" required="">
                                            </div>
                                            <!-- form-group.// -->
                                        </div>
                                        <input type="hidden" id="account" value="{{auth()->user()->uniq_id}}">
                                        <div id="make-payment">
                                            <button class="subscribe btn btn-primary btn-block" type="button" id="stk"> Make Payment </button>
                                        </div>
                                        <div id="awaiting-payment" style="display:none">
                                            <button class="subscribe btn btn-success btn-block disabled" type="button"> Awaiting Payment...</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col col-md-6 col-sm-12">
                                    <div class="instructions" style="padding-left: 50px">
                                        <h6>Second Mpesa Payment Option</h6>
                                        </hr>
                                        <p>Follow the instructions below:</p>
                                        <ul>
                                            <li>Go to m-pesa menu</li>
                                            <li>Select lipa na mpesa</li>
                                            <li>Select pay bill</li>
                                            <li>Enter paybill number <strong>12345</strong></li>
                                            <li>Enter account number <strong></strong></li>
                                            <li>Enter the amount <strong></strong></li>
                                            <li>Enter your pin and send</li>
                                        </ul>
                                        <p>Once you receive the confirmation SMS, enter the transaction code in the box below</p>
                                        <div class="form-group">
                                            <label>Transaction Code</label>
                                            <input type="number" placeholder="XXXXXX" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <a href="#" class="btn btn-primary pull-right">Verify Payment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <h6 align="left" style="font-size: 10px; margin-left: 10px">By proceeding to use Mrent, you accept our <a href="">Terms &amp; Conditions</a> </h6>

                        </div>
                        <!-- tab-content .// -->
                        

                        <div class="" id="loan-payment" style="display:none">

                            <div class="col col-12">
                                <span class="text-center"><h3>You Qualify for a loan of: <sopan class="text-success">Ksh. 15000</sopan></h3></span>
                                <div id="unit-house" class="position-relative form-group show" style="margin-left: 40%">

                                    <button type="button" class="btn btn-info pull-center" data-toggle="modal" data-target=".bd-example-modal-lg">
                                        Pay Via Loan Now!
                                    </button>

                                </div>
                            </div>

                        </div>
                       

                    </div>
                    <!-- card-body.// -->
                </article>
                <!-- card.// -->
            </div>
        </div>
    </div>
  </div>
</div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="margin-top: 30%">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apply for Loan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('tenant/service-request')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col col-6">
                                <div class="position-relative form-group">
                                    <label for="exampleSelect" class="">Payment Reason</label>
                                    <select name="building_id" id="building" class="form-control">
                                        <option value="">Select reason</option>
                                        <option value="rent"> Rent</option>
                                        <option value="bills">Bills</option>
                                        <option value="utilities">Utilities</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-6">
                                <div class="position-relative form-group">
                                    <label for="exampleSelect" class="">Select House Unit</label>
                                    <select name="account_number" id="account_number" class="form-control" required>
                                        <option value="">Select House Unit</option>
                                        @if ($units) @foreach ($units as $u)
                                        <option value="{{$u->account_number}}">{{$u->building_name}} - {{$u->label}}</option>
                                        @endforeach @endif
                                    </select>
                                </div>
                                
                            </div>

                            <div class="col col-12">
                                <div class="position-relative form-group">
                                    <label for="exampleEmail" class="">Loan Amount </label>
                                    <input name="loan_amount" placeholder="e.g 500" type="number" class="form-control">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Apply Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade bd-vacate-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vacate House Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{url('tenant/vacate-notice')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                               
                                <div class="col col-12">
                                    <div class="position-relative form-group">
                                        <label for="exampleSelect" class="">Select House Unit</label>
                                        <select name="account_number" id="account_number" class="form-control" required>
                                            <option value="">Select House Unit</option>
                                            @if ($units) @foreach ($units as $u)
                                            <option value="{{$u->account_number}}">{{$u->building_name}} - {{$u->label}}</option>
                                            @endforeach @endif
                                        </select>
                                    </div>
                                    
                                </div>
    
                                <div class="col col-12">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail" class="">Upload Vacate Notice </label>
                                        <input name="vacate_notice"  type="file" class="form-control">
                                    </div>
                                </div>
    
                            </div>
    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit Notice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    @endsection 
    @section('javascript')
    <script type="text/javascript" src="{{asset('assets/scripts/cust.js')}}"></script>
    @endsection