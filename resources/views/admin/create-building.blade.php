@extends('layouts.admin')
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
            Configure a new Building
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
                  <form action="{{url('create-building')}}" method="POST">
                     @csrf
                     <div class="row">
                        <div class="col col-6">
                           <div class="position-relative form-group">
                              <label for="exampleEmail5">Building Name</label>
                              <input type="text" class="form-control" name="building_name">
                           </div>
                        </div>
                        <div class="col col-6">
                           <div class="position-relative form-group">
                              <label for="exampleEmail5">Building Location</label>
                              <input type="text" class="form-control" name="mapSearchInput" id="pac-input">
                           </div>
                           <input id="lat" type="hidden" name="lat" class="form-control col-md-7 col-xs-12">
                           <input id="long" type="hidden" name="long" class="form-control col-md-7 col-xs-12">
                           <div id="map"></div>
                           <div id="infowindow-content">
                              <span id="place-name"  class="title"></span><br>
                              <span id="place-address"></span>
                           </div>
                        </div>
                        <div class="col col-6">
                           <div class="position-relative form-group">
                              <label for="exampleEmail5">Invoicing Date</label>
                              <input type="text" class="form-control" data-toggle="datepicker" name="invoicing_date">
                           </div>
                        </div>
                        <div class="col col-6">
                           <div class="position-relative form-group">
                              <label for="exampleEmail5">Account Type</label>
                              <select name="bank_id" class="form-control">
                                 <option value="">Select Bank..</option>
                                 @if($banks)
                                 @foreach ($banks as $b)
                                 <option value="{{$b->bank_id}}">{{ $b->bank_name }}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        <div class="col col-4">
                           <div class="position-relative form-group">
                              <label for="exampleEmail5">Account Name</label>
                              <input type="text" class="form-control" name="account_name">
                           </div>
                        </div>
                        <div class="col col-4">
                           <div class="position-relative form-group">
                              <label for="exampleEmail5">Account Number</label>
                              <input type="text" class="form-control" name="account_number">
                           </div>
                        </div>
                        <div class="col col-4">
                           <div class="position-relative form-group">
                              <label for="exampleEmail5">Contact Number</label>
                              <input type="text" class="form-control" name="contact_number">
                           </div>
                        </div>
                     </div>

                           <div class="row">
                               <div class="col-md-12">
                                  <div class="card">
                                       <div class="card-header">
                                             <p>Configure Units</p>
                                          </div>
                                  
                                      <div class="card-body">
                                          <div data-role="dynamic-fields">
                                       <div class="form-inline">
                                           <div class="form-group">
                                               <label class="sr-only" for="field-name">Field Name</label>
                                               <select name="unit_type[]" class="form-control" name="bank_name">
                                                   <option value="">Select Room Type..</option>
                                                   @if($units)
                                                   @foreach ($units as $u)
                                                   <option value="{{$u->id}}">{{ $u->unit_type_name }}</option>
                                                   @endforeach
                                                   @endif
                                                </select>
                                           </div>
                                           <span>-</span>
                                           <div class="form-group">
                                               <label class="sr-only" for="field-value">Field Value</label>
                                               <input type="text" class="form-control" id="field-value" name="unit_type[]" placeholder="e.g 10">
                                           </div>
                                           <span>-</span>
                                           <div class="form-group">
                                               <label class="sr-only" for="field-value">Field Value</label>
                                               <input type="text" class="form-control" id="field-value" name="unit_type[]" placeholder="e.g 15000">
                                           </div>
                                           <span>-</span>
                                           <div class="form-group">
                                               <label class="sr-only" for="field-value">Field Value</label>
                                               <input type="text" class="form-control" id="field-value" name="unit_type[]" placeholder="e.g 15000">
                                           </div>
                                           <button class="btn btn-danger" data-role="remove">
                                               <span class="fa fa-times"></span>
                                           </button>
                                           <button class="btn btn-primary" data-role="add">
                                               <span class="fa fa-plus"></span>
                                           </button>
                                       </div>  <!-- /div.form-inline -->
                                   </div>  <!-- /div[data-role="dynamic-fields"] -->
                               </div>  <!-- /div.col-md-12 -->
                           </div>  <!-- /div.row -->
                     </div>  <!-- /div.col-md-12 -->
                  </div>
                  </div>
                  </div>  <!-- /div.row -->
                  <button class="btn-shadow btn-wide btn btn-success btn-lg pull-right" type="submit">Submit Details</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
   $(document).ready(function () {
   
       $(document).on('click','[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',function(e) {
               e.preventDefault();
               $(this).closest('.form-inline').remove();
           }
       );
       // Add button click
       $(document).on('click','[data-role="dynamic-fields"] > .form-inline [data-role="add"]',function(e) {
               e.preventDefault();
               var container = $(this).closest('[data-role="dynamic-fields"]');
               new_field_group = container.children().filter('.form-inline:first-child').clone();
               new_field_group.find('input').each(function(){
                   $(this).val('');
               });
               container.append(new_field_group);
           }
       );
   });
   
</script>
<script>
   function myMap() {
           var map = new google.maps.Map(document.getElementById('map'), {
             center: {lat: -33.8688, lng: 151.2195},
             zoom: 13
           });
   
           var options = {
             types: ['(cities)'],
             componentRestrictions: {country: "ke"}
           };
   
           var input = document.getElementById('pac-input');
   
   
           var autocomplete = new google.maps.places.Autocomplete(input);
   
         
           autocomplete.bindTo('bounds', map);
   
           // Set the data fields to return when the user selects a place.
           autocomplete.setFields(
               ['address_components', 'geometry', 'icon', 'name']);
   
      
   
           autocomplete.addListener('place_changed', function() {
            
             var place = autocomplete.getPlace();
             if (!place.geometry) {
               return;
             }
   
             document.getElementById('lat').value = place.geometry.location.lat();
             document.getElementById('long').value = place.geometry.location.lng();
   
             var address = '';
             if (place.address_components) {
               address = [
                 (place.address_components[0] && place.address_components[0].short_name || ''),
                 (place.address_components[1] && place.address_components[1].short_name || ''),
                 (place.address_components[2] && place.address_components[2].short_name || '')
               ].join(' ');
   
               console.log(place.geometry.location.lat());
             }
   
           });
   
         
   
          
   
         
         }
   
   
   
   
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQHKNtgQRTyvCg0xHqKDt35FgF7SHdqhM&callback=myMap&libraries=places"></script>
@endsection