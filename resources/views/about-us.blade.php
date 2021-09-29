@extends('layouts.app')
@section('content')

<main id="ts-main" style="margin-top: 10%">

  <!--BREADCRUMB ******************************************************************************************-->
  <section id="breadcrumb">
      <div class="container">
          <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Library</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Data</li>
              </ol>
              <!--end breadcrumb-->
          </nav>
          <!--end nav-->
      </div>
      <!--end container-->
  </section>

  <!--PAGE TITLE ******************************************************************************************-->
  <section id="page-title">
      <div class="container">
          <div class="ts-title">
              <h1>About Us</h1>
          </div>
          <!--end ts-title-->
      </div>
      <!--end container-->
  </section>

  <!--DESCRIPTION *****************************************************************************************-->
  <section id="about-us-description">
      <div class="container">
          <div class="row">
              <div class="col-md-8">
                  <p class="h3">
                     Landlords who manage their properties with M-Rent have less stress and more time to enjoy the rental passive income. With M-Rent you List properties, screen tenants, and collect rent straight to your bank account.
                  </p>
                 
                 
              </div>
          </div>
          <!--end row-->
      </div>
      <!--end container-->
  </section>
<!-- FEATURES
  =============================================================================================================-->
  <section class="ts-block bg-white">
      <div class="container py-4">
          <div class="row">

              <!--Feature-->
              <div class="col-sm-6 col-md-3">
                  <div class="ts-feature">

                      <figure class="ts-feature__icon p-2">
                              <span class="ts-circle">
                                  <i class="fa fa-check"></i>
                              </span>
                          <img src="assets/img/icon-house.png" alt="">
                      </figure>

                      <h4>Real-time update on payment</h4>

                      <p>Real-time update when tenant make rent payment</p>

                  </div>
              </div>

              <!--Feature-->
              <div class="col-sm-6 col-md-3">
                  <div class="ts-feature">

                      <figure class="ts-feature__icon p-2">
                              <span class="ts-circle">
                                  <i class="fa fa-check"></i>
                              </span>
                          <img src="assets/img/icon-pin.png" alt="">
                      </figure>

                      <h4>Complete view of payments status</h4>

                      <p>Get complete view of payments status on all your rental properties </p>

                  </div>
              </div>

              <!--Feature-->
              <div class="col-sm-6 col-md-3">
                  <div class="ts-feature">

                      <figure class="ts-feature__icon p-2">
                              <span class="ts-circle">
                                  <i class="fa fa-check"></i>
                              </span>
                          <img src="assets/img/icon-agent.png" alt="">
                      </figure>

                      <h4>Save time and resources used to reconcile payments</h4>

                      <p>Save time and resources used to reconcile payments M-rent automate the receipting and reconciling </p>

                  </div>
              </div>

              <!--Feature-->
              <div class="col-sm-6 col-md-3">
                  <div class="ts-feature">

                      <figure class="ts-feature__icon p-2">
                              <span class="ts-circle">
                                  <i class="fa fa-check"></i>
                              </span>
                          <img src="assets/img/icon-calculator.png" alt="">
                      </figure>

                      <h4> Eliminate errors in payment</h4>

                      <p> Eliminate errors in payment get a trace of where each cent was sent and who is behind in payment</p>

                  </div>
              </div>

          </div>
          <!--end row-->
      </div>
      <!--end container-->
  </section>

  <!--NUMBERS *********************************************************************************************-->
  {{-- <section id="about-us-numbers">
      <div id="numbers" class="py-5 text-white text-center ts-separate-bg-element" data-bg-color="#000037" data-bg-image="assets/img/bg-apartment-table.jpg" data-bg-image-opacity=".3">
          <div class="container py-5">
              <div class="ts-promo-numbers">
                  <div class="row">

                      <div class="col-sm-3">
                          <div class="ts-promo-number">
                              <h2>5640</h2>
                              <h4 class="mb-0 ts-opacity__50">Properties</h4>
                          </div>
                          <!--end ts-promo-number-->
                      </div>
                      <!--end col-sm-3-->

                      <div class="col-sm-3">
                          <div class="ts-promo-number">
                              <h2>1225</h2>
                              <h4 class="mb-0 ts-opacity__50">Local Landlords</h4>
                          </div>
                          <!--end ts-promo-number-->
                      </div>
                      <!--end col-sm-3-->

                      <div class="col-sm-3">
                          <div class="ts-promo-number">
                              <h2>231343</h2>
                              <h4 class="mb-0 ts-opacity__50">Tenants</h4>
                          </div>
                          <!--end ts-promo-number-->
                      </div>
                      <!--end col-sm-3-->

                      <div class="col-sm-3">
                          <div class="ts-promo-number">
                              <h2>6</h2>
                              <h4 class="mb-0 ts-opacity__50">Awards</h4>
                          </div>
                          <!--end ts-promo-number-->
                      </div>
                      <!--end col-sm-3-->

                  </div>
                  <!--end row-->
              </div>
              <!--end ts-promo-numbers-->
          </div>
          <!--end container-->
      </div>
      <!--end #numbers-->
  </section> --}}

  <!--PARTNERS ********************************************************************************************-->
  {{-- <section id="partners">
      <div class="ts-block py-4">
          <div class="container">
              <!--block of logos-->
              <div class="d-block d-md-flex justify-content-between align-items-center text-center ts-partners py-3">
                  <a href="#">
                      <img src="assets/img/logo-01.png" alt="">
                  </a>
                  <a href="#">
                      <img src="assets/img/logo-02.png" alt="">
                  </a>
                  <a href="#">
                      <img src="assets/img/logo-03.png" alt="">
                  </a>
                  <a href="#">
                      <img src="assets/img/logo-04.png" alt="">
                  </a>
                  <a href="#">
                      <img src="assets/img/logo-05.png" alt="">
                  </a>
              </div>
              <!--end logos-->
          </div>
          <!--end container-->
      </div>
  </section> --}}

</main>
<!--end #ts-main-->

@endsection