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
                     <div class="row">
                        <div class="col-md-12 shadow p-3 mb-5 bg-white rounded">
                           <div class="card-header">
                              Configure New Building
                           </div>
                           <div class="card-body">
                              <form action="{{ url('agent/create-building') }}" method="POST" enctype="multipart/form-data">
                                 @csrf
                                 <div class="row">
                                    <div class="col col-6">
                                       <div class="position-relative form-group">
                                          <label for="exampleEmail5">Building Name</label>
                                          <input type="text" class="form-control" name="building_name" value="{{ old('building_name') }}" required>
                                       </div>
                                    </div>
                                    <div class="col col-6">
                                       <div class="position-relative form-group">
                                          <label for="exampleEmail5">Building Location</label>
                                          <input type="text" class="form-control" name="mapSearchInput" id="pac-input" value="{{ old('mapSearchInput') }}" required>
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
                                                  <input type="text" class="form-control"  name="invoicing_date" autocomplete="off" value="{{ old('invoicing_date') }}" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="exampleEmail5">Commission Value (percentage)</label>
                                             <input type="text" class="form-control" name="commission_value" value="{{ old('commission_value') }}" placeholder="e.g 5" required>
                                          </div>
                                       </div>
                                    <div class="col col-6">
                                       <div class="position-relative form-group">
                                          <label for="exampleEmail5">Account Type</label>
                                          <select name="bank_id" class="form-control" required>
                                             <option value="">Select Bank..</option>
                                             @if($banks)
                                             @foreach ($banks as $b)
                                             <option value="{{$b->bank_id}}">{{ $b->bank_name }}</option>
                                             @endforeach
                                             @endif
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col col-6">
                                       <div class="position-relative form-group">
                                          <label for="exampleEmail5">Account Name</label>
                                          <input type="text" class="form-control" name="account_name" value="{{ old('account_name') }}" required>
                                       </div>
                                    </div>
                                    <div class="col col-6">
                                       <div class="position-relative form-group">
                                          <label for="exampleEmail5">Account Number</label>
                                          <input type="text" class="form-control" name="account_number" value="{{ old('account_number') }}" required>
                                       </div>
                                    </div>
                                    <div class="col col-6">
                                       <div class="position-relative form-group">
                                          <label for="exampleEmail5">Contact Number</label>
                                          <input type="text" class="form-control" name="contact_number" value="{{ old('contact_number') }}" required>
                                       </div>
                                    </div>
                                    <div class="col col-6 mt-5">
                                       <div class="position-relative form-group">
                                          <label for="exampleEmail5">Upload Building Main Photo: </label>
                                          <input class="btn btn-warning" name="image" type="file">
                                       </div>
                                    </div>

                                    <div class="col col-6">
                                          <div class="position-relative form-group">
                                             <label for="exampleEmail5">Select Landlord (Optional)</label>
                                             <select name="owned_by" class="form-control">
                                                <option value="">Select Landlord..</option>
                                                @if($landlords)
                                                @foreach ($landlords as $l)
                                                <option value="{{$l->userid}}">{{ $l->first_name }} {{ $l->last_name }}</option>
                                                @endforeach
                                                @endif
                                             </select>
                                          </div>
                                       </div>



                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                     
                                             <p>Configure Units</p>
                                         
                                       
                                             <div>
                                                <label style="padding-right: 80px">
                                                   <input type="radio" name="grouping_type" id="groupRadio" value="group"> Add By Grouping
                                                </label>
                                                <label style="padding-right: 80px">
                                                   <input type="radio" name="grouping_type" id="groupRadio" value="one"> Add By Unit
                                                </label>
                                             </div>
                                             <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                   <div id="configure">
                                                      <div class="groupAppend">
                                                         <div class="group box">
                                                            <div data-role="dynamic-fields">
                                                               <div class="row">

                                                                  <div class="col col-12 my-3">
                                                                        <div class="position-relative form-group">
                                                                           <label for="exampleEmail5">Upload Units CSV </label>
                                                                           <input class="btn btn-warning" name="units_file" type="file">
                                                                        </div>
                                                                     </div>
                                                                     <span>
                                                                        <a href="/Documents/Building/samplecsv.csv" download="samplecsv.csv">download sample csv</a>
                                                                        </span>
                                                            
                                                               </div>
                                                            </div>
                                                          
                                                         </div>
                                                         
                                                      </div>
                                                      <div class="oneAppend">
                                                         <div class="one box">
                                                            <div data-role="dynamic-fields2">
                                                               <div class="row">
                                                                  <div class="col col-2">
                                                                     <div class="position-relative form-group">
                                                                        <label for="exampleEmail5">Unit  Type</label>
                                                                        <select name="unit_type[]" class="form-control">
                                                                           <option value="">Select Room Type..</option>
                                                                           @if($units)
                                                                           @foreach ($units as $u)
                                                                           <option value="{{$u->id}}">{{ $u->unit_type_name }}</option>
                                                                           @endforeach
                                                                           @endif
                                                                        </select>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col col-2">
                                                                     <div class="position-relative form-group">
                                                                        <label for="exampleEmail5">Rental Amount</label>
                                                                        <input type="number" class="form-control" id="field-value" name="unit_type[]" placeholder="e.g 15000">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col col-2">
                                                                     <div class="position-relative form-group">
                                                                        <label for="exampleEmail5">Deposit Amount</label>
                                                                        <input type="number" class="form-control" id="field-value" name="unit_type[]" placeholder="e.g 15000">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col col-2">
                                                                     <div class="position-relative form-group">
                                                                        <label for="exampleEmail5">Unit Number</label>
                                                                        <input type="text" class="form-control" id="field-value" name="unit_type[]" placeholder="e.g B4">
                                                                     </div>
                                                                  </div>
                                                                  <div class="col col-2">
                                                                     <label for="exampleEmail5">Actions</label>
                                                                     <div class="position-relative form-group">
                                                                        <button class="btn btn-danger" data-role="remove">
                                                                        <span class="fa fa-times"></span>
                                                                        </button>
                                                                        <button class="btn btn-primary" data-role="add">
                                                                        <span class="fa fa-plus"></span>
                                                                        </button>
                                                                     </div>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                            <a data-toggle="modal" data-target="#typesModal" class="text-info" style="padding-left: 20px">
                                                                  Add Unit Type
                                                            </a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                            
                                         
                                    </div>
                                    <!-- /div.row -->
                                    <div style="padding: 20px; margin-left: 70%">
                                       <button class="btn-shadow btn-wide btn btn-warning text-white btn-lg pull-right" type="submit">Create Building</button>
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
      </div>
   </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="typesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Unit Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{url('landlord/add-unit-type')}}" method="POST">
            <div class="modal-body">
               @csrf
               <input class="form-control" name="unit_type_name">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
   $(document).ready(function () {
   
       $(document).on('click','[data-role="dynamic-fields"] > .row [data-role="remove"]',function(e) {
               e.preventDefault();
               $(this).closest('.row').remove();
           }
       );
       // Add button click
       $(document).on('click','[data-role="dynamic-fields"] > .row [data-role="add"]',function(e) {
               e.preventDefault();
               var container = $(this).closest('[data-role="dynamic-fields"]');
               new_field_group = container.children().filter('.row:first-child').clone();
               new_field_group.find('input').each(function(){
                   $(this).val('');
               });
               container.append(new_field_group);
           }
       );
   
   
       $(document).on('click','[data-role="dynamic-fields2"] > .row [data-role="remove"]',function(e) {
               e.preventDefault();
               $(this).closest('.row').remove();
           }
       );
       // Add button click
       $(document).on('click','[data-role="dynamic-fields2"] > .row [data-role="add"]',function(e) {
               e.preventDefault();
               var container = $(this).closest('[data-role="dynamic-fields2"]');
               new_field_group = container.children().filter('.row:first-child').clone();
               new_field_group.find('input').each(function(){
                   $(this).val('');
               });
               container.append(new_field_group);
           }
       );
   
   
   
   });
   
</script>
<script>
   $(document).ready(function () {
       var group =  $('.group');
       var one =  $('.one');
   
   $('input[type=radio]').click(function(e){
       var c = $('input[name=grouping_type]:checked').val();
       if (c == 'group') {
       $('.groupAppend').append(group);
       $('.one').detach();
       } else if(c == 'one') {
       $('.group').detach();
       $('.oneAppend').append(one);
       }
       });
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
<script type="text/javascript">
   $(document).ready(function(){
     $('#configure').hide();
       $('input[type="radio"]').click(function(){
           var inputValue = $(this).attr("value");
           var targetBox = $("." + inputValue);
           $(".box").not(targetBox).hide();
           $('#configure').show();
           $(targetBox).show();
       });

       var date = new Date();
       $('#datetimepicker2').datepicker({
          minDate: 0,
          startDate: date,
          minTime: 0, 
          weekStart: 0,
          todayBtn: "linked",
          language: "en",
          orientation: "bottom auto",
          keyboardNavigation: false,
          autoclose: true,
          todayHighlight: true

      });



   });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQHKNtgQRTyvCg0xHqKDt35FgF7SHdqhM&callback=myMap&libraries=places"></script>
@endsection