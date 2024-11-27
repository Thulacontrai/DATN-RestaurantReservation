<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">
    <!-- Sidebar brand starts -->
    <div class="sidebar-brand">
        <a href="{{ url('admin') }}" class="logo">
            <img src="{{ asset('adminn/assets/images/logo.svg') }}" alt="Admin Dashboards" />
        </a>
    </div>
    <!-- Sidebar brand ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebar-menu">
        <div class="sidebarMenuScroll">
            <ul>
                <li class="sidebar-dropdown active">
                    <a href="{{ route('admin.dashboard.index') }}">
                        <i class="bi bi-house"></i>
                        @can('Xem thống kê')
                            <span class="menu-text">Thống kê</span>
                        @endcan
                    </a>
                </li>


                @can('Xem bàn')
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="bi bi-window-split"></i>
                            <span class="menu-text">Quản lý bàn</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.table.index') }}">Danh sách bàn</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
                
                @can('Xem đặt bàn')
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="bi bi-layers-half"></i>
                            <span class="menu-text">Quản lý đặt bàn</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                @can('Xem đặt bàn')
                                    <li>
                                        <a href="{{ route('admin.reservation.index') }}">Danh sách đặt bàn</a>
                                    </li>
                                @endcan
                                <li>
                                 
                                <a href="{{ route('admin.calendar.index') }}">Lịch đặt bàn</a>
                            
                                    {{-- <a href="{{ route('admin.reservationTable.index') }}">Bàn đặt trước</a> --}}
                                </li>
                                @can('Xem lịch sử đặt bàn')
                                    <li>
                                        <a href="{{ route('admin.reservationHistory.index') }}">Lịch sử đặt bàn</a>
                                    </li>
                                @endcan
                                @can('Xem quản lý hoàn tiền')
                                    <li>
                                        <a href="{{ route('admin.refunds.index') }}">Quản lý hoàn tiền</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- Quản lý danh mục --}}
                @can('Xem danh mục')

                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="bi bi-folder"></i>
                            <span class="menu-text">Quản lý Danh Mục</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.category.index') }}">Danh Mục</a>
                                </li>
                                @can('Xem món ăn')
                                    <li>
                                        <a href="{{ route('admin.dishes.index') }}">Danh sách món</a>
                                    </li>
                                @endcan

                                @can('Xem combo')
                                    <li>
                                        <a href="{{ route('admin.combo.index') }}">Danh sách combo</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan



                {{-- Quản lý hóa đơn --}}
                @can('Xem order')
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="bi bi-clipboard-data"></i>
                            <span class="menu-text">Quản lý Hoá đơn</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.order.index') }}">Danh sách Order</a>
                                </li>

                                @can('Xem mã giảm giá')
                                    <li>
                                        <a href="{{ route('admin.coupon.index') }}">Danh sách coupon</a>
                                    </li>
                                @endcan
                                @can('Xem thanh toán')
                                    <li>
                                        <a href="{{ route('admin.payment.index') }}">Danh sách Payment</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan


                @can('Xem người dùng')
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="bi bi-people-fill"></i>
                            <span class="menu-text">Quản lý người dùng</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                @can('Xem vai trò')
                                    <li>
                                        <a href="{{ route('admin.role.index') }}">Vai trò</a>
                                    </li>
                                @endcan
                                @can('Xem quyền hạn')
                                    <li>
                                        <a href="{{ route('admin.permissions.index') }}">Quyền hạn</a>
                                    </li>
                                @endcan
                                @can('Xem người dùng')
                                    <li>
                                        <a href="{{ route('admin.user.index') }}">Danh sách người dùng</a>
                                    </li>
                                @endcan
                                @can('Xem feedback')
                                    <li>
                                        <a href="{{ route('admin.feedback.index') }}">Danh sách Feedback</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcan



                @can('Xem nguyên liệu')
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="bi bi-pci-card"></i>
                            <span class="menu-text">Quản lý kho Nguyên Liệu</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                @can('Xem nhà cung cấp')
                                    <li>
                                        <a href="{{ route('admin.supplier.index') }}">Nhà cung cấp</a>
                                    <li>
                                    @endcan
                                <li>
                                    {{-- <a href="{{ route('admin.ingredientType.index') }}">Loại Nguyên Liệu</a> --}}
                                </li>
                                @can('Xem nguyên liệu')
                                    <li>
                                        <a href="{{ route('admin.ingredient.index') }}">Danh sách Nguyên Liệu</a>
                                    </li>
                                @endcan
                                @can('Xem nhập kho')
                                    <li>
                                        <a href="{{ route('transactions.index') }}">
                                            <span class="menu-text">Phiếu nhập kho</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('Xem tồn kho')
                                    <li>
                                        <a href="{{ route('admin.inventory.index') }}">Hàng tồn kho</a>
                                    </li>
                                @endcan

                                <li>
                                    <a href="#">Xuất kho</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
    <!-- Sidebar menu ends -->
</nav>
<!-- Sidebar wrapper end -->
