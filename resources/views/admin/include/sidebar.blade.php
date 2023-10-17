<nav class="pcoded-navbar  ">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div " >
            
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="{{asset('assets/images/user/avatar-2.jpg')}}" alt="User-Profile-Image">
                    <div class="user-details">
                        <span>{{ Auth::user()->name }}</span>
                        <div id="more-details">{{ Auth::user()->usertype }}<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
                        <li class="list-group-item"><a href="{{ route('logout') }}" onclick="return logout(event);"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">
                function logout(event) {
                    event.preventDefault();
                    var check = confirm("Do you really want to logout?");
                    if (check) {
                        document.getElementById('logout-form').submit();
                    }
                }
            </script>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <ul class="nav pcoded-inner-navbar ">
                <li class="nav-item pcoded-menu-caption">
                    <label>Menu</label>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Article Management</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('getAllArticles')}}" target="">Article</a></li>
                        <li><a href="{{route('getAllCategory')}}" target="">Category</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Categories</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="layout-vertical.html" target="">All Categories</a></li>
                        <li><a href="layout-horizontal.html" target="">Horizontal</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>User Roles</label>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">User</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('getAllUserRole')}}">Roles</a></li>
                    </ul>
                </li>
            </ul>    
        </div>
    </div>
</nav>