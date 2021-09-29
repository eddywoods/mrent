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
                   <i class="pe-7s-phone icon-gradient bg-premium-dark">
                   </i>
                </div>
                <div>
                   All Bills
                  
                </div>
             </div>
             <div class="page-title-actions">

                <button type="button" id="abill" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                    Attach Bills
                </button>


                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                        Add New Bill
                    </button>
                 
                </div>
             </div>
          </div>
       </div>
       <div class="main-card mb-3 card">
        <div class="card-body">

       <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
          <thead>
          <tr>
              <th>Bill Name</th>
              <th>Bank Name</th>
              <th>Account Name</th>
              <th>Account Number</th>
              <th>Pay Bill Number</th>
              <th>Actions</th>
          </tr>
          </thead>
          <tbody>
              @if ($bills)
              @foreach ($bills as $b)
              <tr>
              <td>{{$b->bill_name}}</td>
              <td>{{$b->bank_name}}</td>
              <td>{{$b->bill_account_name}}</td>
              <td>{{$b->bill_account_number}}</td>
              <td>{{$b->paybill_number}}</td>
              <td class="text-center">
                <div role="group" class="btn-group-sm btn-group">
                    <button class="btn-shadow btn btn-primary"><i class="fas fa-pen"></i></button>
                    <button class="btn-shadow btn btn-danger"><i class="fas fa-trash"></i></button>
                </div>
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
 </div>


 <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Attach Bill To Building</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="{{url('landlord/attach-bill')}}" method="POST">
            <div class="modal-body">
           
               @csrf

               <div class="col col-12">
                   <div class="position-relative form-group">
                      <label for="exampleEmail5">Select Building</label>
                      <select name="building_id" class="form-control">
                         <option value="">Select Building..</option>
                         @if($buildings)
                         @foreach ($buildings as $b)
                         <option value="{{$b->id}}">{{ $b->building_name }}</option>
                         @endforeach
                         @endif
                      </select>
                   </div>
               </div>


               <div class="col col-12">
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

              <div class="col col-12">
                 <div class="position-relative form-group">
                   <label for="exampleSelect" class="">Bill Type</label>
                   <select name="bill_type"  class="form-control" id="billtype">
                      <option value="">Select Bill Type..</option>
                     <option value="fixed">Fixed</option>
                     <option value="variable">Variable</option>
                   </select>
                 </div>
               </div>

               <div id="fixed">
               <div class="col col-12" id="fixed_amount">
                   <div class="position-relative form-group">
                     <label for="exampleEmail" class="">Bill Amount</label>
                     <input name="fixed_bill_amount"  placeholder="Bill Amount" type="text" class="form-control">
                   </div>
                 </div>
               </div>
                
              <div id="freq">
                <div class="col col-12" id="frequency">
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
              </div>

              <div id="variable">
              <div class="col col-12" id="variable_amount">
                 <div class="position-relative form-group">
                   <label for="exampleEmail" class="">Amount Per Unit</label>
                   <input name="variable_bill_amount"  placeholder="Amount per unit" type="text" class="form-control">
                 </div>
               </div>
              </div>

               <div class="col col-12">
                  <div class="position-relative form-group">
                    <label for="exampleEmail" class="">Deposit Amount</label>
                    <input name="bill_deposit"  placeholder="Deposit Amount" type="text" class="form-control">
                  </div>
                </div>
           
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Attach Bill</button>
            </div>
          </form>
         </div>
    </div>
</div>




 <!-- Modal -->
 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Add New Bill</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form action="{{url('landlord/add-bill')}}" method="POST">
            @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col col-6">
                  <div class="position-relative form-group">
                    <label for="exampleEmail" class="">Bill Name</label>
                    <input name="bill_name"  placeholder="Bill name" type="text" class="form-control">
                  </div>
                </div>

                  <div class="col col-6">
                      <div class="position-relative form-group">
                         <label for="exampleEmail5">Account Type</label>
                         <select name="bill_bank_id" class="form-control">
                            <option value="">Select Bank..</option>
                            @if($banks)
                            @foreach ($banks as $b)
                            <option value="{{$b->bank_id}}">{{ $b->bank_name }}</option>
                            @endforeach
                            @endif
                         </select>
                      </div>
                  </div>
                  <div class="col col-6">
                      <div class="position-relative form-group">
                          <label for="exampleEmail5">Account Name</label>
                          <input type="text" class="form-control" name="bill_account_name">
                       </div>
                  </div>
                  <div class="col col-6">
                      <div class="position-relative form-group">
                         <label for="exampleEmail5">Account Number</label>
                         <input type="text" class="form-control" name="bill_account_number">
                      </div>
                  </div>
                
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Bill</button>
                  </div>
              </form>
       </div>
    </div>
 </div>




@endsection

@section('javascript')

<script>
$(document).ready(function () {
    var frequency =  $('#frequency');
    var variable_amount =  $('#variable_amount');
    var fixed_amount =  $('#fixed_amount');

    $('#abill').click(function(){
      $('#frequency').detach();
      $('#variable_amount').detach();
      $('#fixed_amount').detach();
    });

  $('#billtype').change(function(e){
    var c = $('#billtype').find(":selected").text();
    if (c == 'Fixed') {
      $('#freq').append(frequency);
      $('#variable_amount').detach();
      $('#fixed').append(fixed_amount);
    } else if(c == 'Variable') {
      $('#frequency').detach();
      $('#variable').append(variable_amount);
      $('#fixed_amount').detach();
    }
    });
});

</script>

@endsection


