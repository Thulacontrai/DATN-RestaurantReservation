<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">
    <!-- Sidebar brand starts -->
    <div class="sidebar-brand">
        <a href="{{ url('admin') }}" class="logo">
            <img src="../../adminn/assets/images/logo.svg" alt="Admin Dashboards" />
        </a>
    </div>
    <!-- Sidebar brand ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebar-menu">
        <div class="sidebarMenuScroll">
            <ul>
                <li class="sidebar-dropdown active">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="bi bi-house"></i>
                        <span class="menu-text">Dashboards</span>
                    </a>
                   {{-- <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('dashboard.index') }}" class="current-page">Analytics</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/reports') }}">Reports</a>
                            </li>
                        </ul>
                    </div> --}}
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-handbag"></i>
                        <span class="menu-text">Product</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('product.index') }}">Product List</a>
                            </li>

                            <li>
                                <a href="{{ route('product.create') }}">AddProducts</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-stickies"></i>
                        <span class="menu-text">Cart</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('cart.show', ['cart' => 1]) }}">Billing Details</a>
                            </li>
                            <li>
                                <a href="{{ route('cart.index') }}">Shopping Cart</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-gem"></i>
                        <span class="menu-text">Widgets</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ url('admin/widgets') }}">Widgets</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/graph-widgets') }}">Graph Widgets</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-stickies"></i>
                        <span class="menu-text">Pages</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ url('admin/profile') }}">Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('page.edit', ['page' => 1]) }}">Account Settings</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-columns-gap"></i>
                        <span class="menu-text">Forms</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ url('admin/form-inputs') }}">Form Inputs</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/form-checkbox-radio') }}">Checkbox &amp; Radio</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/form-file-input') }}">File Input</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-gem"></i>
                        <span class="menu-text">Customers</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('customer.index') }}">DS Customer</a>
                            <li>
                                <a href="{{ url('admin/graph-widgets') }}">Graph Widgets</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-window-split"></i>
                        <span class="menu-text">Tables</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ url('admin/tables') }}">Tables</a>
                            </li>
                            <li>
                                <a href="{{ url('admin/data-tables') }}">Data Tables</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- Sidebar menu ends -->
</nav>
<!-- Sidebar wrapper end -->
