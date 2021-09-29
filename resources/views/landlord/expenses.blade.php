@extends('layouts.landlord')
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
                   Manage Expenses
                  
                </div>
             </div>
             <div class="page-title-actions">
               
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                        Add New Expense
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
              <th>Expense Name</th>
              <th>Building Name</th>
              <th>Unit Type</th>
              <th>Unit Number</th>
              <th>Amount(kes)</th>
              <th>Created At</th>
             
          </tr>
          </thead>
          <tbody>
              @if ($expenses)
              @foreach ($expenses as $t)
              <tr>
              <td>{{$t->expense_name}}</td>
              <td>{{$t->building_name}}</td>
              <td>{{$t->unit_type_name}}</td>
               <td>{{$t->unit_number}}</td>
               <td>{{$t->amount}}</td>
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

 <!-- Modal -->
 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Add New Expense</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form action="{{url('landlord/create-expense')}}" method="POST">
            @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col col-6">
                  <div class="position-relative form-group">
                    <label for="exampleEmail" class="">Expense  Name</label>
                    <input name="expense_name"  placeholder="expense name" type="text" class="form-control">
                  </div>
                </div>
             
                <div class="col col-6">
                  <div class="position-relative form-group">
                      <label for="exampleSelect" class="">Select Building</label>
                      <select name="building_id" id="building" class="form-control">
                        <option value="">Select Building</option>
                        @if ($buildings)
                        @foreach ($buildings as $b)
                      <option value="{{$b->id}}">{{$b->building_name}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                </div>
                <div class="col col-6">
                    <div class="position-relative form-group">
                        <label for="exampleSelect" class="">Select Unit</label>
                        <select name="unit_id" id="units" class="form-control">
                        
                        </select>
                      </div>
              </div>

              <div class="col col-6">
                <div class="position-relative form-group">
                    <label for="exampleSelect" class="">Select Unit Number</label>
                    <select name="unit_number" id="labels" class="form-control">
                    
                    </select>
                  </div>
            </div>

               <div class="col col-6">

                  <div class="position-relative form-group">
                      <label for="" class="">Amount</label>
                      <input name="amount" placeholder="e.g 20000" type="text" class="form-control">
                  </div>
                </div>
                <div class="col col-6">
                   <label for="" class="">Note (Optional)</label>
                  <div class="position-relative form-group">
                     
                      <textarea class="" name="description" class="form-control"></textarea>
                  </div>
                </div>


            </div>
                
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Expense</button>
                  </div>
              </form>
       </div>
    </div>
 </div>



@endsection

@section('javascript')

<script>
$(document).ready(function () {
  $('#building').change(function() {

      $.ajax({
          type:"GET",
          url : "getunits/"+$(this).val(),
          success : function(response) {
              data = response;
             
              var select = $('#units');
                select.empty();
                $.each(data, function(index, value) {      
                    select.append(
                        $('<option></option>').val(value.unitid).html(value.unit_type_name)
                    );
          });

          var select = $('#labels');
                select.empty();
                $.each(data['labels'], function(index, value) {      
                    select.append(
                        $('<option></option>').val(value.id).html(value.label)
                    );
          });

          },
          error: function() {
              console.log('Error occured');
          }
      });
      
    
  });
});
</script>

@endsection


