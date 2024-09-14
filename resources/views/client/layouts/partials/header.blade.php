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
                    <li><a href="{{ route('blog.client') }}">Blog</a></li>
                    <li><a href="{{ route('contact.client') }}">Contact</a></li>
                </ul>
            </nav>
            <div class="clearfix"></div>
        </div>
        <!-- mainmenu close -->
    </div>

</div>

