@extends('layouts.landlord')
@section('content')
<div class="app-main__outer">
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-medal fa fa-building-o bg-sunny-morning">
               </i>
            </div>
            <div>All Buildings
            </div>
         </div>
         <div class="page-title-actions">
            <div class="d-inline-block dropdown">
               <a href="{{ url('/landlord/create-building') }}" class="btn-shadow btn btn-dark text-white">
               <span class="btn-icon-wrapper pr-2 opacity-7">
               <i class="fa fa-plus fa-w-20"></i>
               </span>
               Add New Building
               </a>
            </div>
         </div>
      </div>
   </div>
   <div class="main-card mb-3 card">
      <div class="card-body">
         @if (!$buildings->isEmpty())
         <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
            <thead>
               <tr>
                    <th></th>
                  <th>Building Name</th>
                  <th>Location</th>
                  <th>Contact Number</th>
                  <th>Invoicing Date</th>
                  <th>Account Number</th>
                  <th>Number Of Units</th>
                  <th>Created At</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($buildings as $b)
               <tr>
                   <td><a href="{{url('landlord/building-details', $b->id)}}">
                        <img src="/Documents/Photos/{{$b->photo[0]->image_url}}" class="media-photo">
                    </a></td>
                  <td><a href="{{url('landlord/building-details', $b->id)}}">{{$b->building_name }}</a></td>
                  <td>{{$b->location }}</td>
                  <td>{{$b->contact_number }}</td>
                  <td>{{$b->invoicing_date }}</td>
                  <td>{{$b->account_number }}</td>
                  <td>{{$b->number_of_units }}</td>
                  <td>{{$b->created_at }}</td>
                  <td class="text-center">
                     <div role="group" class="btn-group-sm btn-group">
                        <a href="{{url('landlord/building-details', $b->id)}}"><i class="text-success fas fa-eye"></i></a>
                     </div>
                  </td>
                  <td class="text-center">
                        <a href="/landlord/building/{{$b->id}}/edit"><i class="text-warning fas fa-pen"></i></a>
                  </td>
                  <td class="text-center">
                        <form method="POST" action="/landlord/building/{{$b->id}}">
                            @method('DELETE')
                            @csrf
                            <a class="" type="submit"><i class="text-danger fas fa-trash"></i></a>
                         </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         @else
         <div class="alert alert-warning" role="alert">
            No buildings added yet.
         </div>
         @endif
      </div>
   </div>
</div>
@endsection