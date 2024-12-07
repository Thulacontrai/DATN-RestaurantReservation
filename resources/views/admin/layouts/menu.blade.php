<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">
    <!-- Sidebar brand starts -->
    <div class="sidebar-brand">
        <a href="{{ url('admin') }}" class="logo">
            <img src="{{ asset('./client/03_images/logo.png') }}" alt="Admin Dashboards" />
        </a>
    </div>
    <!-- Sidebar brand ends -->

    <!-- Sidebar menu starts -->
    <div class="sidebar-menu">
        <div class="sidebarMenuScroll">
            <ul>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-house"></i>
                        <span class="menu-text">Thống kê</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.dashboard.index') }}">Phân tích</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.report.index') }}">Báo Cáo TT</a>
                            </li>

                        </ul>
                    </div>
                </li>


                @can('Xem bàn')
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="bi bi-window-split"></i>
                            <span class="menu-text">QL Bàn</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.table.index') }}"> DS bàn</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan
                @can('Xem đặt bàn')
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="bi bi-layers-half"></i>
                            <span class="menu-text">QL Đặt Bàn</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                @can('Xem đặt bàn')
                                    <li>
                                        <a href="{{ route('admin.reservation.index') }}">DS đặt bàn</a>
                                    </li>
                                @endcan
                                <li>

                                    {{-- <a href="{{ route('admin.calendar.index') }}">Lịch đặt bàn</a> --}}

                                    {{-- <a href="{{ route('admin.reservationTable.index') }}">Bàn đặt trước</a> --}}
                                </li>
                                {{-- @can('Xem lịch sử đặt bàn')
                                    <li>
                                        <a href="{{ route('admin.reservationHistory.index') }}">Lịch sử đặt bàn</a>
                                    </li>
                                @endcan --}}
                                @can('Xem QL hoàn tiền')
                                    <li>
                                        <a href="{{ route('admin.refunds.index') }}">QL hoàn tiền</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- QL danh mục --}}
                @can('Xem danh mục')

                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="bi bi-fire"></i>

                            <span class="menu-text">QL Thực Đơn</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.category.index') }}">DS thực đơn</a>
                                </li>
                                @can('Xem món ăn')
                                    <li>
                                        <a href="{{ route('admin.dishes.index') }}">DS món ăn</a>
                                    </li>
                                @endcan

                                @can('Xem combo')
                                    <li>
                                        <a href="{{ route('admin.combo.index') }}">DS combo</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan



                {{-- QL hóa đơn --}}
                @can('Xem order')
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="bi bi-clipboard-data"></i>
                            <span class="menu-text">QL Hoá đơn</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.order.index') }}">DS Hoá Đơn</a>
                                </li>

                                @can('Xem mã giảm giá')
                                    <li>
                                        <a href="{{ route('admin.coupon.index') }}">Phiếu giảm giá</a>
                                    </li>
                                @endcan
                                @can('Xem thanh toán')
                                    <li>
                                        <a href="{{ route('admin.payment.index') }}">PT Thanh Toán</a>
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
                            <span class="menu-text">QL người dùng</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                @can('Xem vai trò')
                                    <li>
                                        <a href="{{ route('admin.role.index') }}">DS vai trò</a>
                                    </li>
                                @endcan
                                @can('Xem quyền hạn')
                                    <li>
                                        <a href="{{ route('admin.permissions.index') }}">DS quyền hạn</a>
                                    </li>
                                @endcan
                                @can('Xem người dùng')
                                    <li>
                                        <a href="{{ route('admin.user.index') }}">DS người dùng</a>
                                    </li>
                                @endcan
                                @can('Xem feedback')
                                    <li>
                                        <a href="{{ route('admin.feedback.index') }}">DS phản hồi</a>
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
                            <span class="menu-text">QL kho NgLiệu</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                @can('Xem nhà cung cấp')
                                    <li>
                                        <a href="{{ route('admin.supplier.index') }}">Nhà cung cấp</a>
                                    <li>
                                    @endcan

                                    @can('Xem nguyên liệu')
                                    <li>
                                        <a href="{{ route('admin.ingredient.index') }}"> Nguyên Liệu</a>
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


                                {{-- <li>
                                    <a href="#">Xuất kho</a>
                                </li> --}}
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
