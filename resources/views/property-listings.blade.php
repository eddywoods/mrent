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
                  <li class="breadcrumb-item active" aria-current="page">Property Listings</li>
              </ol>
          </nav>
      </div>
  </section>

  <!--PAGE TITLE
      =========================================================================================================-->
  <section id="page-title">
      <div class="container">

          <div class="ts-title">
              <h1>Property Listings</h1>
              <h5>All Property Listings</h5>
          </div>

      </div>
  </section>

  <!--ITEMS AND SIDEBAR
      =========================================================================================================-->
  <section id="items-grid-and-sidebar">
      <div class="container">
          <div class="row flex-wrap-reverse">

              <!--LEFT SIDE (ITEMS)
                  =============================================================================================-->
              <div class="col-md-8">

                  <!--DISPLAY CONTROL
                      =========================================================================================-->
                  <section id="display-control" class="clearfix">

                      <!--Display selector on the left-->
                      <div class="float-left">
                          <a href="#" class="btn btn-outline-secondary px-3 mr-2 mb-2 ts-btn-border-muted">
                              <i class="fa fa-th-large"></i>
                          </a>
                          <a href="#" class="btn btn-outline-secondary active px-3 mb-2 ts-btn-border-muted">
                              <i class="fa fa-th-list"></i>
                          </a>
                      </div>

                      <!--Display selector on the right-->
                      <div class="float-none float-sm-right pl-2 ts-center__vertical">
                          <label for="sorting" class="mb-0 mr-2 text-nowrap">Sort by:</label>
                          <select class="custom-select bg-transparent" id="sorting" name="sorting">
                              <option value="">Default</option>
                              <option value="1">Price lowest first</option>
                              <option value="2">Price highest first</option>
                              <option value="3">Distance</option>
                          </select>
                      </div>

                  </section>

                  <!--ITEMS LIST
                      =========================================================================================-->
                  <section id="ts-items-list">

                    @if ($houses)

                    @foreach ($houses as $house)

                      <!--Item-->
                  <a href="{{ route('moreinfo', $house->id)}}" class="card ts-item ts-item__list ts-item__compact ts-item__compact ts-card">

                          <!--Ribbon-->
                          <div class="badge badge-primary">Rent</div>

                          <!--Card Image-->
                        <div class="card-img" data-bg-image="{{$house->imageB}}"></div>

                          <!--Card Body-->
                          <div class="card-body">

                              <figure class="ts-item__info">
                              <h4>{{ $house->building_name }}</h4>
                                  <aside>
                                      <i class="fa fa-map-marker mr-2"></i>
                                      {{ $house->location }}
                                  </aside>
                              </figure>
{{-- 
                              <div class="ts-item__info-badge">
                                  $350,000
                              </div> --}}

                              <div class="ts-description-lists">
                                @if ($house->pricing)
                                @foreach ($house->pricing as $pricing)
                                <dl>
                                <dt>{{$pricing->unit_type_name}}</dt>
                                <dd>Ksh. {{$pricing->unit_price}}</dd>
                                </dl>
                               
                                @endforeach
                                    
                                @endif
                                 
                              </div>
                          </div>

                          <!--Card Footer-->
                          <div class="card-footer">
                              <span class="ts-btn-arrow">Detail</span>
                          </div>

                      </a>
                        
                    @endforeach
                        
                    @endif

   

                  </section>
                  <!--end row-->

                  <!--PAGINATION
                      =========================================================================================-->
                  <section id="pagination">
                      <div class="container">

                          <!--Pagination-->
                          <nav aria-label="Page navigation">
                              <ul class="pagination ts-center__horizontal">
                                  <li class="page-item active">
                                      <a class="page-link" href="#">1</a>
                                  </li>
                                  <li class="page-item">
                                      <a class="page-link" href="#">2</a>
                                  </li>
                                  <li class="page-item">
                                      <a class="page-link" href="#">3</a>
                                  </li>
                                  <li class="page-item">
                                      <a class="page-link ts-btn-arrow" href="#">Next</a>
                                  </li>
                              </ul>
                          </nav>

                      </div>
                  </section>

              </div>
              <!--end Left Side / col-md-8-->

              <!--RIGHT SIDE (SIDEBAR)
                  =============================================================================================-->
              <div class="col-md-4 navbar-expand-md">

                  <button class="btn bg-white mb-4 w-100 d-block d-md-none" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="float-left">
                              <i class="fa fa-search mr-2"></i>
                              Redefine Search
                          </span>
                      <span class="float-right">
                              <i class="fa fa-plus small ts-opacity__30"></i>
                          </span>
                  </button>

                  <aside id="sidebar" class="ts-sidebar collapse navbar-collapse">

                      <!--SEARCH FORM
                          =========================================================================================-->
                      <section id="sidebar-search-form">

                          <h3>Search Form</h3>

                          <form id="form-search" class="ts-form">

                              <!--Keyword-->
                              <div class="form-group">
                                  <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Address, City or ZIP">
                              </div>

                              <!--Type-->
                              <div class="form-group">
                                  <select class="custom-select" id="type" name="type">
                                      <option value="">Type</option>
                                      <option value="1">Apartment</option>
                                      <option value="2">Villa</option>
                                      <option value="3">Land</option>
                                      <option value="4">Garage</option>
                                  </select>
                              </div>

                              <!--Status-->
                              <div class="form-group">
                                  <select class="custom-select" id="status" name="status">
                                      <option value="">Status</option>
                                      <option value="1">Rent</option>
                                      <option value="2">Sale</option>
                                  </select>
                              </div>

                              <!--Row - Min price & Max price-->
                              <div class="row">

                                  <!--Min Price-->
                                  <div class="col-sm-6">
                                      <div class="input-group">
                                          <input type="text" class="form-control border-right-0" id="min-price" name="min_price" placeholder="Min Price">
                                          <div class="input-group-append">
                                              <span class="input-group-text bg-white border-left-0">$</span>
                                          </div>
                                      </div>
                                  </div>

                                  <!--Max Price-->
                                  <div class="col-sm-6">
                                      <div class="input-group">
                                          <input type="text" class="form-control border-right-0" id="max-price" name="max_price" placeholder="Max Price">
                                          <div class="input-group-append">
                                              <span class="input-group-text bg-white border-left-0">$</span>
                                          </div>
                                      </div>
                                  </div>

                              </div>

                              <!--Submit button-->
                              <div class="form-group my-2">
                                  <button type="submit" class="btn btn-primary w-100" id="search-btn">Search
                                  </button>
                              </div>

                              <!--More Options Button-->
                              <a href="#more-options-collapse" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="more-options-collapse">
                                  <i class="fa fa-plus-circle ts-text-color-primary mr-2"></i>
                                  More Options
                              </a>

                              <!--Hidden Form-->
                              <div class="collapse" id="more-options-collapse">

                                  <!--Padding-->
                                  <div class="py-4">

                                      <!--Row-->
                                      <div class="form-row">

                                          <!--Bedrooms-->
                                          <div class="col-sm-6">
                                              <div class="form-group">
                                                  <label for="bedrooms">Bedrooms</label>
                                                  <input type="number" class="form-control" id="bedrooms" name="bedrooms" min="0">
                                              </div>
                                          </div>

                                          <!--Bathrooms-->
                                          <div class="col-sm-6">
                                              <div class="form-group">
                                                  <label for="bathrooms">Bathrooms</label>
                                                  <input type="number" class="form-control" id="bathrooms" name="bathrooms" min="0">
                                              </div>
                                          </div>

                                      </div>
                                      <!--end row-->

                                      <!--Checkboxes-->
                                      <div id="features-checkboxes" class="w-100">
                                          <h6 class="mb-3">Features</h6>

                                          <div class="ts-column-count-2">

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
                                                  <label class="custom-control-label" for="ch_6">Smoking allowed</label>
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
                          <!--end #form-search-->
                      </section>
                      <!--end #sidebar-search-form-->

                      <section id="map-results">
                          <h3>Map Results</h3>

                          <div id="ts-map-simple" class="ts-sidebar-map"
                               data-ts-map-leaflet-provider="https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}{r}.png"
                               data-ts-map-zoom="12"
                               data-ts-map-center-latitude="40.702411"
                               data-ts-map-center-longitude="-73.556842"
                               data-ts-map-scroll-wheel="1"
                               data-ts-map-controls="0">
                          </div>

                      </section>

                  </aside>
                  <!--end #sidebar-->
              </div>
              <!--end Right Side / col-md-4-->

          </div>
          <!--end row-->
      </div>
      <!--end container-->
  </section>
  <!--end #items-list-->

</main>
<!--end #ts-main-->


@endsection