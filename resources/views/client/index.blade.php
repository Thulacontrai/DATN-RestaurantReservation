@extends('client.layouts.master')
@section('title', 'Trang chủ')
@section('content')
    <!-- content begin -->
    <div id="content" class="no-bottom no-top">

        <!-- parallax section -->
        <section id="section-slider" class="fullwidthbanner-container" aria-label="section-slider">
            <div id="revolution-slider">
                <ul>
                    <li data-transition="fade" data-slotamount="10" data-masterspeed="default" data-thumb="">
                        <!--  BACKGROUND IMAGE -->
                        <img src="client/03_images/slider/slide-1.jpg" alt="" data-bgposition="center center"
                            data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10">

                        <div class="tp-caption tp-teaser-1" data-x="center" data-y="160" data-width="none"
                            data-height="none" data-whitespace="nowrap"
                            data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:200;e:Power2.easeInOut;" data-start="500"
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <span class="id-color-2">Savor Perfection</span>
                        </div>

                        <div class="tp-caption" data-x="center" data-y="200" data-width="" data-height="none"
                            data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:400;e:Power2.easeInOut;" data-start="600"
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <img src="client/03_images/misc/separator.svg" class="img-fluid" alt="">
                        </div>

                        <div class="tp-caption tp-title-1 text-center" data-x="center" data-y="225" data-width="700"
                            data-height="none" data-whitespace="wrap"
                            data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:400;e:Power2.easeInOut;" data-start="600"
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            Experience Flavorful Creations
                        </div>

                        <div class="tp-caption text-center tp-text-1" data-x="center" data-y="400" data-width="600"
                            data-height="none" data-whitespace="wrap"
                            data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:600;e:Power2.easeInOut;" data-start="700">
                            Where artistry meets expertise to create a symphony of flavor.
                        </div>

                        <div class="tp-caption" data-x="center" data-y="470" data-width="none" data-height="none"
                            data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:800;e:Power2.easeInOut;" data-start="800">
                            <a href="{{ route('menu.client') }}" class="btn-line">View Menu</a>
                        </div>
                    </li>

                    <li data-transition="fade" data-slotamount="10" data-masterspeed="default" data-thumb="">
                        <!--  BACKGROUND IMAGE -->
                        <img src="client/03_images/slider/slide-2.jpg" alt="" data-bgposition="center center"
                            data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10">

                        <div class="tp-caption tp-teaser-1" data-x="center" data-y="160" data-width="none"
                            data-height="none" data-whitespace="nowrap"
                            data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:200;e:Power2.easeInOut;" data-start="500"
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <span class="id-color-2">Flavors to Satisfy</span>
                        </div>

                        <div class="tp-caption" data-x="center" data-y="200" data-width="" data-height="none"
                            data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:400;e:Power2.easeInOut;" data-start="600"
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <img src="client/03_images/misc/separator.svg" class="img-fluid" alt="">
                        </div>

                        <div class="tp-caption tp-title-1 text-center" data-x="center" data-y="225" data-width="700"
                            data-height="none" data-whitespace="wrap"
                            data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:400;e:Power2.easeInOut;" data-start="600"
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            Where Flavor Meets Elegance
                        </div>

                        <div class="tp-caption text-center tp-text-1" data-x="center" data-y="400" data-width="600"
                            data-height="none" data-whitespace="wrap"
                            data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:600;e:Power2.easeInOut;" data-start="700">
                            Prepare your palate for an unforgettable dining experience.
                        </div>

                        <div class="tp-caption" data-x="center" data-y="470" data-width="none" data-height="none"
                            data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:800;e:Power2.easeInOut;" data-start="800">
                            <a href="#" class="btn-line">View Menu</a>
                        </div>
                    </li>

                </ul>
            </div>
        </section>
        <!-- parallax section close -->
        <!-- section begin -->
        <section>
            <div class="container">
                <div class="row aligns-item-center">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="text-center">
                            <h5 class="uptitle wow fadeInUp">Be ready for</h5>
                            <h2 class="wow fadeInUp">Memorable Moments</h2>
                            <p class="lead wow fadeInUp">From exquisite dishes to delightful ambiance, our grand
                                opening promises an unforgettable dining experience.</p>
                            <div class="spacer-single"></div>
                        </div>
                    </div>
                </div>

                <div class="row g-4 text-center">
                    <div class="col-lg-4 wow fadeInRight">
                        <div class="p-4 jarallax" data-jarallax data-speed="0.1">
                            <img src="client/03_images/misc/1.jpg" class="jarallax-img" alt="">
                            <img src="client/03_images/misc/icon-1.png" alt="">
                            <div class="spacer-single"></div>
                            <h3>Aromatic Taste</h3>
                            <p>Rich, inviting, and utterly tantalizing, the aromatic taste of coffee is a sensory
                                journey that begins with the first whiff.</p>
                            <a href="{{ route('blog.client') }}" class="btn-line">Read More</a>
                        </div>
                    </div>

                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".1s">
                        <div class="p-4 jarallax" data-jarallax data-speed="0.1">
                            <img src="client/03_images/misc/2.jpg" class="jarallax-img" alt="">
                            <img src="client/03_images/misc/icon-2.png" alt="">
                            <div class="spacer-single"></div>
                            <h3>Delicious Foods</h3>
                            <p>From the first tantalizing aroma to the last lingering taste, our menu is a
                                celebration of diverse cuisines and bold creativity. </p>
                            <a href="{{ route('blog.client') }}" class="btn-line">Read More</a>
                        </div>
                    </div>

                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".2s">
                        <div class="p-4 jarallax" data-jarallax data-speed="0.1">
                            <img src="client/03_images/misc/3.jpg" class="jarallax-img" alt="">
                            <img src="client/03_images/misc/icon-3.png" alt="">
                            <div class="spacer-single"></div>
                            <h3>Make Your Party</h3>
                            <p>Transforming our cozy café into the ultimate party destination, where friends gather,
                                laughter flows, and memories are made.</p>
                            <a href="{{ route('blog.client') }}" class="btn-line">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->


        <section data-bgcolor="rgba(255, 255, 255, .05)">
            <div class="container">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <h5 class="uptitle wow fadeInUp">Discover</h5>
                        <h2 class="wow fadeInUp">Our Story</h2>
                        <p class="lead wow fadeInUp">At "Baresto," we believe in the power of good coffee and warm
                            hospitality. Our journey began with a simple vision: to create a welcoming space where
                            friends, families, and strangers alike could come together to enjoy delicious beverages,
                            homemade treats, and meaningful connections.</p>

                        <p class="wow fadeInUp">As a proud member of the community, we're committed to giving back
                            and making a positive impact wherever we can. From supporting local artisans and farmers
                            to hosting events that celebrate diversity and inclusion, we believe in using our
                            platform to spread joy and goodwill in our neighborhood and beyond.</p>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6">
                                <img src="client/03_images/misc/4.jpg" class="img-fluid wow zoomIn" alt="">
                            </div>
                            <div class="col-6">
                                <img src="client/03_images/misc/5.jpg" class="img-fluid wow zoomIn" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <h5 class="uptitle wow fadeInUp">22,000+</h5>
                        <h2 class="wow fadeInUp">Happy Customers</h2>
                        <p class="lead wow fadeInUp">Happy diners, happy hearts! Join the delighted ranks of our
                            satisfied customers and experience culinary excellence like never before.</p>
                    </div>
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay="0s">
                        <div class="de-review-app h-100">
                            <div class="d-logo">
                                <img src="client/03_images/reviews/google.png" class="" alt="">
                            </div>
                            <div class="d-testi">
                                An absolute gem! The food was exquisite, service impeccable, and ambiance
                                delightful. Can't wait to return!
                            </div>
                            <div class="d-testi-by">Karyn Deely<span>Jan 20, 2024</span></div>
                            <div class="d-stars">
                                <img src="client/03_images/reviews/google-stars.png" class="" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".1s">
                        <div class="de-review-app h-100">
                            <div class="d-logo">
                                <img src="client/03_images/reviews/trustpilot.png" class="" alt="">
                            </div>
                            <div class="d-testi">
                                Absolutely phenomenal! The chef's dedication to quality ingredients shines through
                                in every dish.
                            </div>
                            <div class="d-testi-by">Josefa Devany<span>Jan 20, 2024</span></div>
                            <div class="d-stars">
                                <img src="client/03_images/reviews/trustpilot-stars.svg" class="" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".2s">
                        <div class="de-review-app h-100">
                            <div class="d-logo">
                                <img src="client/03_images/reviews/google.png" class="" alt="">
                            </div>
                            <div class="d-testi">
                                An unforgettable dining experience. Every course was a delightful surprise,
                                perfectly complemented by impeccable service.
                            </div>
                            <div class="d-testi-by">Samual Stein<span>Jan 20, 2024</span></div>
                            <div class="d-stars">
                                <img src="client/03_images/reviews/google-stars.png" class="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="position-relative" data-bgcolor="rgba(255, 255, 255, .05)">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-5 offset-lg-7">
                        <h5 class="uptitle">Favorite</h5>
                        <h2>Drinks</h2>

                        <div class="menu-item thead">
                            <div class="c1"></div>
                            <div class="c2">Medium<span>16 oz</span></div>
                            <div class="c3">Large<span>20 oz</span></div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Espresso<span>Espresso, where passion meets perfection.</span></div>
                            <div class="c2">1.75</div>
                            <div class="c3">2.20</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Mocchiato<span>The perfect harmony of espresso and sweetness</span>
                            </div>
                            <div class="c2">1.94</div>
                            <div class="c3">2.25</div>
                        </div>

                        <div class="menu-item">
                            <div class="c1">Classic Cappucino<span>A timeless delight brewed just for you.</span>
                            </div>
                            <div class="c2">2.90</div>
                            <div class="c3">3.90</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Cappucino<span>Where rich espresso meets frothy perfection.</span></div>
                            <div class="c2">3.15</div>
                            <div class="c3">4.15</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Mocha latte<span>The perfect blend of chocolate and espresso.</span>
                            </div>
                            <div class="c2">3.45</div>
                            <div class="c3">4.35</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Caramel late<span>Where smooth espresso meets golden caramel
                                    bliss.</span></div>
                            <div class="c2">3.45</div>
                            <div class="c3">4.35</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Cafe americano<span>The essence of pure coffee bliss.</span></div>
                            <div class="c2">2.25</div>
                            <div class="c3">3.50</div>
                        </div>

                        <div class="spacer-single"></div>

                        <a href="{{ route('menu.client') }}" class="btn-line">View All Menu</a>
                    </div>
                </div>
            </div>

            <div class="image-container col-lg-6 h-100 top-0 jarallax" data-speed="-.2">
                <img src="client/03_images/background/bg-side-1.jpg" class="jarallax-img" alt="">
            </div>
        </section>

        <section class="position-relative" data-bgcolor="rgba(255, 255, 255, .05)">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-5">
                        <h5 class="uptitle">Favorite</h5>
                        <h2>Foods</h2>

                        <div class="menu-item">
                            <div class="c1">Plain bread<span>Soft and golden with a tantalizing aroma</span></div>
                            <div class="c2"></div>
                            <div class="c3">2.75</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Milk bread<span>Infused with the richness of milk</span></div>
                            <div class="c2"></div>
                            <div class="c3">2.75</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Sandwich bread<span>Classic combinations like ham and cheese</span>
                            </div>
                            <div class="c2"></div>
                            <div class="c3">2.75</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Brown bread<span>Crafted from whole grain flour</span></div>
                            <div class="c2"></div>
                            <div class="c3">2.75</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Garlic bread<span>Infused with aromatic garlic and rich butter</span>
                            </div>
                            <div class="c2"></div>
                            <div class="c3">2.75</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Wheat bread<span>With hearty texture and nutty flavor</span></div>
                            <div class="c2"></div>
                            <div class="c3">2.75</div>
                        </div>


                        <div class="menu-item">
                            <div class="c1">Bannana bread<span>With its banana taste and delightful aroma</span>
                            </div>
                            <div class="c2"></div>
                            <div class="c3">2.75</div>
                        </div>

                        <div class="menu-item">
                            <div class="c1">Burger bun<span>With fluffy texture and subtle sweetness</span></div>
                            <div class="c2"></div>
                            <div class="c3">2.75</div>
                        </div>

                        <div class="spacer-single"></div>

                        <a href="{{ route('menu.client') }}" class="btn-line">View All Menu</a>
                    </div>
                </div>
            </div>

            <div class="image-container col-lg-6 offset-lg-6 h-100 top-0 jarallax" data-speed="-.2">
                <img src="client/03_images/background/bg-side-2.jpg" class="jarallax-img" alt="">
            </div>
        </section>

        @include('client.layouts.component.chefs')


        <section class="side-bg no-top no-bottom text-light" aria-label="section"
            data-bgcolor="rgba(255, 255, 255, .05)">
            <div class="col-lg-6 pull-right image-container jarallax">
                <img src="client/03_images/background/bg-side-3.jpg" class="jarallax-img" alt="">
            </div>

            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="padding80">
                            <div class="text-center">
                                <h5 class="uptitle wow fadeInUp">Customers</h5>
                                <h2 class="wow fadeInUp">Review</h2>
                                <div class="spacer-single"></div>
                            </div>
                            <blockquote>
                                As a busy professional, I rely on my morning coffee to kickstart my day. The rich,
                                smooth taste and heavenly aroma never fail to perk me up and get me ready to tackle
                                whatever the day throws at me. It's like a little slice of heaven in a cup!
                                <span>Jenna Smith</span>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- section begin -->
        <section id="cta" aria-label="cta" class="call-to-action">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-9 text-lg-start text-sm-center wow fadeIn">
                        <h3><i class="id-color fa fa-phone mr10"></i>Call us now and get special offers!</h3>
                    </div>

                    <div class="col-lg-3 text-lg-end text-sm-center wow fadeIn" data-wow-delay=".2s">
                        <a href="{{ route('booking.client') }}" class="btn-line">Call Us Now</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section id="section-title-1" class="text-light jarallax">
            <img src="client/03_images/background/bg-6.jpg" class="jarallax-img" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h5 class="uptitle wow fadeInUp">We are</h5>
                            <h2 class="wow fadeInUp">Open</h2>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay="0s">
                        <div class="text-center">
                            <span class="id-color-2 bold">Mon - Thu</span>
                            <div class="fs20">10:30AM - 9:30PM</div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".1s">
                        <div class="text-center">
                            <span class="id-color-2 bold">Friday</span>
                            <div class="fs20">10:00AM - 10:30PM</div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".2s">
                        <div class="text-center">
                            <span class="id-color-2 bold">Sat - Sun</span>
                            <div class="fs20">09:30AM - 11:00PM</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
