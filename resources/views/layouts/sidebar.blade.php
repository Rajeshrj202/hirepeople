 <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
   <div class="sidebar-inner px-4 pt-3">
     <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
       <div class="d-flex align-items-center">
         <div class="avatar-lg me-4">
           <img src="{{asset('images/profile.png')}}" class="card-img-top rounded-circle border-white">
         </div>
         <div class="d-block">
           <h2 class="h5 mb-3">Hi, {{auth()->user()->name}}</h2>
           <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
             <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
             </svg>
             Sign Out
           </a>
         </div>
       </div>
       <div class="collapse-close d-md-none">
         <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
           <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
             <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
           </svg>
         </a>
       </div>
     </div>
     <ul class="nav flex-column pt-3 pt-md-0">
       <li class="nav-item">
         <a href="{{route('home')}}" class="nav-link d-flex align-items-center">
           <span class="sidebar-icon">
             <img src="{{asset('images/logo.png')}}" height="40" width="40" alt="Volt Logo">
           </span>
           <span class="mt-1 ms-1 sidebar-text">HIRE PEOPLE</span>
         </a>
       </li>

       <li class="nav-item  {{ Route::is('home')  || Route::is('dashboard') ? 'active' : '' }} mt-5 ">
         <a href="{{route('home')}}" class="nav-link">
           <span class="sidebar-icon">
             <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
               <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
             </svg>
           </span>
           <span class="sidebar-text">Dashboard</span>
         </a>
       </li>
       @can('candidate index')
       <li class="nav-item {{ Request::segment(1) === 'candidate' ? 'active' : null }}">
         <a href="{{route('candidate.index')}}" class="nav-link d-flex justify-content-between">
           <span>
             <span class="sidebar-icon">
               <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                 <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
               </svg>
             </span>
             <span class="sidebar-text">Manage Candidates</span>
           </span>

         </a>
       </li>
       @endcan
       @can('candidate assigned')
       <li class="nav-item {{ Request::segment(1) === 'candidate' ? 'active' : null }}">
         <a href="{{route('candidate.assigned')}}" class="nav-link d-flex justify-content-between">
           <span>
             <span class="sidebar-icon">
               <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                 <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
               </svg>
             </span>
             <span class="sidebar-text">My Candidates</span>
           </span>

         </a>
       </li>
       @endcan
       @can('user index')
       <li class="nav-item {{ Request::segment(1) === 'user' ? 'active' : null }}">
         <a href="{{route('user.index')}}" class="nav-link d-flex justify-content-between">
           <span>
             <span class="sidebar-icon">
               <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                 <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
               </svg>
             </span>
             <span class="sidebar-text">Manage Users</span>
           </span>

         </a>
       </li>
       @endcan

       <li class="nav-item">
         <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           <span class="sidebar-icon">
             <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
             </svg>
           </span>
           <span class="sidebar-text">Logout</span>
         </a>
       </li>
       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
         {{ csrf_field() }}
       </form>


     </ul>
   </div>
 </nav>