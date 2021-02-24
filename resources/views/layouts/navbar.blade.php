

    <div id="kt_header_mobile" class="header-mobile  header-mobile-fixed ">
        <a href="index.html">
            {{-- <img alt="Logo" src="" class="logo-default max-h-30px"> --}}
            <h3>Logo</h3>
        </a>

        <div class="d-flex align-items-center">
            <button class="btn rounded-0 p-0 burger-icon burger-icon-left" id="kt_header_mobile_toggle">
                    <span></span>
            </button>
    
            <button class="btn btn-hover-icon-primary p-0 ml-5" id="kt_sidebar_mobile_toggle">
                <span class="svg-icon svg-icon-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z" fill="#000000" fill-rule="nonzero"></path>
                            <path d="M10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L10.1818182,16 C8.76751186,16 8,15.2324881 8,13.8181818 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 Z" fill="#000000" opacity="0.3"></path>
                        </g>
                    </svg>
                </span>			
            </button>
        
            <button class="btn btn-hover-icon-primary p-0 ml-2" id="kt_aside_mobile_toggle">
                <span class="svg-icon svg-icon-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                        </g>
                    </svg>
                </span>
            </button>
        </div>
    </div>
    

    <div class="header-wrapper d-flex align-items-center" style="background-color: white">
		<div class="container d-flex align-items-center justify-content-end justify-content-lg-between flex-wrap py-3">
			<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
				<div id="kt_header_menu" class="header-menu header-menu-mobile  header-menu-layout-default ">
					<ul class="menu-nav">
                        @role('admin')
                            @include('layouts.navbar.admin')
                        @endrole
                        @role('user')
                            @include('layouts.navbar.user')
                        @endrole
                        
                        @auth
                            <li class="menu-item">
                                <a class="menu-link" aria-current="page" href="{{ Route('logout') }}">Logout</a>
                            </li>
                        @endauth
                        @guest
                            <li class="menu-item">
                                <a class="menu-link" aria-current="page" href="{{ Route('login') }}">Login</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
		</div>
	</div>