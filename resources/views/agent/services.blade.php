
@extends('layouts.agent')
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
                   All Services
                  
                </div>
             </div>
             <div class="page-title-actions">
               
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">
                        New Service
                        </button>
                 
                </div>
             </div>
          </div>
       </div>
       <div class="main-card mb-3 card">
        <div class="card-body">

            @if ($services)
               <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                  <thead>
                  <tr>
                     <th>Service Name</th>
                     <th>Created At</th>
                  </tr>
                  </thead>
                  <tbody>
                     
                     @foreach ($services as $s)
                     <tr>
                     <td>{{$s->service_name}}</td>
                     <td>{{$s->created_at}}</td>
                     </tr>
                     @endforeach
                     
               
                  </tbody>
               
               </table>
         @else
         <h3>No Services Available Yet</h3>
         @endif
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
             <h5 class="modal-title" id="exampleModalLabel">Add Vendor Service</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form action="{{url('agent/add-service')}}" method="POST">
          	 @csrf
          <div class="modal-body">
            
               <input class="form-control" name="service_name">
              
             
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


