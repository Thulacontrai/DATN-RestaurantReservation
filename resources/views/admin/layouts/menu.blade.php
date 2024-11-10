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
                        <span class="menu-text">Dashboards</span>
                    </a>
                </li>
                {{-- @can('Xem danh mục') --}}
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-window-split"></i>
                        <span class="menu-text">Quản lý bàn</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.table.index') }}">Danh sách bàn</a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- @endcan --}}

                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-layers-half"></i>
                        <span class="menu-text">Quản lý đặt bàn</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.reservation.index') }}">Danh sách đặt bàn</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.reservationTable.index') }}">Bàn đặt trước</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.reservationHistory.index') }}">Lịch sử đặt bàn</a>
                            </li>

                        </ul>
                    </div>
                </li>



                @can('Xem danh mục')


                {{-- @can('Xem và quản lý danh mục') --}}

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
                        </ul>
                    </div>
                </li>
                {{-- @endcan --}}

                @endcan


                @can('Xem món ăn')
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-journal-bookmark-fill"></i>
                        <span class="menu-text"> Quản lý Món ăn</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.dishes.index') }}">Danh sách món</a>
                            </li>

                        </ul>
                    </div>
                </li>
                @endcan

                @can('Xem combo')
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-boxes"></i>
                        <span class="menu-text">Quản lý Combo </span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.combo.index') }}">Danh sách combo</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                @can('Xem thanh toán')
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-clipboard-check"></i>
                        <span class="menu-text">Quản lý Payment</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.payment.index') }}">Danh sách Payment</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                @can('Xem mã giảm giá')
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-receipt-cutoff"></i>
                        <span class="menu-text">Quản lý Coupons</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.coupon.index') }}">Danh sách coupon</a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                @can('Xem order')
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-clipboard-data"></i>
                        <span class="menu-text">Quản lý Order</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.order.index') }}">Danh sách Order</a>

                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                @can('Xem feedback')
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-person-workspace"></i>
                        <span class="menu-text">Quản lý Feedback</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.feedback.index') }}">Danh sách Feedback</a>

                            </li>
                        </ul>
                    </div>
                </li>
                @endcan

                {{-- <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-person-workspace"></i>
                        <span class="menu-text">Quản lý nhân viên</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="">Danh sách nhân viên</a>

                            </li>
                        </ul>
                    </div>
                </li> --}}



                @can('Xem người dùng')


                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-people-fill"></i>
                        <span class="menu-text">Quản lý người dùng</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.role.index') }}">Vai trò</a>

                            </li>
                            <li>
                                <a href="{{ route('admin.permissions.index') }}">Quyền hạn</a>

                            </li>
                            <li>
                                <a href="{{ route('admin.user.index') }}">Danh sách người dùng</a>

                            </li>

                        </ul>
                    </div>
                </li>
                {{-- @endcan --}}


                @endcan

                

                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="bi bi-pci-card"></i>
                        <span class="menu-text">Quản lý kho Ng-liệu</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="{{ route('admin.supplier.index') }}">Nhà cung cấp</a>
                            <li>
                            <li>
                                <a href="{{ route('admin.ingredientType.index')}}">Loại Nguyên Liệu</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.ingredient.index')}}">Danh sách Nguyên Liệu</a>
                            </li>
                            <li>
                                <a href="#">Phiếu nhập kho</a>
                            </li>
                            <li>
<<<<<<< HEAD
                                <a href="{{ route('admin.inventory.index') }}">Hàng tồn kho</a>
=======
                                <a href="#">Combo món ăn</a>
                            </li>
                            <li>
                                <a href="#">Hàng tồn kho</a>
>>>>>>> 5cc51a89bb95b5109df530d2307b9d681decb08e
                            </li>
                            <li>
                                <a href="#">Xuất kho</a>
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
