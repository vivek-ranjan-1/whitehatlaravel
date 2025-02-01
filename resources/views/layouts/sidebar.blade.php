<!-- Sidebar  -->
<nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="{{asset('storage/users/icon.png')}}" alt="#" /></div>
                        <div class="user_info">
                           <h6>{{ucfirst(Auth::user()->name)}}</h6>
                           <p><span class="online_animation"></span> Online</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>General</h4>
                  <ul class="list-unstyled components">
					@if(isMenuValid('dashboard'))
                     <li class="active">
						<a href="{{route('dashboard')}}"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
                     </li>
                     @endif
					 @if(isMenuValid('frontend-pages/home') || isMenuValid('frontend-pages/projects') || isMenuValid('frontend-blogs/about') || isMenuValid('frontend-blogs/blogs') )
                     <li class="active">
                        <a href="#additional_page" data-toggle="collapse" aria-expanded="{{($currentRouteGroup == 'frontend-pages') ? true: false}}" class="dropdown-toggle {{($currentRouteGroup == 'frontend-pages') ? 'collapsed' : ''}}"><i class="fa fa-clone yellow_color"></i> <span>Frontend Pages</span></a>
                        <ul class="collapse list-unstyled {{($currentRouteGroup == 'frontend-pages') ? 'show': ''}}" id="additional_page">
						   @if(isMenuValid('frontend-pages/home'))
						   <li>
                              <a href="{{route('home.index')}}">
								<i class="fa-solid fa-home green_color" aria-hidden="true"></i>
								<span>Home</span>
							  </a>
                           </li>
						   @endif
						   @if(isMenuValid('frontend-pages/projects'))
						   <li>
							<a href="{{route('projects.index')}}">
                              <i class="fa-solid fa-landmark green_color" aria-hidden="true"></i>
							  <span>Projects</span> 
							</a>
                           </li>
						   @endif
						   @if(isMenuValid('frontend-pages/about'))
						   <li>
                              <a href="{{route('home.index')}}">
								<i class="fa-solid fa-home green_color" aria-hidden="true"></i>
								<span>About</span>
							  </a>
                           </li>
						   @endif
						   @if(isMenuValid('frontend-pages/blogs'))
						   <li>
                              <a href="{{route('blogs.index')}}">
								<i class="fa-regular fa-envelope green_color" aria-hidden="true"></i>
								<span>Blogs</span>
							  </a>
                           </li>
						   @endif
                        </ul>
                     </li>
					 @endif
					 @if(isMenuValid('youtube-videos'))
                     <li>
						<a href="{{route('youtube-videos.index')}}"><i class="fa fa-youtube red_color2"></i> <span>Youtube Videos</span></a>
					 </li>
					 @endif
					 @if(isMenuValid('queries'))
                     <li>
						<a href="{{route('queries.index')}}"><i class="fa fa-envelope red_color2"></i> <span>Contact Queries</span></a>
					 </li>
					@endif
					@if(isMenuValid('newsletter'))
					 <li><a href="{{route('message.index')}}"><i class="fa-regular fa-envelope green_color"></i> <span>Newsletter</span></a></li>
					@endif
					@if(isMenuValid('settings'))
                     <li><a href="{{route('settings.index')}}"><i class="fa fa-cog yellow_color"></i> <span>Settings</span></a></li>
					@endif
                  </ul>
               </div> 
            </nav>
            <!-- end sidebar -->