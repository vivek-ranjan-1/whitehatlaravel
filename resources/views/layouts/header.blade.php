<!-- topbar -->
<div class="topbar">
   <nav class="navbar navbar-expand-lg navbar-light">
      <div class="full">
         <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
         <div class="logo_section">
            <a href="{{route('dashboard')}}"><img class="img-responsive" src="{{asset('storage/organizations/logo.png')}}" alt="#" /></a>
         </div>
         <div class="right_topbar">
            <div class="icon_info">
               <ul class="user_profile_dd">
                  <li>
                     <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle"
                           src="{{asset('storage/users/icon.png')}}" alt="#" /><span
                           class="name_user">{{ucfirst(Auth::user()->name)}}</span></a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item p-2" href="{{route('edit-profile')}}"> My Profile </a>
                        <a class="dropdown-item p-2" href="{{route('edit-profile')}}"> Edit Profile </a>
                        <a class="dropdown-item p-2" href="{{route('edit-profile')}}"> Change Password</a>
                        <a class="dropdown-item p-2" href="{{route('logout')}}"><span> Log Out </span> <i
                              class="fa fa-sign-out"></i></a>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </nav>
</div>