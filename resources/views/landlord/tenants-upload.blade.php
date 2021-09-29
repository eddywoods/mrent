@extends('layouts.landlord')
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
            <i class="lnr-map text-info">
            </i>
         </div>
         <div>
            Upload Tenants From CSV
         </div>
      </div>
   </div>
</div>
<div class="tab-content">
   <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
      <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="main-card mb-3 card">
               <div class="card-body">
                    <div class="row">
                            <div class="col-md-8 offset-md-3 shadow p-3 mb-5 bg-white rounded">
                 <div class="text-center my-5"><h5>Perform Bulk Upload Here</h5></div>
                  <form class="form-horizontal" method="POST" action="{{ url('landlord/tenant-bulk-upload') }}" enctype="multipart/form-data">
                        @csrf 

                        <div class="col-md-6">
                              <div class="position-relative form-group">
                                  <label for="exampleSelect" class="">Select Building</label>
                                  <select name="building_id" id="building" class="form-control">
                                    <option value="">Select Building</option>
                                    @if ($buildings)
                                    @foreach ($buildings as $b)
                                  <option value="{{$b->id}}">{{$b->building_name}}</option>
                                    @endforeach
                                    @endif
                                  </select>
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                        <div class="col-md-6">
                            <input id="excel_file" type="file" class="form-control"  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="excel_file" required>

                            @if ($errors->has('csv_file'))
                                <span class="help-block">
                                <strong>{{ $errors->first('csv_file') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="header" checked> File contains header row?
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary btn-block">
                                Load File..
                            </button>
                        </div>
                    </div>
                </form>
                            </div>
                    </div>
                  
            </div>
         </div>
      </div>
   </div>



</div>
@endsection
