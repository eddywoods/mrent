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
                    Service Requests
                  
                </div>
             </div>
             <div class="page-title-actions">
               
              
             </div>
          </div>
       </div>
       <div class="main-card mb-3 card">
        <div class="card-body">

       <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
          <thead>
          <tr>
              <th>Request Title</th>
              <th>Building Name</th>
              <th>Unit Type</th>
              <th>Unit Number</th>
              <th>Created At</th>
              <th>Actions</th>
             
          </tr>
          </thead>
          <tbody>
              @if ($requests)
              @foreach ($requests as $t)
              <tr>
              <td>{{$t->request_title}}</td>
              <td>{{$t->building_name}}</td>
              <td>{{$t->unit_type_name}}</td>
               <td>{{$t->unit_number}}</td>
              <td>{{$t->created_at}}</td>
              <td class="text-center">
                  <div role="group" class="btn-group-sm btn-group">
                     <a href="{{url('agent/service-request-details', $t->serviceid)}}"><button class="btn-shadow btn btn-success"><i class="fas fa-eye"></i></button></a>
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

@endsection
