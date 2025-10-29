 <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li class="">
                        <a  href="/dashboard" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-label">My Orders</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-bag menu-icon"></i><span class="nav-text">Orders</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('order.index')}}">Orders</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">My Reports</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-doc menu-icon"></i><span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('report.index')}}">Reports</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">My Fleet</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-plane menu-icon"></i><span class="nav-text">Vehicles</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('vehicle.index')}}">Vehicles</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Messaging</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span class="nav-text">Chat</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/chat">Chat</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
