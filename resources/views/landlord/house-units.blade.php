@extends('layouts.landlord')
@section('content')
<div class="app-main__outer">

   <div class="app-main__inner">

      <div class="app-page-title">
         <div class="page-title-wrapper">
            <div class="page-title-heading">
               <div class="page-title-icon">
                  <i class="pe-7s-phone icon-gradient bg-premium-dark">
                  </i>
               </div>
               <div>
                  All House Units
               </div>
            </div>
         </div>
      </div>
      <div class="main-card mb-3 card">
         <div class="card-body">
            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
               <thead>
                  <tr>
                     <th>Building Name</th>
                     <th>Unit Name</th>
                     <th>No. of Units</th>
                     <th>Unit Price</th>
                     <th>Unit Deposit</th>

                    
                  </tr>
               </thead>
               <tbody>
                  @if ($houseunits)
                  @foreach ($houseunits as $h)
                  <tr>
                     <td>{{$h->building_name}}</td>
                     <td>{{$h->unit_type_name}}</td>
                     <td>{{$h->number_of_units}}</td>
                     <td>{{$h->unit_price}}</td>
                     <td>{{$h->unit_deposit}}</td>
                   
                   
                    
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
@section('javascript')

@endsection