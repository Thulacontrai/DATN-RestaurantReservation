<div class="page-header">
    <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>

    <ol class="breadcrumb d-md-flex d-none">
        <li class="breadcrumb-item">
            <i class="bi bi-house"></i>
            <a href="{{ url('admin') }}">Home</a>
        </li>
        <div class="header-actions-container m-4">
            @can('access pos')
            <div class="header-pos-action">
                <a href="{{ route('pos.index') }}" class="btn btn-primary" style="margin-right: 10px;">
                    <i class="bi bi-cash-coin"></i> Chuyển đến POS
                </a>
            </div>
            @endcan
    </ol>




    <div class="header-actions-container">
        <div class="search-container">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search anything">
                <button class="btn" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        <a href="{{ route('admin.inventory.index')}}" class="leads d-none d-xl-flex">
            <div class="lead-details">Bạn có <span class="count"> 21 </span> hàng tồn kho </div>
            <span class="lead-icon"><i class="bi bi-bell-fill animate__animated animate__swing animate__infinite infinite"></i><b class="dot animate__animated animate__heartBeat animate__infinite"></b></span>
        </a>
        <ul class="header-actions">
            <li class="dropdown">

                <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                    <span class="">{{ Auth::user()->name}} ({{Auth::user()->roles->pluck('name')->implode(' , ')}})</span>
                    <span class="avatar">
                        <img src="{{ asset('adminn/assets/images/user2.png') }}" alt="Admin Templates">
                        <span class="status online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userSettings">
                    <div class="header-profile-actions">
                        <a href="{{ route('admin.accountSetting.index') }}">Settings</a>

                        <!-- Form Logout -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ url('/') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </div>
                </div>

            </li>
        </ul>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Thư viện jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Thư viện OverlayScrollbars CSS và JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/css/OverlayScrollbars.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/jquery.overlayScrollbars.min.js"></script>

<!-- Tệp custom-scrollbar.js -->
<script src="path/to/custom-scrollbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
