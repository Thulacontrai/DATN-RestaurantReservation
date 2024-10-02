<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <!-- logo begin -->
            <div id="logo">
                <a href="03_luxury-index.html">
                    <img class="logo logo_dark_bg" src="client/03_images/logo.png" alt="">
                    <img class="logo logo_light_bg" src="client/03_images/logo.png" alt="">
                </a>
            </div>
            <!-- logo close -->

            <!-- small button begin -->
            <span id="menu-btn"></span>
            <!-- small button close -->

            <!-- mainmenu begin -->
            <nav>
                <ul id="mainmenu">
                    <li><a href="{{ route('client.index') }}">Home</a></li>
                    <li><a href="{{ route('menu') }}">Menu</a></li>
                    <li><a href="{{ route('booking.client') }}">Booking</a></li>
                    <li><a href="{{ route('about.client') }}">About</a>
                        <ul>
                            <li><a href="{{ route('about.client') }}">About</a></li>
                            <li><a href="{{ route('gallery.client') }}">Gallery</a></li>
                        </ul>
                    </li>
            
                    @auth
                    <li><a href="{{ route('profile') }}">Profile</a></li>
                    <li>
                        <form action="{{ route('client.logout') }}" method="POST">
                            @csrf
                            <button type="submit">Đăng xuất</button>
                        </form>
                    </li>
                @else
                    <li><a href="#">Đăng nhập</a>
                        <ul>
                            <li><a href="{{ route('register.form') }}">Đăng ký</a></li>
                            <li><a href="{{ route('login.form') }}">Đăng nhập</a></li>
                        </ul>
                    </li>
                @endauth
            
                    <li><a href="{{ route('contact.client') }}">Contact</a></li>
                </ul>
            </nav>
            
            {{-- Debugging --}}
            <div style="display: none;">
                Is logged in: {{ var_export(auth()->check(), true) }}
                User: {{ auth()->user() ? auth()->user()->email : 'Not logged in' }}
            </div>


            <div class="clearfix"></div>
        </div>
        <!-- mainmenu close -->
    </div>
</div>


</div>
