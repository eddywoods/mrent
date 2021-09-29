@extends('layouts.tenant')
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
                   <i class="pe-7s-phone icon-gradient bg-premium-dark">
                   </i>
                </div>
                <div>
                   My Rental Units
                  
                </div>
             </div>
             <div class="page-title-actions">
<!--                
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                        New Request
                    </button>


                 
                </div> -->
             </div>
          </div>
       </div>
       <div class="main-card mb-3 card">
        <div class="card-body">

       <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
          <thead>
          <tr>
              <th>Building Name</th>
              <th>Building Location</th>
              <th>Unit Type</th>
              <th>Unit Number</th>
              <th>Rent Amount</th>
              <th>Invoicing Date</th>
              <th>Created At</th>
             
          </tr>
          </thead>
          <tbody>
              @if ($units)
              @foreach ($units as $t)
              <tr>
              <td>{{$t->building_name}}</td>
              <td>{{$t->location}}</td>
              <td>{{$t->unit_type_name}}</td>
               <td>{{$t->label}}</td>
               @if($t->tenant_rent_amount == null)
              <td>{{$t->unit_price}}</td>
              @else
              <td>{{$t->tenant_rent_amount}}</td>
              @endif
              <td>{{$t->invoicing_date}}</td>
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
 </div>



@endsection
