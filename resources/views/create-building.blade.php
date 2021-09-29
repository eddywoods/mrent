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
               <div id="smartwizard">
                  <ul class="forms-wizard">
                     <li>
                        <a href="#step-1">
                        <em>1</em><span>Building Information</span>
                        </a>
                     </li>
                     <li>
                        <a href="#step-2">
                        <em>2</em><span>Units Configuration</span>
                        </a>
                     </li>
                     <li>
                        <a href="#step-3">
                        <em>3</em><span>Finish</span>
                        </a>
                     </li>
                  </ul>
              
                  <div class="form-wizard-content">
                     
                     <div id="step-1">
                        <div class="row">
                           <div class="col col-6">
                              <div class="position-relative form-group">
                                 <label for="exampleEmail5">Building Name</label>
                                 <input type="text" class="form-control" name="building_name">
                              </div>
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
                              <div class="position-relative form-group">
                                 <label for="exampleEmail5">Account Number</label>
                                 <input type="text" class="form-control" name="account_name">
                              </div>
                              <div class="position-relative form-group">
                                  <label for="exampleEmail5">Account Name</label>
                                  <input type="text" class="form-control" name="account_number">
                               </div>
                              <div class="position-relative form-group">
                                 <label for="exampleEmail5">Contact Number</label>
                                 <input type="text" class="form-control" name="contact_number">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="step-2">
                        <div id="accordion" class="accordion-wrapper mb-3">
                           <div class="card">
                              <div id="headingOne" class="card-header">
                                 <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                    <span class="form-heading">
                                      
                                       <p>Configure The Units in the building</p>
                                    </span>
                                 </button>
                              </div>
                              <div data-parent="#accordion" id="collapseOne" aria-labelledby="headingOne" class="collapse show">
                                 <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div data-role="dynamic-fields">
                                                <div class="form-inline">
                                                    <div class="form-group">
                                                        
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
                                                        <label for="exampleEmail5">Number of Units</label>
                                                        <input type="text" class="form-control" id="field-value" name="unit_type[]" placeholder="e.g 10">
                                                    </div>
                                                     <span>-</span>
                                                    <div class="form-group">
                                                        <label for="exampleEmail5">Amount</label>
                                                        <input type="text" class="form-control" id="field-value" name="unit_type[]" placeholder="e.g 15000">
                                                    </div>
                                                    <span>-</span>
                                                    <div class="form-group">
                                                        <label for="exampleEmail5">Deposit</label>
                                                        <input type="text" class="form-control" id="field-value" name="unit_type[]" placeholder="e.g 15000">
                                                    </div>
                                                    <button class="btn btn-danger" data-role="remove">
                                                        <span class="fa fa-times"></span>
                                                    </button>
                                                    <button class="btn btn-primary" data-role="add">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>  <!-- /div.form-inline -->
                                            </div>  <!-- /div[data-role="dynamic-fields"] -->
                                        </div>  <!-- /div.col-md-12 -->
                                    </div>  <!-- /div.row -->
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div id="step-3">
                        <div class="no-results">
                           <div class="swal2-icon swal2-success swal2-animate-success-icon">
                              <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                              <span class="swal2-success-line-tip"></span>
                              <span class="swal2-success-line-long"></span>
                              <div class="swal2-success-ring"></div>
                              <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                              <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                           </div>
                           <div class="results-subtitle mt-4">Finished!</div>
                           <div class="results-title">You have completed your house setup!</div>
                           <div class="mt-3 mb-3"></div>
                           <div class="text-center">
                              <button class="btn-shadow btn-wide btn btn-success btn-lg" type="submit">Submit Details</button>
                           </div>
                        </div>
                     </div>
           
                  </div>
               </div>
               <div class="divider"></div>
               <div class="clearfix">
                  <button type="button" id="next-btn" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">Next</button>
                  <button type="button" id="prev-btn" class="btn-shadow float-right btn-wide btn-pill mr-3 btn btn-outline-secondary">Previous</button>
               </div>
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

    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
        function(e) {
            e.preventDefault();
            $(this).closest('.form-inline').remove();
        }
    );
    // Add button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
        function(e) {
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