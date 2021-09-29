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
               <div class="search-wrapper">
                  <div class="input-holder">
                     <input type="text" class="search-input" placeholder="Type to search">
                     <button class="search-icon"><span></span></button>
                  </div>
                  <button class="close"></button>
               </div>

                 <ul class="header-megamenu nav">
                     <li class="btn-group nav-item">
                         <a  class="nav-link" data-toggle="dropdown" aria-expanded="false">
                             
                             System Settings
                             <i class="fa fa-angle-down ml-2 opacity-5"></i>
                         </a>
                         <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu">
                             <div class="scroll-area-xs">
                                 <div class="scrollbar-container">
                                    <a href="{{url('add-unit-type')}}"><button type="button" tabindex="0" class="dropdown-item">Unit Types</button></a>
                                    <a href="{{url('admin/list-bills')}}"><button type="button" tabindex="0" class="dropdown-item">Configure Bills</button></a>
                                 </div>
                             </div>
                           
                         </div>
                     </li>
                   
                 </ul>    
             
            </div>
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
                                    <div class="dropdown-menu-header-inner bg-info">
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
                                                   <div class="widget-heading"> {{ auth()->user()-> first_name }} {{ auth()->user()-> last_name }}
                                                   </div>
                                                  
                                                </div>
                                                <div class="widget-content-right mr-2">
                                                   <a class="dropdown-item" href="{{ route('logout') }}"
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
                            
                                 <ul class="nav flex-column">
                                    <li class="nav-item-divider nav-item">
                                    </li>
                                    <li class="nav-item-btn text-center nav-item">
                                       <button class="btn-wide btn btn-primary btn-sm">
                                       My Profile
                                       </button>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                           <div class="widget-heading">
                             {{ auth()->user()-> first_name }} {{ auth()->user()-> last_name }}
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
            <div class="scrollbar-sidebar">
               <div class="app-sidebar__inner">
                  <ul class="vertical-nav-menu">
                     <li class="app-sidebar__heading">Menu</li>
                     <li
                        class="mm-active"
                        >
                  <a href="{{url('admin/home')}}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                     </li>
                     <li
                        class="mm-active"
                        >
                        <a href="#">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Manage Buildings
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class="mm-show"
                           >
                           <li  class="mm-active">
                           <a href="{{ url('/admin/list-buildings') }}">
                              <i class="metismenu-icon"></i>
                              List Buildings
                              </a>
                           </li>
                           <li>
                           <a href="{{ url('/admin/create-building') }}">
                              <i class="metismenu-icon">
                              </i>Add Buiding
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li
                        class="mm-active"
                        >
                        <a href="#">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Manage Agents
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class="mm-show"
                           >
                           <li  class="mm-active">
                           <a href="{{ url('admin/manage-agents') }}">
                              <i class="metismenu-icon"></i>
                              List Agents
                              </a>
                           </li>
                     
                        </ul>
                     </li>
                     <li
                        class="mm-active"
                        >
                        <a href="#">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Manage Landlords
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class="mm-show"
                           >
                           <li  class="mm-active">
                           <a href="{{ url('admin/manage-landlords') }}">
                              <i class="metismenu-icon"></i>
                              List Landlords
                              </a>
                           </li>
                     
                        </ul>
                     </li>
                     <li
                        class="mm-active"
                        >
                        <a href="#">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Manage Tenants
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class="mm-show"
                           >
                           <li  class="mm-active">
                           <a href="{{ url('admin/list-tenants') }}">
                              <i class="metismenu-icon"></i>
                              List Tenants
                              </a>
                           </li>
                     
                        </ul>
                     </li>
                     <li
                        class="mm-active"
                        >
                        <a href="#">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Manage Bills
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class="mm-show"
                           >
                           <li  class="mm-active">
                           <a href="{{url('admin/list-bills')}}">
                              <i class="metismenu-icon"></i>
                              Configure Bills
                              </a>
                           </li>
                          
                        </ul>
                     </li>
                     <li
                        class="mm-active"
                        >
                        <a href="#">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Manage Payments
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class="mm-show"
                           >
                           <li  class="mm-active">
                              <a href="pages-login.html">
                              <i class="metismenu-icon"></i>
                              Invoices
                              </a>
                           </li>
                           <li>
                              <a href="pages-login-boxed.html">
                              <i class="metismenu-icon">
                              </i>Receipts
                              </a>
                           </li>
                           <li>
                              <a href="pages-login-boxed.html">
                              <i class="metismenu-icon">
                              </i>All Payments
                              </a>
                           </li>
                        </ul>
                     </li>

                     <li
                        class="mm-active"
                        >
                        <a href="#">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Manage Payment Taarifs
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class="mm-show"
                           >
                           <li  class="mm-active">
                              <a href="pages-login.html">
                              <i class="metismenu-icon"></i>
                              Configure Taarifs
                              </a>
                           </li>
                           
                        </ul>
                     </li>


                     
                     <li
                        class="mm-active"
                        >
                        <a href="#">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Manage Reports
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul
                           class="mm-show"
                           >
                           <li  class="mm-active">
                              <a href="pages-login.html">
                              <i class="metismenu-icon"></i>
                              Payments Reports
                              </a>
                           </li>
                           <li>
                              <a href="pages-login-boxed.html">
                              <i class="metismenu-icon">
                              </i>Building reports
                              </a>
                           </li>
                           <li>
                              <a href="pages-login-boxed.html">
                              <i class="metismenu-icon">
                              </i>Tenant reports
                              </a>
                           </li>
                           <li>
                              <a href="pages-login-boxed.html">
                              <i class="metismenu-icon">
                              </i>Fixed Bills Reports
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
      <script src="{{asset('assets/scripts/jquery-3.4.1.min.js')}}">
      </script>
      
      <script type="text/javascript" src="{{asset('assets/scripts/main.js')}}"></script>
      @yield('javascript')
    </body>
</html>
  