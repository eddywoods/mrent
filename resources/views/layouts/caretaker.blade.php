<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Language" content="en">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>Mrent Caretaker- Home</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"
         />
      <meta name="description" content="Mrent property management System">
      <!-- Disable tap highlight on IE -->
      <meta name="msapplication-tap-highlight" content="no">
      <link href="{{asset('main.css')}}" rel="stylesheet">
      <link href="{{asset('assets/datepicker.css')}}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
      <style>
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
            <div class="scrollbar-sidebar">
               <div class="app-sidebar__inner">
                  <ul class="vertical-nav-menu">
                     <li class="app-sidebar__heading">Menu</li>
                     <li
                        class="mm-active"
                        >
                        <a href="{{url('caretaker/home')}}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Manage Buildings
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                     </li>
                     <li
                        class="mm-active"
                        >
                        <a href="{{url('caretaker/service-requests')}}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Service Requests
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                     </li>
                     <li
                        class="mm-active"
                        >
                        <a href="{{url('caretaker/vacant-units')}}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Vacant House Units
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                     </li>
                     <li
                        class="mm-active"
                        >
                        <a href="{{url('caretaker/list-tenants')}}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        List Tenants
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                     </li>

                     <li
                        class="mm-active"
                        >
                        <a href="{{url('caretaker/vacate-notices')}}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Vacate Notices
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
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
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.es.min.js"></script>
      @yield('javascript')
      @toastr_render
    </body>
</html>
  