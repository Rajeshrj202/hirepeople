 <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
   <div class="container-fluid px-0">
     <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
       <div class="d-flex align-items-center">
         <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
           <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
             <li class="breadcrumb-item">
               <a href="{{route('dashboard')}}">
                 <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                   </path>
                 </svg>
               </a>
             </li>
             <li class="breadcrumb-item active" aria-current="page">
               @yield('title')
             </li>
           </ol>
         </nav>
       </div>
       <!-- Navbar links -->
       <ul class="navbar-nav align-items-center">

         <li class="nav-item dropdown ms-lg-3">
           <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             <div class="media d-flex align-items-center">
               <img class="avatar rounded-circle" alt="Image placeholder" src="{{asset('images/profile.png')}}">
               <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                 <span class="mb-0 font-small fw-bold text-gray-900">{{auth()->user()->name}}</span>
               </div>
             </div>
           </a>

         </li>
       </ul>
     </div>
   </div>
 </nav>

 <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
   <div class="d-block mb-4 mb-md-0">

     <h2 class="h4">@yield('title')</h2>
     <p class="mb-0">@yield('subtitle')</p>
   </div>
 </div>

 @include('layouts.alert')