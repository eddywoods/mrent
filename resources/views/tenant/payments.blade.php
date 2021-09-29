@extends('layouts.tenant')
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
                  <div>My Payments
        
                  </div>
              </div>
              <div class="page-title-actions">
                 
                  {{-- <div class="d-inline-block dropdown">
                    <a href="{{ url('/landlord/create-building') }}" class="btn-shadow btn btn-info">
                          <span class="btn-icon-wrapper pr-2 opacity-7">
                              <i class="fa fa-plus fa-w-20"></i>
                          </span>
                          Add New Building
                      </a>
                   
                  </div> --}}
              </div>   
             </div>
      </div>            
      <div class="main-card mb-3 card">
          <div class="card-body">
              <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                  <thead>
                  <tr>
                     <th>Name</th>
                     <th>Phone Number</th>
                     <th>ID Number</th>
                     <th>Payment Reason</th>
                     <th>Payment Method</th>
                     <th>Amount</th>
                     <th>Note</th>
                     <th>Created At</th>
                     
                  </tr>
                  </thead>
                  <tbody>
                        @if($payments)
                        @foreach ($payments as $p)
                     <tr>
                     <td>{{ $p->first_name }} {{ $p->last_name }} </td>
                     <td>{{ $p->phone_number }}</td>
                     <td>{{ $p->id_number }}</td>
                     <td>{{ $p->payment_reason }}</td>
                     <td>{{ $p->payment_method }}</td>
                     <td>{{ $p->amount }}</td>
                     <td>{{ $p->payment_description }}</td>
                     <td>{{ $p->created_at }}</td>
                     </tr>
                     @endforeach
                     @endif
            
                  </tbody>
               
            </table>
          </div>
      </div>
  </div>

@endsection