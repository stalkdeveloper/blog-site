<?php 
    $data = userInfo();                    
?>
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
                @if($data->can_read == '1' || Auth::user()->usertype == 'admin')
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Article Management</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="{{route('getAllArticles')}}">Article</a></li>
                        </ul>
                    </li>
                @endif
                @if($data->can_read == '1' || Auth::user()->usertype == 'admin')
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Categories</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="{{route('getAllCategory')}}">Category</a></li>
                        </ul>
                    </li>
                @endif
                @if($data->can_read == '1' || Auth::user()->usertype == 'admin')
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#" class="nav-link "><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">User Roles</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="{{route('getAllUserRole')}}">Roles</a></li>
                        </ul>
                    </li>
                @endif
            </ul>    
        </div>
    </div>
</nav>