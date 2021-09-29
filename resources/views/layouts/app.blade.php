<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="walterokenye@gmail.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--CSS -->
    <link rel="stylesheet" href="{{asset('temp/assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('temp/assets/font-awesome/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('temp/assets/css/jquery.scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('temp/assets/css/leaflet.css')}}">
    <link rel="stylesheet" href="{{asset('temp/assets/css/style.css')}}">
    <style>
        .hide{
            display:none;
        }
     .form-control{
        height: calc(2.5rem + 2px) !important;
      
        }
        label {
            font-family: "Nunito", sans-serif !important;
        }
    </style>

    <title>M-Rent</title>

</head>

<body>

<!-- WRAPPER
=====================================================================================================================-->
<div class="ts-page-wrapper ts-homepage" id="page-top">

    <!--*********************************************************************************************************-->
    <!--HEADER **************************************************************************************************-->
    <!--*********************************************************************************************************-->
    <header id="ts-header" class="fixed-top">

        <!-- SECONDARY NAVIGATION
        =============================================================================================================-->
        <nav id="ts-secondary-navigation" class="navbar p-0">
            <div class="container justify-content-end justify-content-sm-between">

                <!--Left Side-->
                <div class="navbar-nav d-none d-sm-block my-3">
                    <!--Phone-->
                    <span class="mr-4">
                            <i class="fa fa-phone-square mr-1"></i>
                            +254720310021
                        </span>
                    <!--Email-->
                    <a href="#">
                        <i class="fa fa-envelope mr-1"></i>
                        info@m-rent.co.ke
                    </a>
                </div>

            </div>
            <!--end container-->
        </nav>

        <!--PRIMARY NAVIGATION
        =============================================================================================================-->
        <nav id="ts-primary-navigation" class="navbar navbar-expand-md navbar-light">
            <div class="container">

                <!--Brand Logo-->
            <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('temp/assets/img/mrent-logo.png')}}"  width="120" alt="">
                </a>

                <!--Responsive Collapse Button-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPrimary" aria-controls="navbarPrimary" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!--Collapsing Navigation-->
                <div class="collapse navbar-collapse" id="navbarPrimary">

                    <!--LEFT NAVIGATION MAIN LEVEL
                    =================================================================================================-->
                    <ul class="navbar-nav">

                        <!--HOME (Main level)
                        =============================================================================================-->
                        <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Home</a></li>
                        
             
                        {{-- <li class="nav-item"><a class="nav-link" href="#">Rent loan</a></li>
                                    
                        <li class="nav-item"><a class="nav-link" href="#">Home Insurance </a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Smart Home </a></li> --}}
                        <li class="nav-item">
                        <a class="nav-link" href="{{ url('about-us') }}">About Us</a>
                        </li>
                     
                        <li class="nav-item">
                        <a class="nav-link mr-2" href="{{ url('property-listings') }}">Property Listings</a>
                        </li>


                    </ul>
                    <!--end Left navigation main level-->

                    <!--RIGHT NAVIGATION MAIN LEVEL
                    =================================================================================================-->
                    <ul class="navbar-nav ml-auto">
                            @guest
                            <!--LOGIN (Main level)
                        =============================================================================================-->
                                <li class="nav-item">
                                <a class="nav-link" href="{{ url('login') }}"> Tenant Login</a>
                                </li> | 
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('login') }}">Agent/Landlord Login</a>
                                </li> | 
                                
        
                                <!--REGISTER (Main level)
                                =============================================================================================-->
                                <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ url('register') }}"><i class="fa fa-sign-in-alt"></i> Create Account</a>
                                </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                       

                        <!--SUBMIT (Main level)
                        =============================================================================================-->
                        <li class="nav-item">
                            <a class="btn btn-outline-info btn-sm m-1 px-3" href="{{ url('manage-property') }}">
                                <i class="fa fa-plus small mr-2"></i>
                                Manage Property
                            </a>
                        </li>

                    </ul>
                    <!--end Right navigation-->

                </div>
                <!--end navbar-collapse-->
            </div>
            <!--end container-->
        </nav>
        <!--end #ts-primary-navigation.navbar-->

    </header>
    <!--end Header-->


    @yield('content')

    </div>
    <!--end page-->
    
    <script src="{{asset('temp/assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('temp/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('temp/assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('temp/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('temp/assets/js/dragscroll.js')}}"></script>
    <script src="{{asset('temp/assets/js/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('temp/assets/js/leaflet.js')}}"></script>
    <script src="{{asset('temp/assets/js/leaflet.markercluster.js')}}"></script>
    <script src="{{asset('temp/assets/js/custom.js')}}"></script>
    <script src="{{asset('temp/assets/js/map-leaflet.js')}}"></script>

    @yield('scripts')
    </body>
    </html>
