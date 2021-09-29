@extends('layouts.app')
@section('content')


<main id="ts-main" style="margin-top: 10%">
   <!--BREADCRUMB
            =========================================================================================================-->
            <section id="breadcrumb">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $house->building_name }}</li>
                        </ol>
                    </nav>
                </div>
            </section>
    
            <!--PAGE TITLE
                =========================================================================================================-->
            <section id="page-title">
                <div class="container">
    
                    <div class="d-block d-sm-flex justify-content-between">
    
                        <!--Title-->
                        <div class="ts-title mb-0">
                            <h1>{{ $house->building_name }}</h1>
                            <h5 class="ts-opacity__90">
                                <i class="fa fa-map-marker text-primary"></i>
                                {{ $house->location }}
                            </h5>
                        </div>
    
                        {{-- <!--Price-->
                        <h3>
                            <span class="badge badge-primary p-3 font-weight-normal ts-shadow__sm">$350,000</span>
                        </h3> --}}
    
                    </div>
    
                </div>
            </section>
    
            <!--CONTENT
                =========================================================================================================-->
            <section id="content">
                <div class="container">
                    <div class="row flex-wrap-reverse">
    
                        <!--LEFT SIDE
                            =============================================================================================-->
                        <div class="col-md-5 col-lg-4">
    
                            <!--DETAILS
                                =========================================================================================-->
                            <section>
                                <h3>Details</h3>
                                <div class="ts-box">
    
                                    <dl class="ts-description-list__line mb-0">
    
                                        <dt>ID:</dt>
                                    <dd>#{{$house->id}}</dd>
    
                                        <dt>Category:</dt>
                                        <dd>Apartments</dd>
    
                                        <dt>Status:</dt>
                                        <dd>Rent</dd>

                                        @if ($house->units)
                                        @foreach ($house->units as $unit)
                                        <dt>{{$unit->unit_type_name}}:</dt>
                                        <dd>Units: {{$unit->number_of_units}}</dd>
                                        <dd>Price: Ksh. {{$unit->unit_price}}</dd>
                                        @endforeach
                                            
                                        @endif
    
    
                                    </dl>
    
                                </div>
                            </section>
    
                            <!--LOCATION
                                =========================================================================================-->
                            <section id="location">
                                <h3>Location</h3>
    
                                <div class="ts-box p-0">
    
                                    <div class="ts-map ts-map__detail" id="ts-map-simple"
                                         data-ts-map-leaflet-provider="https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png"
                                         data-ts-map-zoom="12"
                                         data-ts-map-center-latitude="{{ $house->address_latitude }}"
                                         data-ts-map-center-longitude="{{ $house->address_longitude }}"
                                         data-ts-map-scroll-wheel="1"
                                         data-ts-map-controls="0"></div>
    
                                    <dl class="ts-description-list__line mb-0 p-4">
    
                                        <dt><i class="fa fa-map-marker ts-opacity__30 mr-2"></i>Address:</dt>
                                        <dd class="border-bottom pb-2">{{ $house->location }}</dd>
    
                                        <dt><i class="fa fa-phone-square ts-opacity__30 mr-2"></i>Phone:</dt>
                                        <dd class="border-bottom pb-2">{{ $house->contact_number }}</dd>
    
                                        
    
                                    </dl>
    
                                </div>
    
                            </section>
    
    
                        </div>
                        <!--end col-md-4-->
    
                        <!--RIGHT SIDE
                            =============================================================================================-->
                        <div class="col-md-7 col-lg-8">
    
                            <!--GALLERY CAROUSEL
                            =============================================================================================-->
                            <section id="gallery-carousel position-relative">
    
                                <h3>Gallery</h3>
    
                                <div class="owl-carousel ts-gallery-carousel" data-owl-auto-height="1" data-owl-dots="1" data-owl-loop="1">

                                  @if ($house->photos)
                                  @foreach ($house->photos as $photo)
                                      
                                    <!--Slide-->
                                    <div class="slide">
                                        <div class="ts-image" data-bg-image="/Documents/Photos/{{$photo->image_url}}">
                                            <a href="/Documents/Photos/{{$photo->image_url}}" class="ts-zoom popup-image"><i class="fa fa-search-plus"></i>Zoom</a>
                                        </div>
                                    </div>
                                  @endforeach
                                      
                                  @endif
  
    
                                </div>
    
                            </section>
    
                         
                           
    
                            <!--AMENITIES
                            =============================================================================================-->
                            <section id="amenities">
    
                                <h3>Amenities</h3>
    
                                <ul class="ts-list-colored-bullets ts-text-color-light ts-column-count-3 ts-column-count-md-2">
                                    <li>Air Conditioning</li>
                                    <li>Swimming Pool</li>
                                    <li>Central Heating</li>
                                    <li>Laundry Room</li>
                                    <li>Gym</li>
                                    <li>Alarm</li>
                                    <li>Window Covering</li>
                                    <li>Internet</li>
                                </ul>
    
                            </section>
    
                            <!--CONTACT THE AGENT
                            =============================================================================================-->
                            <section class="contact-the-agent">
                                <h3>Contact the Owner</h3>
    
                                <div class="ts-box">
                                    <div class="row">
    
                                        <!--Agent Image & Phone-->
                                        <div class="col-md-5">
                                            <div class="ts-center__vertical mb-4">
    
                                                <!--Image-->
                                                <a href="" class="ts-circle p-5 mr-4 ts-shadow__sm" data-bg-image="assets/img/img-person-05.jpg"></a>
    
                                                <!--Phone contact-->
                                                <figure class="mb-0">
                                                   
                                                    <p class="mb-0">
                                                        <i class="fa fa-phone-square ts-opacity__50 mr-2"></i>
                                                        {{$house->contact_number}}
                                                    </p>
                                                </figure>
    
                                            </div>
    
                                            <hr>
    
    
                                        </div>
    
                                     
    
                                    </div>
                                    <!--end row-->
                                </div>
                                <!--end ts-box-->
                            </section>
    
                        </div>
                        <!--end col-md-8-->
    
                    </div>
                    <!--end row-->
                </div>
                <!--end container-->
            </section>
            
    
</main>

@endsection