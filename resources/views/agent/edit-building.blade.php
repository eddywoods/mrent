@extends('layouts.agent')
@section('content')
<div class="app-main__outer">
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
   <div class="app-main__inner">
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <div class="app-page-title">
         <div class="page-title-wrapper">
            <div class="page-title-heading">
               <div class="page-title-icon">
                  <i class="lnr-map text-info">
                  </i>
               </div>
               <div>
                  Edit {{$building->building_name}}
               </div>
            </div>
         </div>
      </div>
      <div class="tab-content">
         <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
            <div class="row">
               <div class="col-lg-12 col-md-12">
                  <div class="main-card mb-3 card">
                     <div class="row">
                        <div class="col-md-10 offset-md-1 shadow p-3 mb-5 bg-white rounded">
                           <div class="card-header">
                              Edit {{$building->building_name}}
                           </div>
                           <div class="card-body">
                              <form action="/agent/building/{{ $building->id }}" method="POST" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                 <div class="row">
                                    <div class="col col-6">
                                       <div class="position-relative form-group">
                                          <label for="exampleEmail5">Building Name</label>
                                          <input type="text" class="form-control" name="building_name" value="{{ $building->building_name }}" >
                                       </div>
                                    </div>
                                    <div class="col col-6">
                                       <div class="position-relative form-group">
                                          <label for="exampleEmail5">Building Location</label>
                                          <input type="text" class="form-control" name="mapSearchInput" id="pac-input" value="{{ $building->location }}" >
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
                                                <div class="date" id="datetimepicker2">
                                                   <label for="exampleEmail5">Invoicing Date</label>
                                                  <input type="text" class="form-control"  name="invoicing_date" autocomplete="off" value="{{ $building->invoicing_date }}" ><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                                </div>
                                            </div>

                                    </div>
                                  
                                    <div class="col col-4">
                                       <div class="position-relative form-group">
                                          <label for="exampleEmail5">Contact Number</label>
                                          <input type="text" class="form-control" name="contact_number" value="{{ $building->contact_number }}" >
                                       </div>
                                    </div>
                                   
                                 </div>

                                 <div style="padding: 20px; margin-left: 50%">
                                    <button class="btn-shadow btn-sm btn btn-warning btn-lg pull-right text-white" type="submit">Update Building</button>
                                 </div>

                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

@endsection
@section('javascript')
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
<script type="text/javascript">
   $(document).ready(function(){
       $('#datetimepicker2').datepicker({
          weekStart: 0,
          todayBtn: "linked",
          language: "en",
          orientation: "bottom auto",
          keyboardNavigation: false,
          autoclose: true
      });



   });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQHKNtgQRTyvCg0xHqKDt35FgF7SHdqhM&callback=myMap&libraries=places"></script>
@endsection