<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Language" content="en">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>Mrent - Home</title>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
         />
      <meta name="description" content="Mrent property management System">
      <!-- Disable tap highlight on IE -->
      <meta name="msapplication-tap-highlight" content="no">
      <link href="{{asset('main.css')}}" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      @yield('styles')
      <style>
         .hide {
            display: none;
         }
            .table th{
               background: #00aae0;
               color: #fff;
             }
    
          .form-control{
            height: calc(2.5rem + 2px) !important;
          
            }
            label {
                font-family: "Nunito", sans-serif !important;
                padding: 5px;
            }
    
          </style>
   </head>
   <body>
      <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar closed-sidebar">
      <div class="app-header header-shadow bg-premium-dark header-text-light">
         <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
               <div>
                  <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                  <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                  </span>
                  </button>
               </div>
            </div>
         </div>
         <div class="app-header__mobile-menu">
            <div>
               <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
               <span class="hamburger-box">
               <span class="hamburger-inner"></span>
               </span>
               </button>
            </div>
         </div>
         <div class="app-header__menu">
            <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
            <i class="fa fa-ellipsis-v fa-w-6"></i>
            </span>
            </button>
            </span>
         </div>
         <div class="app-header__content">
           
            <div class="app-header-right">
               <div class="header-dots">
                 
                  <div class="dropdown">
                     <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 mr-2 btn btn-link">
                     <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                     <span class="icon-wrapper-bg bg-danger"></span>
                     <i class="icon text-danger icon-anim-pulse ion-android-notifications"></i>
                     <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>
                     </span>
                     </button>
                     <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                        <div class="dropdown-menu-header mb-0">
                           <div class="dropdown-menu-header-inner bg-deep-blue">
                              <div class="menu-header-image opacity-1" style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div>
                              <div class="menu-header-content text-dark">
                                 <h5 class="menu-header-title">Notifications</h5>
                                 <h6 class="menu-header-subtitle">You have <b>21</b> unread messages</h6>
                              </div>
                           </div>
                        </div>
                      
                     </div>
                  </div>

               </div>
               <div class="header-btn-lg pr-0">
                  <div class="widget-content p-0">
                     <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                           <div class="btn-group">
                              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                              <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                              <i class="fa fa-angle-down ml-2 opacity-8"></i>
                              </a>
                              <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                 <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner">
                                       <div class="menu-header-image opacity-2" style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div>
                                       <div class="menu-header-content text-left">
                                          <div class="widget-content p-0">
                                             <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                   <img width="42" class="rounded-circle"
                                                      src="assets/images/avatars/1.jpg"
                                                      alt="">
                                                </div>
                                                <div class="widget-content-left">
                                                      @auth
                                                   <div class="widget-heading text-dark"> 
                                                  
                                                      {{ auth()->user()-> first_name }} {{ auth()->user()-> last_name }} 
                                                   
                                                   </div>
                                                   <div class="widget-subheading">
                                                         @foreach (auth()->user()->roles as $key)
                                                            ({{$key->name}})
                                                         @endforeach
                                                     </div>
                                                     @endauth
                                                  
                                                </div>
                                                <div class="widget-content-right mr-2">
                                                   <a class="btn btn-danger dropdown-item text-white" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                               document.getElementById('logout-form').submit();">
                                                   {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                   @csrf
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
                        <div class="widget-content-left  ml-3 header-user-info">
                           <div class="widget-heading">
                             Welcome,
                             
                             @auth
                             {{ auth()->user()-> first_name }} {{ auth()->user()-> last_name }} @foreach (auth()->user()->roles as $key)
                                ({{$key->name}})
                             @endforeach
                          @endauth
                           </div>
                         
                        </div>
                      
                     </div>
                  </div>
               </div>
             
            </div>
         </div>
      </div>

      <div class="app-main">
         <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
               <div class="logo-src"></div>
               <div class="header__pane ml-auto">
                  <div>
                     <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                     <span class="hamburger-box">
                     <span class="hamburger-inner"></span>
                     </span>
                     </button>
                  </div>
               </div>
            </div>
            <div class="app-header__mobile-menu">
               <div>
                  <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                  <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                  </span>
                  </button>
               </div>
            </div>
            <div class="app-header__menu">
               <span>
               <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
               <span class="btn-icon-wrapper">
               <i class="fa fa-ellipsis-v fa-w-6"></i>
               </span>
               </button>
               </span>
            </div>
            <div class="scrollbar-sidebar" style="background:#fdfaf5">
               <div class="app-sidebar__inner">
                  <ul class="vertical-nav-menu">
                     <li class="app-sidebar__heading">Menu</li>
                     <li
                        class="mm-active"
                        >
                  <a href="{{url('tenant/home')}}">
                        <i class="metismenu-icon fa fa-dashboard"></i>
                        Dashboard
                        <i class="metismenu-state-icon"></i>
                        </a>
                     </li>
                     <li
                     class="mm-active"
                     >
                  <a href="{{ url('tenant/service-requests') }}">
                     <i class="metismenu-icon fa fa-ticket"></i>
                     Service Requests
                     <i class="metismenu-state-icon"></i>
                     </a>
                    
                  </li>
                     <li
                        class="mm-active"
                        >
                        <a href="{{ url('tenant/rental-units') }}">
                        <i class="metismenu-icon fa fa-building-o"></i>
                        My Rental Units
                        <i class="metismenu-state-icon"></i>
                        </a>
                       
                     </li>
                     <li
                        class="mm-active"
                        >
                        <a href="#">
                        <i class="metismenu-icon fa fa-money-bill"></i>
                        My Bills
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class="mm-show"
                           >
                          <li  class="mm-active">
                          <a href="{{ url('tenant/fixed-bills') }}">
                              <i class="metismenu-icon"></i>
                              Fixed Bills
                              </a>
                           </li>
                           <li>
                              <a href="{{ url('tenant/variable-bills') }}">
                              <i class="metismenu-icon">
                              </i>Variable Bills
                              </a>
                           </li> 
                          
                        </ul>
                     </li>
                    
                     <li
                        class="mm-active"
                        >
                        <a href="#">
                        <i class="metismenu-icon fa fa-money"></i>
                        Manage Payments
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class="mm-show"
                           >
                           <li>
                           <a href="{{ url('tenant/payments') }}">
                              <i class="metismenu-icon">
                              </i>My Payments
                              </a>
                           </li>
                        </ul>
                     </li>

                     <li
                     class="mm-active"
                     >
                     <a href="{{ url('tenant/vacate-notices') }}">
                     <i class="metismenu-icon fa fa-file-o"></i>
                     My Vacate Notices
                     <i class="metismenu-state-icon"></i>
                     </a>
                    
                  </li>
                     
                    
                  </ul>
               </div>
            </div>
         </div>


      @yield('content')


      <div class="app-drawer-overlay d-none animated fadeIn"></div>
      <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"></script>
      <script type="text/javascript" src="{{asset('assets/scripts/main.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      @yield('javascript')
      @toastr_render
    </body>
</html>
  