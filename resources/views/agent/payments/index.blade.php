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
               <div>All Payments
               </div>
            </div>
            <div class="page-title-actions">
               <div class="d-inline-block dropdown">
                  <button type="button" class="btn mr-3 mb-2 btn-success" data-toggle="modal" data-target="#paymentModal">
                  Make Payment
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
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="paymentModalLabel">Make Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{url('receive-payment')}}" method="POST">
            @csrf
            <div class="modal-body">
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleSelect" class="">Select Tenant</label>
                     <select name="tenant_id" id="tenant_id" class="form-control" required>
                        <option value="">Select Tenant</option>
                        @if ($tenants) 
                        @foreach ($tenants as $u)
                        <option value="{{$u->tenantid}}">{{$u->first_name}} - {{$u->last_name}}</option>
                        @endforeach 
                        @endif
                     </select>
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="">Payment For</label>
                     <select name="payment_reason" class="form-control">
                        <option value="">Select Reason..</option>
                        <option value="rent">Rent</option>
                        <option value="deposit">Deposit</option>
                        <option value="bills">Bills</option>
                     </select>
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleSelect" class="">Select House Unit</label>
                     <select name="account" id="account" class="form-control" required>
                        <option value="">Select House Unit</option>
                        @if ($rentunits) @foreach ($rentunits as $u)
                        <option value="{{$u->account_number}}">{{$u->building_name}} - {{$u->label}}</option>
                        @endforeach @endif
                     </select>
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="">Payment Method</label>
                     <select name="payment_method" class="form-control">
                        <option value="">Select Method..</option>
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                        <option value="bank">Bank Slip</option>
                     </select>
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleEmail" class="">Amount</label>
                     <input name="amount"  placeholder="Amount" type="number" class="form-control">
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleEmail" class="">Reference Number (optional)</label>
                     <input name="transaction_number"  placeholder="Ref No" type="text" class="form-control">
                  </div>
               </div>
               <div class="col col-12">
                  <div class="position-relative form-group">
                     <label for="exampleEmail" class="">Payment Notes</label>
                     <textarea name="payment_description" id="paymentText" class="form-control"></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Complete Payment</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection