 <!--  BEGIN SIDEBAR  -->
 <div class="sidebar-wrapper sidebar-theme">
     <nav id="sidebar">
         <div class="navbar-nav theme-brand flex-row text-center">
             <div class="nav-logo">
                 <div class="nav-item theme-logo" style="width:90px;">
                     <a href="{{ route('admin.dashboard') }}">
                         <img src="{{ asset(Helpers_get_logo()) }}" class="" alt="logo">
                     </a>
                 </div>
                 <div class="nav-item theme-text">
                     <a href="{{ route('admin.dashboard') }}" class="nav-link"> {{Helpers_get_company_name()}} </a>
                 </div>
             </div>
             <div class="nav-item sidebar-toggle">
                 <div class="btn-toggle sidebarCollapse">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left">
                         <polyline points="11 17 6 12 11 7"></polyline>
                         <polyline points="18 17 13 12 18 7"></polyline>
                     </svg>
                 </div>
             </div>
         </div>

         <div class="shadow-bottom"></div>

         <ul class="list-unstyled menu-categories" id="accordionExample">
             <li class="menu menu-heading">
                 <div class="heading">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                         <line x1="5" y1="12" x2="19" y2="12"></line>
                     </svg>
                     <span>MAIN NAVIGATIONS</span>
                 </div>
             </li>

             <li class="menu {{Request::is('admin/dashboard') ? 'active' : '' }}">
                 <a href="{{ route('admin.dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                     <div class="">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                             <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                             <polyline points="9 22 9 12 15 12 15 22"></polyline>
                         </svg>
                         <span>Dashboard</span>
                     </div>
                 </a>
             </li>

             <li class="menu menu-heading">
                 <div class="heading">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                         <line x1="5" y1="12" x2="19" y2="12"></line>
                     </svg>
                     <span>USERS & INFLUENCERS</span>
                 </div>
             </li>

             <li class="menu {{Request::is('admin/masters*') ? 'active' : '' }}">
                 <a href="#masters" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                     <div class="">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                             <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                             <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                         </svg>
                         <span>Masters</span>
                     </div>
                     <div>
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                             <polyline points="9 18 15 12 9 6"></polyline>
                         </svg>
                     </div>
                 </a>
                 <ul class="collapse submenu list-unstyled {{Request::is('admin/masters*') ? 'show' : '' }}" id="masters" data-bs-parent="#accordionExample">
                     <li class="{{Request::is('admin/masters/price') ? 'active' : '' }}">
                         <a href="{{ route('admin.masters.price') }}">
                             Default Price
                         </a>
                     </li>
                     <li class="{{Request::is('admin/masters/plan') ? 'active' : '' }}">
                         <a href="{{route('admin.masters.plan')}}">
                             Default Plans
                         </a>
                     </li>
                     <li class="{{Request::is('admin/masters/service') ? 'active' : '' }}">
                         <a href="{{route('admin.masters.service')}}">
                             Default Services
                         </a>
                     </li>
                     <li class="{{Request::is('admin/masters/gift') ? 'active' : '' }}">
                         <a href="{{route('admin.masters.gift')}}">
                             Gifts
                         </a>
                     </li>
                     <li class="{{Request::is('admin/masters/category') ? 'active' : '' }}">
                         <a href="{{route('admin.masters.category')}}">
                             Category
                         </a>
                     </li>
                 </ul>
             </li>

             <li class="menu {{Request::is('admin/influncers*') ? 'active' : '' }}">
                 <a href="#influncers" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                     <div class="">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap">
                             <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                         </svg>
                         <span>Influncers</span>
                     </div>
                     <div>
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                             <polyline points="9 18 15 12 9 6"></polyline>
                         </svg>
                     </div>
                 </a>
                 <ul class="collapse submenu list-unstyled {{Request::is('admin/influncers*') ? 'show' : '' }}" id="influncers" data-bs-parent="#accordionExample">
                     <li class="{{Request::is('admin/influncers/list') || Request::is('admin/influncers/posts*') ? 'active' : '' }}">
                         <a href="{{route('admin.influncers.list')}}">
                             List
                         </a>
                     </li>
                     <li class="{{Request::is('admin/influncers/pending-order') || Request::is('admin/influncers/orders/view*') ? 'active' : '' }}">
                         <a href="{{route('admin.influncers.pending.order')}}">
                             Pending Orders
                         </a>
                     </li>
                     <li class="{{Request::is('admin/influncers/kyc-verification') || Request::is('admin/influncers/kyc/view*') ? 'active' : '' }}">
                         <a href="{{route('admin.influncers.kyc.verification')}}">
                             KYC Verifications
                         </a>
                     </li>
                 </ul>
             </li>

             <li class="menu {{Request::is('admin/users*') ? 'active' : '' }}">
                 <a href="#users" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                     <div class="">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                             <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                             <circle cx="9" cy="7" r="4"></circle>
                             <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                             <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                         </svg>
                         <span>Users</span>
                     </div>
                     <div>
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                             <polyline points="9 18 15 12 9 6"></polyline>
                         </svg>
                     </div>
                 </a>
                 <ul class="collapse submenu list-unstyled {{Request::is('admin/users*') ? 'show' : '' }}" id="users" data-bs-parent="#accordionExample">
                     <li class="{{Request::is('admin/users/list') ? 'active' : '' }}">
                         <a href="{{route('admin.users.list')}}"> List </a>
                     </li>
                 </ul>
             </li>

             <li class="menu menu-heading">
                 <div class="heading">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                         <line x1="5" y1="12" x2="19" y2="12"></line>
                     </svg>
                     <span>Payments & Settlements</span>
                 </div>
             </li>

             <li class="menu {{Request::is('admin/payments*') ? 'active' : '' }}">
                 <a href="#payments" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                     <div class="">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                             <line x1="12" y1="1" x2="12" y2="23"></line>
                             <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                         </svg>
                         <span>Settlements</span>
                     </div>
                     <div>
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                             <polyline points="9 18 15 12 9 6"></polyline>
                         </svg>
                     </div>
                 </a>
                 <ul class="collapse submenu list-unstyled {{Request::is('admin/payments*') ? 'show' : '' }}" id="payments" data-bs-parent="#accordionExample">
                     <li class="{{Request::is('admin/payments*') ? 'show' : '' }}">
                         <a href="{{route('admin.payments.list')}}">
                             List 
                            </a>
                     </li>
                     <li>
                         <a href="">
                             Preview
                         </a>
                     </li>
                 </ul>
             </li>

             <li class="menu {{Request::is('admin/transactions*') ? 'active' : '' }}">
                 <a href="#transactions" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                     <div class="">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                             <circle cx="9" cy="21" r="1"></circle>
                             <circle cx="20" cy="21" r="1"></circle>
                             <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                         </svg>
                         <span>Transactions</span>
                     </div>
                     <div>
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                             <polyline points="9 18 15 12 9 6"></polyline>
                         </svg>
                     </div>
                 </a>
                 <ul class="collapse submenu list-unstyled {{Request::is('admin/transactions*') ? 'show' : '' }}" id="transactions" data-bs-parent="#accordionExample">
                     <li class="{{Request::is('admin/transactions') ? 'active' : '' }}">
                         <a href="{{route('admin.transactions.influncerlist')}}">
                             Influncers
                         </a>
                     </li>
                     <li>
                         <a href="{{route('admin.transactions.Userlist')}}">
                             Users
                         </a>
                     </li>
                 </ul>
             </li>

             <li class="menu menu-heading">
                 <div class="heading">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minus">
                         <line x1="5" y1="12" x2="19" y2="12"></line>
                     </svg>
                     <span>Business Set up</span>
                 </div>
             </li>

             <li class="menu {{Request::is('admin/business-setup*') ? 'active' : '' }}">
                 <a href="#business_setting" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                     <div class="">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart">
                             <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                             <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                         </svg>
                         <span>Business Settings</span>
                     </div>
                     <div>
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                             <polyline points="9 18 15 12 9 6"></polyline>
                         </svg>
                     </div>
                 </a>
                 <ul class="collapse submenu list-unstyled {{Request::is('admin/business-setup*') ? 'show' : '' }}" id="business_setting" data-bs-parent="#accordionExample">
                     <li class="{{Request::is('admin/business-setup/term-condition') ? 'active' : '' }}">
                         <a href="{{route('admin.business-setup.term.condition')}}">
                             Term & Conditions
                         </a>
                     </li>
                     <li class="{{Request::is('admin/business-setup/privacy-policy') ? 'active' : '' }}">
                         <a href="{{route('admin.business-setup.privacy.policy')}}">
                             Privacy Policy
                         </a>
                     </li>
                     <li class="{{Request::is('admin/business-setup/company-setup') ? 'active' : '' }}">
                         <a href="{{route('admin.business-setup.company.setup')}}">
                             Company Setup
                         </a>
                     </li>
                     <li class="{{Request::is('admin/business-setup/commission-setup') ? 'active' : '' }}">
                         <a href="{{route('admin.business-setup.commission.setup')}}">
                             Commissions setup
                         </a>
                     </li>
                     <li class="{{Request::is('admin/business-setup/send-notification') ? 'active' : '' }}">
                         <a href="{{route('admin.business-setup.send.notification')}}">
                             Send Notification
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>
     </nav>
 </div>
 <!--  END SIDEBAR  -->