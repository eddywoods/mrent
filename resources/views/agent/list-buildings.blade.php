@extends('layouts.agent')
@section('content')

<div class="app-main__outer">
  <div class="app-main__inner">
      <div class="app-page-title">
          <div class="page-title-wrapper">
              <div class="page-title-heading">
                  <div class="page-title-icon">
                      <i class="pe-7s-medal icon-gradient bg-tempting-azure">
                      </i>
                  </div>
                  <div>All Buildings
        
                  </div>
              </div>
              <div class="page-title-actions">
                 
                  <div class="d-inline-block dropdown">
                    <a href="{{ url('/agent/create-building') }}" class="btn-shadow btn btn-dark">
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
                @if ($buildings)
              <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                  <thead>
                  <tr>
                      <th>Building Name</th>
                      <th>Location</th>
                      <th>Contact Number</th>
                      <th>Invoicing Date</th>
                      <th>Account Number</th>
                      <th>Number Of Units</th>
                      <th>Created At</th>
                      <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   
                    
                    @foreach ($buildings as $b)
                  <tr>
                  <td>{{$b->building_name }}</td>
                  <td>{{$b->location }}</td>
                  <td>{{$b->contact_number }}</td>
                  <td>{{$b->invoicing_date }}</td>
                  <td>{{$b->account_number }}</td>
                  <td>{{$b->number_of_units }}</td>
                  <td>{{$b->created_at }}</td>
                  <td class="text-center">
                    <div role="group" class="btn-group-sm btn-group">
                        <a href="{{url('agent/building-details', $b->id)}}"><button class="btn-shadow btn btn-success"><i class="fas fa-eye"></i></button></a>
                    <a href="/agent/building/{{$b->id}}/edit"><button class="btn-shadow btn btn-primary"><i class="fas fa-pen"></i></button></a>
                        <form method="POST" action="/agent/building/{{$b->id}}">
                          @method('DELETE')
                          @csrf
                          <button class="btn-shadow btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                      </form>
                        
                    </div>
                  </td>
                  </tr>
                  @endforeach
                 
                  </tbody>
                
              </table>
              @else
              <h3>No Buildings Available Yet</h3>
              @endif
          </div>
      </div>
  </div>

@endsection