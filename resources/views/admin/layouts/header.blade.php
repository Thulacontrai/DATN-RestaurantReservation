<div class="page-header">
    <div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>

    <ol class="breadcrumb d-md-flex d-none">
        <li class="breadcrumb-item">
            <i class="bi bi-house"></i>
            <a href="{{ url('admin') }}">Home</a>
        </li>
        <li class="breadcrumb-item breadcrumb-active" aria-current="page">Sales</li>
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
                        {{-- <a href="#">Profile</a> --}}
                        <a href="{{ route('admin.accountSetting.index')}}">Settings</a>
                        <a href="login">Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
