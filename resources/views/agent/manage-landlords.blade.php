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
                   All Landlords
                  
                </div>
             </div>
             <div class="page-title-actions">
               
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-dark text-white" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus"></i> 
                        Add New Landlord
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
              @if ($landlords)
              @foreach ($landlords as $t)
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
                    <a href="{{url('agent/landlord-details', $t->user_id)}}"><button class="btn-shadow btn btn-success"><i class="fas fa-eye"></i></button></a>
                    {{-- <button class="btn-shadow btn btn-primary"><i class="fas fa-pen"></i></button>
                    <button class="btn-shadow btn btn-danger"><i class="fas fa-trash"></i></button> --}}
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
             <h5 class="modal-title" id="exampleModalLabel">Add New Property owner</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form action="{{url('agent/add-landlord')}}" method="POST">
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
                    <input name="user_type" type="hidden" value="landlord">
                    <div class="position-relative form-group">
                      <label for="exampleSelect" class="">Citizenship</label>
                      <select name="citizenship" id="exampleSelect" class="form-control">
                        <option value="kenyan">kenyan</option>
                        <option value="foreigner">Foreigner</option>
                      </select>
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
                

            </div>
                
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning text-white">Create Landlord</button>
                  </div>
              </form>
       </div>
    </div>
 </div>



@endsection

@section('javascript')

<script>

</script>

@endsection


