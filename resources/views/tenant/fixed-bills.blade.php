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
                   My Fixed  Bills
                  
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
                  <th>Bill Name</th>
                  <th>Amount</th>
                  <th>Payment Frequency</th>
               
                </tr>
              </thead>
              <tbody>
                    @if($bills)
                    @foreach ($bills as $m)
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

     
    </div>

 </div>
 </div>
 </div>



@endsection
