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
                   <i class="pe-7s-phone icon-gradient bg-premium-dark">
                   </i>
                </div>
                <div>
                   Vacate Notices
                  
                </div>
             </div>
             <div class="page-title-actions">
               
               <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-vacate-modal-sm">
                        <i class="fa fa-plus"></i> Create Eviction Notice
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
              <th>#</th>
              <th>Tenant Name</th>
              <th>ID Number</th>
              <th>Building Name</th>
              <th>Unit Type</th>
              <th>Unit Number</th>
              <th>Created At</th>
              <th>Download</th>
             
          </tr>
          </thead>
          <tbody>
              @if ($notices)
              @foreach ($notices as $t)
              <tr>
              <td>{{$t->noticeid}}</td>
              <td>{{$t->first_name}} {{$t->last_name}}</td>
              <td>{{$t->id_number}}</td>
              <td>{{$t->building_name}}</td>
              <td>{{$t->unit_type_name}}</td>
               <td>{{$t->label}}</td>
              <td>{{$t->created_at}}</td>
              <td>
                <a href="/Documents/Notices/{{$t->vacate_notice}}" download="{{$t->vacate_notice}}">{{$t->vacate_notice}}</a>
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

  <!-- Modal -->
 <div class="modal fade bd-vacate-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate a vacate notice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('agent/vacate-notice')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                       
                      <div class="col col-12">
                        <div class="position-relative form-group">
                            <label for="exampleSelect" class="">Select Tenant</label>
                            <select name="tenant_id" id="tenant" class="form-control" required>
                                <option value="">Select Tenant</option>
                                @if ($tenants) 
                                @foreach ($tenants as $t)
                                <option value="{{$t->userid}}">{{$t->first_name}} - {{$t->last_name}} ({{$t->first_name}} - {{$t->email}})</option>
                                @endforeach 
                                @endif
                            </select>
                        </div>
                        
                    </div>


                    <div class="col col-12">
                      <div class="position-relative form-group">
                         <label for="exampleSelect" class="">Select Unit</label>
                         <select name="account_number" id="units" class="form-control">
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

<script>
$(document).ready(function () {
  $('#tenant').change(function() {

      $.ajax({
          type:"GET",
          url : "/agent/gettenantunits/"+$(this).val(),
          success : function(response) {
              data = response;
             
              var select = $('#units');
                select.empty();
                $.each(data, function(index, value) {    
                    select.append(
                        $('<option></option>').val(value.account_number).html(value.building_name + "-" +  value.label)
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


