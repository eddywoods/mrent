@extends('layouts.landlord')
@section('content')

<div class="app-main__outer">

      
    <div class="app-main__inner">

       <div class="app-page-title">
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
          <div class="page-title-wrapper">
               
             <div class="page-title-heading">
                <div class="page-title-icon">
                   <i class="pe-7s-phone icon-gradient bg-premium-dark">
                   </i>
                </div>
                <div>
                   All Unit Types
                  
                </div>
             </div>
             <div class="page-title-actions">
               
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">
                        New Unit Type
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
              <th>Unit Name</th>
              <th>Created At</th>
              <th>Actions</th>
          </tr>
          </thead>
          <tbody>
              @if ($units)
              @foreach ($units as $u)
              <tr>
              <td>{{$u->unit_type_name}}</td>
                  <td>{{$u->created_at}}</td>
                  <td class="text-center">
                    <div role="group" class="btn-group-sm btn-group">
                       <button class="btn-shadow btn btn-primary"><i class="fas fa-pen"></i></button>
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
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Add Unit Type</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form action="{{url('add-unit-type')}}" method="POST">
          <div class="modal-body">
         
             @csrf
               <input class="form-control" name="unit_type_name">
              
             
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
       </div>
    </div>
 </div>



@endsection


