<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Language" content="en">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>Mrent - Home</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
         />
      <meta name="description" content="Mrent property management System">
      <!-- Disable tap highlight on IE -->
      <meta name="msapplication-tap-highlight" content="no">
      <link href="{{asset('main.css')}}" rel="stylesheet">
      <link href="{{asset('assets/datepicker.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <style>
            .table th{
               background: #e6e1da;
               color: #231f20;
             }
    
             .media-photo {
                width: 35px;
             }
    
          .form-control{
            height: calc(2.5rem + 2px) !important;
        
            }
            label {
                font-family: "Nunito", sans-serif !important;
                padding: 5px;
            }
            .card-body{
             background: #fdfaf5;
            }
            .datepicker .datepicker-dropdown {
               z-index: 10000 !important;
            }
    
          </style>
   </head>
   <body>
      <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
      <div class="app-header header-shadow">
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
            <div class="app-header-left">
               <ul class="header-megamenu nav">
                     <li class="btn-group nav-item">
                         <a  class="nav-link" data-toggle="dropdown" aria-expanded="false">
                             
                             System Settings
                             <i class="fa fa-angle-down ml-2 opacity-5"></i>
                         </a>
                         <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu">
                             <div class="scroll-area-xs">
                                 <div class="scrollbar-container">
                                    <a href="{{url('agent/unit-types')}}"><button type="button" tabindex="0" class="dropdown-item">Unit Types</button></a>
                                    <a href="{{url('agent/list-bills')}}"><button type="button" tabindex="0" class="dropdown-item">Configure Bills</button></a>
                                    <a href="{{url('agent/services')}}"><button type="button" tabindex="0" class="dropdown-item">Vendor Services</button></a>
                                 </div>
                             </div>
                           
                         </div>
                     </li>
                   
                 </ul>    
             
            </div>
            <div class="app-header-right">
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
                                                   <div class="widget-heading text-dark">
                                                   @auth
                                                      {{ auth()->user()-> first_name }} {{ auth()->user()-> last_name }} @foreach (auth()->user()->roles as $key)
                                                         ({{$key->name}})
                                                      @endforeach
                                                   @endauth
                                                   </div>
                                                  
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
                              @auth
                           <div class="widget-heading">
                                 Welcome,  
                               
                                 {{ auth()->user()-> first_name }} {{ auth()->user()-> last_name }} 
                              
                           </div>
                           <div class="widget-subheading">
                                 @foreach (auth()->user()->roles as $key)
                                    ({{$key->name}})
                                 @endforeach
                             </div>
                             @endauth
                         
                        </div>
                      
                     </div>
                  </div>
               </div>
             
            </div>
         </div>
      </div>

      <div class="app-main">
         <div class="app-sidebar sidebar-shadow" style="background:#fdfaf5">
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
            <div class="scrollbar-sidebar">
               <div class="app-sidebar__inner">
                  <ul class="vertical-nav-menu">
                     <li class="app-sidebar__heading">Menu</li>
                     <li
                        class="mm-active"
                        >
                        <a href="{{url('agent/home')}}">
                        <i class="metismenu-icon fa fa-dashboard"></i>
                        Dashboard
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                     </li>
                     <li
                     class=""
                     >
                     <a href="#">
                     <i class="metismenu-icon fa fa-cog"></i>
                     Property Configurations
                     <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                     </a>
                     <ul
                        class="mm-show"
                        >
                        <li  class="">
                        <a href="{{ url('/agent/unit-types') }}">
                           <i class="metismenu-icon"></i>
                           Unit Types
                           </a>
                        </li>
                        <li>
                        <a href="{{ url('/agent/list-bills') }}">
                           <i class="metismenu-icon">
                           </i>Bills
                           </a>
                        </li>
                        <li>
                           <a href="{{ url('/agent/services') }}">
                              <i class="metismenu-icon">
                              </i>Vendor Services
                              </a>
                           </li>
                     </ul>
                  </li>
                  <li
                  class=""
                  >
                  <a href="#">
                  <i class="metismenu-icon fa fa-user"></i>
                  Manage Landlords
                  <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                  </a>
                  <ul
                     class=""
                     >
                     <li  class="">
                     <a href="{{ url('agent/manage-landlords') }}">
                        <i class="metismenu-icon"></i>
                        List Landlords
                        </a>
                     </li>
               
                  </ul>
               </li>
                     <li
                        class=""
                        >
                        <a href="#">
                        <i class="metismenu-icon fa fa-building"></i>
                        Manage Buildings
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class=""
                           >
                           <li  class="">
                           <a href="{{ url('/agent/list-buildings') }}">
                              <i class="metismenu-icon"></i>
                              List Buildings
                              </a>
                           </li>
                           <li>
                           <a href="{{ url('/agent/create-building') }}">
                              <i class="metismenu-icon">
                              </i>Add Buiding
                              </a>
                           </li>
                           <li>
                           <a href="{{ url('/agent/house-units') }}">
                              <i class="metismenu-icon">
                              </i>House Units
                              </a>
                           </li>
                           <li>
                           <a href="{{ url('/agent/vacant-units') }}">
                              <i class="metismenu-icon">
                              </i>Vacant House Units
                              </a>
                           </li>
                          
                        </ul>
                     </li>
                     
                     <li
                        class=""
                        >
                        <a href="#">
                        <i class="metismenu-icon fa fa-users"></i>
                        Manage Tenants
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class=""
                           >
                           <li  class="">
                           <a href="{{ url('agent/list-tenants') }}">
                              <i class="metismenu-icon"></i>
                              List Tenants
                              </a>
                           </li>
                           <li>
                              <a href="{{ url('/agent/add-tenant') }}">
                                 <i class="metismenu-icon">
                                 </i>Add Tenant
                                 </a>
                              </li>
                  
                        </ul>
                     </li>
                     <li
                        class=""
                        >
                        <a href="#">
                        <i class="metismenu-icon fa fa-user"></i>
                        Manage Vendors
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class=""
                           >
                           <li  class="">
                           <a href="{{ url('agent/vendors') }}">
                              <i class="metismenu-icon"></i>
                              List Vendors
                              </a>
                           </li>
                     
                        </ul>
                     </li>
                    
                     <li
                        class=""
                        >
                        <a href="#">
                        <i class="metismenu-icon fa fa-money"></i>
                        Manage Payments
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class=""
                           >
                       
                           <li>
                              <a href="{{url('agent/expenses')}}">
                              <i class="metismenu-icon">
                              </i>Manage Expenses
                              </a>
                           </li>
                           <li>
                           <a href="{{ url('agent/payments') }}">
                              <i class="metismenu-icon">
                              </i>All Payments
                              </a>
                           </li>
                        </ul>
                     </li>

                     <li
                     class=""
                     >
                     <a href="#">
                     <i class="metismenu-icon fa fa-ticket"></i>
                     Tenant Requests
                     <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                     </a>
                     <ul
                        class=""
                        >
                        <li>
                           <a href="{{url('agent/service-requests')}}">
                           <i class="metismenu-icon">
                           </i>Service Requests
                           </a>
                        </li>
                        <li>
                           <a href="{{url('agent/vacate-notices')}}">
                           <i class="metismenu-icon">
                           </i>Vacate Notices
                           </a>
                        </li>
                     </ul>
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
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>
      @yield('javascript')
      @toastr_render
    </body>
</html>
  