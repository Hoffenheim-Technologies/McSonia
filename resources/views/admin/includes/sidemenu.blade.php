 <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a  href="/dashboard" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./layout-blank.html">Blank</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Messaging</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span class="nav-text">Chat</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./email-inbox.html">Inbox</a></li>
                            <li><a href="./email-read.html">Read</a></li>
                            <li><a href="./email-compose.html">Compose</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Media</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-feed menu-icon"></i><span class="nav-text">Blog</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="#">Blank</a></li>
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-calender menu-icon"></i><span class="nav-text">Events</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="#">Blank</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Accounts Management</li>

                    <li class="nav-label">Locations</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-location-pin menu-icon"></i><span class="nav-text">PickUp/Delivery</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('locations.index')}}">Locations</a></li>
                            <li><a href="{{route('locations.create')}}">Add Location</a></li>
                        </ul>
                    </li>



                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
