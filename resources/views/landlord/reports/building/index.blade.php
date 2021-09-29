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
            <div>Building Reports
            </div>
         </div>
        
      </div>

      <div class="no-gutters row">
          <div class="col-md-6 col-xl-4">
              <div class="widget-content">
                  <div class="widget-content-wrapper">
                      <div class="widget-content-right ml-0 mr-3">
                          <div class="widget-numbers text-success">1896</div>
                      </div>
                      <div class="widget-content-left">
                          <div class="widget-heading">Total Buildings</div>
                          <div class="widget-subheading">All Houses</div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-4">
              <div class="widget-content">
                  <div class="widget-content-wrapper">
                      <div class="widget-content-right ml-0 mr-3">
                          <div class="widget-numbers text-warning">$ 14M</div>
                      </div>
                      <div class="widget-content-left">
                          <div class="widget-heading">Total Vacant Units</div>
                          <div class="widget-subheading">Total Vacant House Units</div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-xl-4">
              <div class="widget-content">
                  <div class="widget-content-wrapper">
                      <div class="widget-content-right ml-0 mr-3">
                          <div class="widget-numbers text-danger">45.9%</div>
                      </div>
                      <div class="widget-content-left">
                          <div class="widget-heading">Vacant Units From Next Month</div>
                          <div class="widget-subheading">House units with vacate notices</div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="d-xl-none d-md-block col-md-6 col-xl-4">
              <div class="widget-content">
                  <div class="widget-content-wrapper">
                      <div class="widget-content-right ml-0 mr-3">
                          <div class="widget-numbers text-danger">45.9%</div>
                      </div>
                      <div class="widget-content-left">
                          <div class="widget-heading">Followers</div>
                          <div class="widget-subheading">People Interested</div>
                      </div>
                  </div>
              </div>
          </div>
      </div>


   </div>
   
   <div class="main-card mb-3 card">
     
      <div class="card-body">
          <h4 class="card-title my-3"> Filter By Creation Date</h4>
          <div class="row">
              <div class="col-md-8">
              <form method="GET" action="">
                @csrf
                
                    <div class="row">
                        
                       <div class="col-md-4">
                             <div class="form-group">
                                <input type='text' class="form-control pickadate" id="picker_from" placeholder="From Date" name="from_date" autocomplete="off" value="{{ old('from_date') }}"/>
                             </div>
                          </div>
                       <div class="col-md-4">
                          <div class="form-group">
                              <input type='text' class="form-control pickadate" id="picker_to" placeholder="to Date" name="to_date" autocomplete="off" value="{{ old('to_date') }}"/>
                          </div>
                       </div>
                       
                       <div class="col-md-4">
                          <button type="submit" class="btn btn-lg text-white btn-info">Filter</button>
                       </div>
                    </div>
                 </form>
              </div>
           </div>
         @if (!$buildings->isEmpty())
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
@section('javascript')


@endsection