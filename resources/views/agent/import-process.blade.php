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

                        <div class="text-center my-5"><h5>Perform Bulk Upload Here</h5></div>
                        <form class="form-horizontal" method="POST" action="{{ url('landlord/tenant-bulk-upload') }}" enctype="multipart/form-data">
                            @csrf 
    
                            <div class="col-md-6 offset-xl-1 col-lg-6 offset-lg-1">
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
                            <div class="col-md-6 offset-xl-1 col-lg-6 offset-lg-1">
                                <input id="excel_file" type="file" class="form-control"  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="excel_file" required>
    
                                @if ($errors->has('csv_file'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('csv_file') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
    
    
                        <div class="form-group">
                            <div class="col-md-6 offset-xl-1 col-lg-6 offset-lg-1">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="header" checked> File contains header row?
                                    </label>
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <div class="col-md-8 offset-xl-1 col-lg-6 offset-lg-1">
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



  <div class="row">
         <div class="col-lg-12 col-md-12">
            <div class="main-card mb-3 card">
              
    <div class="card-body">
                @if($csv_data)
            <h5 style="text-decoration:underline">Preview Of First Two Rows</h5> <br>
                <form class="form-horizontal" method="POST" action="{{ url('landlord/process-import') }}">
                  @csrf
                 
                  <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
               
                   <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered table-responsive">
                      @if (isset($csv_header_fields))
                      <tr >
                          @foreach ($csv_header_fields as $csv_header_field)
                              <th>{{ $csv_header_field }}</th>
                          @endforeach
                      </tr>
                      @endif
                      @foreach ($csv_data as $row)
                          <tr>
                          @foreach ($row as $key => $value)
                              <td>{{ $value }}</td>
                          @endforeach
                          </tr>
                      @endforeach
                  <tr>
                   
                      @foreach ($csv_data[0] as $key => $value)
                          <td>
                              <select name="fields[{{ $key }}]">
                                  <option value="">Select Item..</option>
                                  @foreach (config('app.db_fields') as $db_field)
                                      <option value="{{ (\Request::has('header')) ? $db_field : $loop->index }}"
                                          @if ($key === $db_field) selected @endif>{{ $db_field }}</option>
                                  @endforeach
                              </select>
                          </td>
                      @endforeach
                  </tr>
              </table>

              <button type="submit" class="btn btn-sm btn-primary pull-right">
                  Upload Now 
              </button>
          </form>

          @endif
          </div>
         </div>
      </div>
   </div>


 </div>
</div>


@endsection
