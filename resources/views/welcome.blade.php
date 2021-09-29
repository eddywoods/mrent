@extends('layouts.app')

@section('content')

   
    <!-- HERO MAP
    =================================================================================================================-->
    <section id="ts-hero" class="mb-0">

            <!--Fullscreen mode-->
            <div class="ts-full-screen d-flex">
    
                <!-- MAP
                =========================================================================================================-->
                <div class="ts-map w-100 ts-z-index__1" id="content-desktop">
                    <div id="ts-map-hero" class="h-100 ts-z-index__1"
                         data-ts-map-leaflet-provider="https://{s}.tile.openstreetmap.se/hydda/full/{z}/{x}/{y}.png"
                         data-ts-map-leaflet-attribution="&copy; <a href='http://www.openstreetmap.org/copyright'>OpenStreetMap</a> &copy; <a href='http://cartodb.com/attributions'>CartoDB</a>"
                         data-ts-map-zoom-position="topleft"
                         data-ts-map-scroll-wheel="0"
                         data-ts-map-zoom="11"
                         data-ts-map-center-latitude="-1.28333"
                         data-ts-map-center-longitude="36.81667"
                         data-ts-locale="en-KE"
                         data-ts-currency="KES"
                         data-ts-unit="m<sup>2</sup>"
                         data-ts-display-additional-info="area_Area;bedrooms_Bedrooms;bathrooms_Bathrooms"
                    >
                    </div>
                </div>
    
                <!-- RESULTS
                =========================================================================================================-->
                <div class="ts-results__vertical ts-results__grid ts-shadow__sm w-100 h-100 scrollbar-inner bg-white ts-z-index__2" >
    
                    <!-- FORM
                    =====================================================================================================-->
                    <section class="ts-form__grid">
    
                        <!--Title-->
                        <h4 class="font-weight-normal ts-text-color-light">Property Search Filter</h4>
    
                        <!--Form-->
                        <form class="ts-form ts-box mb-0 shadow p-3 bg-white rounded">
                            <div class="form-row">
    
                                <!--Keyword-->
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Town or estate ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="bedrooms" name="bedrooms" min="0" placeholder="Bedrooms" >
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="input-group mb-6">
                                        <input type="text" class="form-control border-right-0" id="min-price" placeholder="Min Price">
                                        
                                    </div>
                                </div>
    
                                <!--Max Price-->
                                <div class="col-sm-6">
                                    <div class="input-group mb-6">
                                        <input type="text" class="form-control border-right-0" id="max-price" placeholder="Max Price">
                                        
                                    </div>
                                </div>
    
                            </div>
    
    
                            <div class="ts-center__vertical justify-content-between">
                                <!--More Options Button-->
                                <a href="#more-options-collapse" class="collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="more-options-collapse">
                                    <i class="fa fa-plus-circle ts-text-color-primary mr-2 ts-visible-on-collapsed"></i>
                                    <i class="fa fa-minus-circle ts-text-color-primary mr-2 ts-visible-on-uncollapsed"></i>
                                    More Options
                                </a>
    
                                <!--Submit button-->
                                <div class="form-group mb-0">
                                <button class="btn btn-primary w-100" id="search-btn"><a class="text-white" href="{{ url('property-listings') }}">Search</a></button>
                                </div>
    
                            </div>
    
                            <!--Hidden Form-->
                            <div class="collapse" id="more-options-collapse">
    
                                <!--Padding-->
                                <div class="pt-4">
    
                                    <!--Row-->
                                    <div class="form-row">
    
                                     
    
                                    </div>
                                    <!--end row-->
    
                                    <!--Checkboxes-->
                                    <div id="features-checkboxes" class="w-100">
                                        <h6 class="mb-3">Features</h6>
    
                                        <div class="ts-column-count-3">
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_1" name="features[]" value="ch_1">
                                                <label class="custom-control-label" for="ch_1">Air conditioning</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_2" name="features[]" value="ch_2">
                                                <label class="custom-control-label" for="ch_2">Bedding</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_3" name="features[]" value="ch_3">
                                                <label class="custom-control-label" for="ch_3">Heating</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_4" name="features[]" value="ch_4">
                                                <label class="custom-control-label" for="ch_4">Internet</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_5" name="features[]" value="ch_5">
                                                <label class="custom-control-label" for="ch_5">Microwave</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_6" name="features[]" value="ch_6">
                                                <label class="custom-control-label" for="ch_6">Smoking
                                                    allowed</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_7" name="features[]" value="ch_7">
                                                <label class="custom-control-label" for="ch_7">Terrace</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_8" name="features[]" value="ch_8">
                                                <label class="custom-control-label" for="ch_8">Balcony</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_9" name="features[]" value="ch_9">
                                                <label class="custom-control-label" for="ch_9">Iron</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_10" name="features[]" value="ch_10">
                                                <label class="custom-control-label" for="ch_10">Hi-Fi</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_11" name="features[]" value="ch_11">
                                                <label class="custom-control-label" for="ch_11">Beach</label>
                                            </div>
    
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="ch_12" name="features[]" value="ch_12">
                                                <label class="custom-control-label" for="ch_12">Parking</label>
                                            </div>
    
                                        </div>
                                        <!--end ts-column-count-3-->
    
                                    </div>
                                    <!--end #features-checkboxes-->
    
                                </div>
                                <!--end Padding-->
                            </div>
                            <!--end more-options-collapse-->
                        </form>
                        <!--end ts-form-->
                    </section>
                    <!--end ts-form__grid-->
    
                    <!-- TITLE and CONTROLS
                    =====================================================================================================-->
    
                    <section class="ts-center__vertical justify-content-between px-4 pt-3 pb-0">
                        <h4 class="font-weight-normal ts-text-color-light mb-0">28 Properties Found</h4>
    
                        <div id="display-control" class="d-none d-md-block">
    
                            <a href="#" class="btn btn-outline-secondary active px-3 mr-2 mb-2 ts-btn-border-muted">
                                <i class="fa fa-th-large"></i>
                            </a>
                           
                        </div>

                      
    
                    </section>
    
                    <!-- RESULTS
                    =====================================================================================================-->
                    <section id="ts-results" class="h-100">

                        <div class="ts-results-wrapper">
                           
                            
                        </div>


                    </section>
    
                </div>
                <!--end ts-results-vertical-->
    
            </div>
            <!--end full-screen-->
    
        </section>

           
        </main>
        
@endsection
