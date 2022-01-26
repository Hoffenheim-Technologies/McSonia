 <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li class="">
                        <a  href="{{route('admin_dashboard')}}" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    @if (MS::isAdmin())
                    <li class="nav-label">Users</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">Staff</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('staffs')}}">Staff</a></li>
                            <li><a href="{{route('staffs.create')}}">Add Staff</a></li>
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
                            <li><a href="{{route('testimonials.index')}}">Testimonials</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">Orders</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-bag menu-icon"></i><span class="nav-text">Orders</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('orders.index')}}">Orders</a></li>
                        </ul>

                    </li>
                    <li class="nav-label">Items</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-options menu-icon"></i><span class="nav-text">Items</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('items.index')}}">Items</a></li>
                            <li><a href="{{route('items.create')}}">Add Item</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">Locations</li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-location-pin menu-icon"></i><span class="nav-text">States</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('state.index')}}">States</a></li>
                            <li><a href="{{route('state.create')}}">Add State</a></li>
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-directions menu-icon"></i><span class="nav-text">Locations</span>
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

                    <li class="nav-label">Mcsonia Accounting</li>
                    <li >
                        <a  href="{{route('accounts.index')}}" aria-expanded="false">
                            <i class="icon-calculator menu-icon"></i><span class="nav-text">Chart of Accounts</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-credit-card menu-icon"></i><span class="nav-text">Finances</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('finances.index')}}">Finances</a></li>
                            <li><a href="{{route('finances.create')}}">Add Finance</a></li>
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-chart menu-icon"></i><span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('reports.cash-flow')}}">Cash flow</a></li>
                            <li class="d-none"><a href="{{route('reports.sales-report')}}">Sales Report</a></li>
                            <li><a href="{{route('reports.profit-loss')}}">Profit Loss Report</a></li>
                            <li class="d-none"><a href="{{route('reports.balance-sheet')}}">Balance sheet</a></li>
                        </ul>
                    </li>
                    <li >
                        <a  href="{{route('transactions.index')}}" aria-expanded="false">
                            <i class="icon-calculator menu-icon"></i><span class="nav-text">Client Transactions</span>
                        </a>
                    </li>
                    <li >
                        <a  href="{{route('faqs.index')}}" aria-expanded="false">
                            <i class="icon-question menu-icon"></i><span class="nav-text">FAQ's</span>
                        </a>
                    </li>
                    @endif

                    <li class="nav-label">Messaging</li>
                    <li>
                        <a href="/chat" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span class="nav-text">Chat</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
