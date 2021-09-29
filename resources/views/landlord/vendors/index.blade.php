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
                   All Vendors
                  
                </div>
             </div>
             
             <div class="page-title-actions">
               
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-dark text-white" data-toggle="modal" data-target=".bd-example-modal-lg">
                        Add New Vendor
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
              <th>Email</th>
              <th>Created At</th>
              {{-- <th>Actions</th> --}}
          </tr>
          </thead>
          <tbody>
              @if ($vendors)
              @foreach ($vendors as $v)
              <tr>
              <td>{{$v->first_name}}</td>
              <td>{{$v->last_name}}</td>
              <td>{{$v->id_number}}</td>
              <td>{{$v->phone_number}}</td>
              <td>{{$v->email}}</td>
              <td>{{$v->created_at}}</td>
              {{-- <td class="text-center">
                <div role="group" class="btn-group-sm btn-group">
                    <a href="{{url('landlord/vendor-details', $v->id)}}"><button class="btn-shadow btn btn-success"><i class="fas fa-eye"></i></button></a>
                    <button class="btn-shadow btn btn-dark text-white"><i class="fas fa-pen"></i></button>
                    <button class="btn-shadow btn btn-danger"><i class="fas fa-trash"></i></button>
                </div>
              </td> --}}
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
             <h5 class="modal-title" id="exampleModalLabel">Add New Vendor</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form action="{{url('landlord/add-vendor')}}" method="POST" style="padding: 40px">
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
                      <label for="" class="">Last name</label>
                      <input name="last_name" placeholder="last name" type="text" class="form-control">
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
                <div class="col col-12">
                    <div class="position-relative form-group">
                        <label for="" class="">Email</label>
                        <input name="email" placeholder="email" type="text" class="form-control">
                    </div>
                  </div>
                 <div class="col col-6">
                  <div class="position-relative form-group">
                      <label for="" class="">Postal Address</label>
                      <input name="postal_address" placeholder="Postal Address" type="text" class="form-control">
                  </div>
                </div>
                <div class="col col-6">
                 <div class="position-relative form-group">
                    <label for="exampleEmail5">Account Type</label>
                    <select name="bank_id" class="form-control">
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
                      <label for="" class="">Account Number</label>
                      <input name="account_number" placeholder="Account number" type="text" class="form-control">
                  </div>
                </div>
                 <div class="col col-6">
                  <div class="position-relative form-group">
                      <label for="exampleSelect" class="">Select Services</label>

                     <select multiple="multiple" class="multiselect-dropdown form-control" name="service_id[]">
                        <option value="">Select Services</option>
                        @if ($services)
                        @foreach ($services as $s)
                      <option value="{{$s->id}}">{{$s->service_name}}</option>
                        @endforeach
                        @endif
                                            
                        </select>


                    </div>
                </div>
                <div class="col col-12">
                  <div class="position-relative form-group">
                      <label for="exampleSelect" class="">Select Buildings</label>
                        <select multiple="multiple" class="multiselect-dropdown form-control" name="building_id[]">
                        <option value="">Select Buildings</option>
                       @if ($buildings)
                        @foreach ($buildings as $b)
                      <option value="{{$b->id}}">{{$b->building_name}}</option>
                        @endforeach
                        @endif
                                            
                        </select>
                    </div>
                </div>
               



            </div>
                
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning text-white">Create Vendor</button>
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


