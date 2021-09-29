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
                   All Tenants
                  
                </div>
             </div>
             <div class="page-title-actions">
               
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                        Add New Tenant
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
                    <a href="{{url('agent/tenant-details', $t->user_id)}}"><button class="btn-shadow btn btn-success"><i class="fas fa-eye"></i></button></a>
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

 <!-- Modal -->
 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Add New Tenant</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form action="{{url('landlord/add-tenant')}}" method="POST">
            @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col col-6">
                  <div class="position-relative form-group">
                    <label for="exampleEmail" class="">First Name</label>
                    <input name="first_name"  placeholder="first name" type="text" class="form-control">
                  </div>
                </div>
                <div class="col col-6">
                  <div class="position-relative form-group">
                      <label for="exampleEmail" class="">Middle name</label>
                      <input name="middle_name" placeholder="middle name" type="text" class="form-control">
                  </div>
                </div>
                <div class="col col-6">
                  <div class="position-relative form-group">
                      <label for="" class="">Last name</label>
                      <input name="last_name" placeholder="last name" type="text" class="form-control">
                  </div>
                </div>
                <div class="col col-6">
                  <div class="position-relative form-group">
                      <label for="" class="">Email</label>
                      <input name="email" placeholder="email" type="text" class="form-control">
                  </div>
                </div>
                <div class="col col-6">

                  <div class="position-relative form-group">
                      <label for="" class="">Mobile Number</label>
                      <input name="phone_number" placeholder="phone number" type="text" class="form-control">
                  </div>
                </div>
                <div class="col col-6">
                  <div class="position-relative form-group">
                      <label for="" class="">ID Number</label>
                      <input name="id_number" placeholder="ID Number" type="text" class="form-control">
                  </div>
                </div>
                <div class="col col-6">
                  <input name="user_type" type="hidden" value="tenant">
                  <div class="position-relative form-group">
                    <label for="exampleSelect" class="">Citizenship</label>
                    <select name="citizenship" id="exampleSelect" class="form-control">
                      <option value="kenyan">kenyan</option>
                      <option value="foreigner">Foreigner</option>
                    </select>
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
                      <label for="exampleSelect" class="">Unit No</label>
                      <input name="unit_number" placeholder="e.g 6A" type="text" class="form-control">
                    </div>
            </div>


            </div>
                
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Tenant</button>
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
                        $('<option></option>').val(value.unit_type_id).html(value.unit_type_name)
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


