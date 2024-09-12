@extends('client.layouts.master')
@section('title', 'About')

@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-3.jpg',
        'subtitle' => 'Discover',
        'title' => 'Our Story',
        'currentPage' => 'About',
    ])
    <div id="content" class="no-bottom no-top">
        <!-- section begin -->
        <section>
            <div class="container">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <h2>How It Begins</h2>
                        <div class="spacer-half"></div>
                        <p class="lead">At "Baresto," we believe in the power of good coffee and warm hospitality. Our
                            journey began with a simple vision: to create a welcoming space where friends, families, and
                            strangers alike could come together to enjoy delicious beverages, homemade treats, and
                            meaningful connections.</p>

                        <p>Nestled in the heart of our community, "Baresto" is more than just a café; it's a gathering
                            place, a refuge from the chaos of everyday life, and a beacon of positivity and warmth. From the
                            moment you walk through our doors, you're greeted with the inviting aroma of freshly brewed
                            coffee and the friendly smiles of our dedicated team. Our menu is a reflection of our commitment
                            to quality and creativity. We source the finest beans from around the world and carefully craft
                            each cup with precision and care. Whether you're craving a classic espresso, a creamy latte, or
                            a refreshing iced tea, we have something to delight every palate.</p>

                        <p>As a proud member of the community, we're committed to giving back and making a positive impact
                            wherever we can. From supporting local artisans and farmers to hosting events that celebrate
                            diversity and inclusion, we believe in using our platform to spread joy and goodwill in our
                            neighborhood and beyond.</p>
                    </div>

                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-6">
                                <img src="client/03_images/misc/4.jpg" class="img-fluid mb-4 wow zoomIn" alt="">
                                <div class="de_count wow fadeInUp">
                                    <h3><span class="timer" data-to="750" data-speed="3000"></span>+</h3>
                                    <h4>Positive feedbacks</h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="de_count wow fadeInUp">
                                    <h3><span class="timer" data-to="50" data-speed="3000"></span>%</h3>
                                    <h4>Turnover increased</h4>
                                </div>
                                <div class="spacer-10"></div>
                                <img src="client/03_images/misc/5.jpg" class="img-fluid mt-4 wow zoomIn" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        @include('client.layouts.component.chefs')

    </div>
@endsection
