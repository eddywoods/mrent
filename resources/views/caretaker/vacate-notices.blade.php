@extends('layouts.caretaker')
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
                    {{-- <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-vacate-modal-sm">
                        <i class="fa fa-plus"></i> Create Eviction Notice
                    </button>
                  --}}
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



@endsection


