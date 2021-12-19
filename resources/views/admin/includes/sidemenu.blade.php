 <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li class="menu-active">
                        <a  href="/dashboard" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Users</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Staff</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="#">Staff</a></li>
                            <li><a href="#">Add Staff</a></li>
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="ion-android-bicycle menu-icon"></i><span class="nav-text">Drivers</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('drivers')}}">Drivers</a></li>
                            <li><a href="{{route('drivers.create')}}">Add Driver</a></li>
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Clients</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('clients')}}">Clients</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Messaging</li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span class="nav-text">Chat</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="#">Inbox</a></li>
                            <li><a href="#">Read</a></li>
                            <li><a href="#">Compose</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Orders</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-bag menu-icon"></i><span class="nav-text">Orders</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('order.index')}}">Orders</a></li>
                        </ul>

                    </li>


                    <li class="nav-label">Locations</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-location-pin menu-icon"></i><span class="nav-text">Locations</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('locations.index')}}">Locations</a></li>
                            <li><a href="{{route('locations.create')}}">Add Location</a></li>
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">

                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-credit-card menu-icon"></i><span class="nav-text">Pricing</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('pricing.index')}}">Pricing</a></li>
                            <li><a href="{{route('pricing.create')}}">Add New</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">Fleet Management</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-plane menu-icon"></i><span class="nav-text">Vehicles</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('vehicles.index')}}">Vehicles</a></li>
                            <li><a href="{{route('vehicles.create')}}">Add vehicle</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
