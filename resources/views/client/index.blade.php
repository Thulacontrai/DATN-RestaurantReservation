@extends('client.layouts.master')
@section('title', 'Trang chủ')
@section('content')
    <!-- nội dung bắt đầu -->
    <div id="content" class="no-bottom no-top">

        <!-- phần parallax -->
        <section id="section-slider" class="fullwidthbanner-container" aria-label="section-slider">
            <div id="revolution-slider">
                <ul>
                    <li data-transition="fade" data-slotamount="10" data-masterspeed="default" data-thumb="">
                        <!--  ẢNH NỀN -->
                        <img src="client/03_images/slider/slide-1.jpg" alt="" data-bgposition="center center"
                            data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10">

                        <div class="tp-caption tp-teaser-1" data-x="center" data-y="160" data-width="none"
                            data-height="none" data-whitespace="nowrap"
                            data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:200;e:Power2.easeInOut;" data-start="500"
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <span class="id-color-2">Thưởng thức sự hoàn hảo</span>
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
                            Trải nghiệm sáng tạo hương vị
                        </div>

                        <div class="tp-caption text-center tp-text-1" data-x="center" data-y="400" data-width="600"
                            data-height="none" data-whitespace="wrap"
                            data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:600;e:Power2.easeInOut;" data-start="700">
                            Nơi nghệ thuật gặp gỡ chuyên môn để tạo ra một bản hòa tấu của hương vị.
                        </div>

                        <div class="tp-caption" data-x="center" data-y="470" data-width="none" data-height="none"
                            data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:800;e:Power2.easeInOut;" data-start="800">
                            <a href="{{ route('menu') }}" class="btn-line">Xem thực đơn</a>
                        </div>
                    </li>

                    <li data-transition="fade" data-slotamount="10" data-masterspeed="default" data-thumb="">
                        <!--  ẢNH NỀN -->
                        <img src="client/03_images/slider/slide-2.jpg" alt="" data-bgposition="center center"
                            data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10">

                        <div class="tp-caption tp-teaser-1" data-x="center" data-y="160" data-width="none"
                            data-height="none" data-whitespace="nowrap"
                            data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:200;e:Power2.easeInOut;" data-start="500"
                            data-splitin="none" data-splitout="none" data-responsive_offset="on">
                            <span class="id-color-2">Hương vị thỏa mãn</span>
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
                            Nơi hương vị gặp gỡ sự sang trọng
                        </div>

                        <div class="tp-caption text-center tp-text-1" data-x="center" data-y="400" data-width="600"
                            data-height="none" data-whitespace="wrap"
                            data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:600;e:Power2.easeInOut;" data-start="700">
                            Chuẩn bị vị giác của bạn cho một trải nghiệm ẩm thực khó quên.
                        </div>

                        <div class="tp-caption" data-x="center" data-y="470" data-width="none" data-height="none"
                            data-whitespace="nowrap" data-transform_in="y:100px;opacity:0;s:500;e:Power2.easeOut;"
                            data-transform_out="opacity:0;y:-100;s:800;e:Power2.easeInOut;" data-start="800">
                            <a href="#" class="btn-line">Xem thực đơn</a>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- phần parallax đóng -->

        <!-- Phần mô tả ngắn -->
        <section>
            <div class="container">
                <div class="row aligns-item-center">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="text-center">
                            <h5 class="uptitle wow fadeInUp">Hãy sẵn sàng cho</h5>
                            <h2 class="wow fadeInUp">Những khoảnh khắc đáng nhớ</h2>
                            <p class="lead wow fadeInUp">Từ các món ăn tinh tế đến không gian ấm cúng, buổi khai trương của
                                chúng tôi hứa hẹn sẽ mang lại một trải nghiệm ẩm thực không thể quên.</p>
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
                            <h3>Hương vị thơm ngon</h3>
                            <p>Đậm đà, lôi cuốn và đầy kích thích, hương vị của cà phê là một hành trình cảm giác bắt đầu từ
                                lần ngửi đầu tiên.</p>
                            <a href="{{ route('blog.client') }}" class="btn-line">Đọc thêm</a>
                        </div>
                    </div>

                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".1s">
                        <div class="p-4 jarallax" data-jarallax data-speed="0.1">
                            <img src="client/03_images/misc/2.jpg" class="jarallax-img" alt="">
                            <img src="client/03_images/misc/icon-2.png" alt="">
                            <div class="spacer-single"></div>
                            <h3>Món ăn ngon miệng</h3>
                            <p>Từ hương vị đầu tiên đến dư vị cuối cùng, thực đơn của chúng tôi là sự tôn vinh các nền ẩm
                                thực đa dạng và sáng tạo táo bạo.</p>
                            <a href="{{ route('blog.client') }}" class="btn-line">Đọc thêm</a>
                        </div>
                    </div>

                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".2s">
                        <div class="p-4 jarallax" data-jarallax data-speed="0.1">
                            <img src="client/03_images/misc/3.jpg" class="jarallax-img" alt="">
                            <img src="client/03_images/misc/icon-3.png" alt="">
                            <div class="spacer-single"></div>
                            <h3>Tổ chức tiệc</h3>
                            <p>Biến quán cà phê ấm cúng của chúng tôi thành địa điểm tổ chức tiệc tuyệt vời, nơi bạn bè quây
                                quần, tiếng cười vang vọng và những kỷ niệm được tạo nên.</p>
                            <a href="{{ route('blog.client') }}" class="btn-line">Đọc thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- phần "Câu chuyện của chúng tôi" -->
        <section data-bgcolor="rgba(255, 255, 255, .05)">
            <div class="container">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <h5 class="uptitle wow fadeInUp">Khám phá</h5>
                        <h2 class="wow fadeInUp">Câu chuyện của chúng tôi</h2>
                        <p class="lead wow fadeInUp">Tại "Baresto", chúng tôi tin tưởng vào sức mạnh của cà phê ngon và sự
                            hiếu khách ấm áp. Hành trình của chúng tôi bắt đầu với một tầm nhìn đơn giản: tạo ra một không
                            gian chào đón, nơi bạn bè, gia đình và những người lạ có thể đến và tận hưởng những món đồ uống
                            ngon lành, bánh ngọt tự làm và những kết nối ý nghĩa.</p>

                        <p class="wow fadeInUp">Là một thành viên tự hào của cộng đồng, chúng tôi cam kết đóng góp và tạo
                            ra tác động tích cực mọi nơi chúng tôi có thể. Từ việc hỗ trợ các nghệ nhân và nông dân địa
                            phương đến việc tổ chức các sự kiện tôn vinh sự đa dạng và hòa nhập, chúng tôi tin tưởng vào
                            việc sử dụng nền tảng của mình để lan tỏa niềm vui và thiện chí trong khu phố và xa hơn nữa.</p>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6">
                                <img src="client/03_images/background/bg-side-15.jpg" class="img-fluid wow zoomIn"
                                    alt="">
                            </div>
                            <div class="col-6">
                                <img src="client/03_images/background/bg-side-17.jpg" class="img-fluid wow zoomIn"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Phần khách hàng hạnh phúc -->
        <section>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6 offset-lg-3 text-center">
                        <h5 class="uptitle wow fadeInUp">22,000+</h5>
                        <h2 class="wow fadeInUp">Khách hàng hạnh phúc</h2>
                        <p class="lead wow fadeInUp">Khách hàng hài lòng, trái tim hạnh phúc! Tham gia vào hàng ngũ khách
                            hàng thỏa mãn của chúng tôi và trải nghiệm ẩm thực tuyệt vời như chưa từng có.</p>
                    </div>
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay="0s">
                        <div class="de-review-app h-100">
                            <div class="d-logo">
                                <img src="client/03_images/reviews/google.png" class="" alt="">
                            </div>
                            <div class="d-testi">
                                Một viên ngọc quý! Thức ăn tuyệt vời, dịch vụ hoàn hảo và không gian thú vị. Không thể chờ
                                đợi để quay lại!
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
                                Thật tuyệt vời! Sự tận tâm của đầu bếp với các nguyên liệu chất lượng thể hiện rõ trong từng
                                món ăn.
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
                                Một trải nghiệm ẩm thực khó quên. Mỗi món ăn đều là một sự bất ngờ thú vị, được bổ sung hoàn
                                hảo bởi dịch vụ tuyệt vời.
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

        <!-- phần đặc biệt -->
        <section class="position-relative" data-bgcolor="rgba(255, 255, 255, .05)">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-5 offset-lg-7">

                        <h5 class="uptitle">Đặc biệt</h5>
                        <h2>Combo</h2>

                        <div class="menu-item thead">
                            <div class="c1"></div>
                            <div class="c2">Nhỏ<span>Kích cỡ tiêu chuẩn</span></div>
                            <div class="c3">Lớn<span>Kích cỡ gia đình</span></div>
                        </div>

                        @if ($combos->count() > 0)
                            @foreach ($combos as $combo)
                                <div class="menu-item">
                                    <div class="c1">{{ $combo->name }}</div>
                                    <div class="c2">{{ number_format($combo->price, 0, ',', '.') }} VND</div>
                                </div>
                            @endforeach
                        @else
                            <p>Không có combo nào.</p>
                        @endif

                        <div class="spacer-single"></div>
                        <a href="{{ route('menu') }}" class="btn-line">Xem tất cả Combo</a>

                    </div>
                </div>
            </div>

            <div class="image-container col-lg-6 h-100 top-0 jarallax" data-speed="-.2">
                <img src="client/03_images/background/bg-side-11.jpg" class="jarallax-img" alt="">
            </div>
        </section>

        <!-- phần món ăn yêu thích -->

        <section class="position-relative" data-bgcolor="rgba(255, 255, 255, .05)">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-5">
                        <h5 class="uptitle">Yêu thích</h5>
                        <h2>Món ăn</h2>

                        @if ($dishes->count() > 0)
                            @foreach ($dishes as $dish)
                                <div class="menu-item">
                                    <div class="c1">{{ $dish->name }}<span>{{ $dish->description }}</span></div>
                                    <div class="c2"></div>
                                    <div class="c3">{{ number_format($dish->price, 0, ',', '.') }} VND</div>
                                </div>
                            @endforeach
                        @else
                            <p>Không có món ăn nào.</p>
                        @endif
                        <div class="spacer-single"></div>
                        <a href="{{ route('menu') }}" class="btn-line">Xem tất cả món ăn</a>

                    </div>
                </div>
            </div>

            <div class="image-container col-lg-6 offset-lg-6 h-100 top-0 jarallax" data-speed="-.2">
                <img src="client/03_images/background/bg-side-10.jpg" class="jarallax-img" alt="">
            </div>
        </section>

        @include('client.layouts.component.chefs')

        <!-- Đánh giá của khách hàng -->
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
                                <h5 class="uptitle wow fadeInUp">Khách hàng</h5>
                                <h2 class="wow fadeInUp">Đánh giá</h2>
                                <div class="spacer-single"></div>
                            </div>
                            <blockquote>
                                Là một chuyên gia bận rộn, tôi dựa vào tách cà phê sáng để bắt đầu ngày mới. Hương vị đậm
                                đà, mượt mà và mùi thơm tuyệt vời luôn khiến tôi tỉnh táo và sẵn sàng đối mặt với bất cứ
                                điều gì trong ngày. Thật như một miếng thiên đường nhỏ trong cốc!
                                <span>Jenna Smith</span>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- <!-- Hiển thị các món ăn -->
        <section id="dishes" class="mt-5">
            <div class="container">
                <h2 class="text-center">Các món ăn chính</h2>
                <div class="row">
                    @if ($dishes->count() > 0)
                        @foreach ($dishes as $dish)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <img src="{{ Storage::url($dish->image) }}" class="card-img-top"
                                        alt="{{ $dish->name }}">
                                    <div class="card-body text-center">
                                        <h5>{{ $dish->name }}</h5>
                                        <p>{{ number_format($dish->price, 0, ',', '.') }} VND</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center">Không có món ăn nào.</p>
                    @endif
                </div>
            </div>
        </section>

        <!-- Hiển thị Combo -->
        <section id="combos" class="mt-5">
            <div class="container">
                <h2 class="text-center">Combo đặc biệt</h2>
                <div class="row">
                    @if ($combos->count() > 0)
                        @foreach ($combos as $combo)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <img src="{{ Storage::url($combo->image) }}" class="card-img-top"
                                        alt="{{ $combo->name }}">
                                    <div class="card-body text-center">
                                        <h5>{{ $combo->name }}</h5>
                                        <p>{{ number_format($combo->price, 0, ',', '.') }} VND</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">Không có combo nào.</p>
                        @endif
                </div>
            </div>
        </section> --}}

        <!-- Kêu gọi hành động -->
        <section id="cta" aria-label="cta" class="call-to-action">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-9 text-lg-start text-sm-center wow fadeIn">
                        <h3><i class="id-color fa fa-phone mr10"></i>Gọi ngay và nhận ưu đãi đặc biệt!</h3>
                    </div>
                    <div class="col-lg-3 text-lg-end text-sm-center wow fadeIn" data-wow-delay=".2s">
                        <a href="{{ route('booking.client') }}" class="btn-line">Gọi ngay</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Phần câu chuyện -->
        <section data-bgcolor="rgba(255, 255, 255, .05)">
            <div class="container">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <h5 class="uptitle wow fadeInUp">Khám phá</h5>
                        <h2 class="wow fadeInUp">Câu chuyện của chúng tôi</h2>
                        <p class="lead wow fadeInUp">Tại "Baresto", chúng tôi tin tưởng vào sức mạnh của cà phê ngon và sự
                            hiếu khách ấm áp. Hành trình của chúng tôi bắt đầu với một tầm nhìn đơn giản: tạo ra một không
                            gian chào đón, nơi bạn bè, gia đình và những người lạ có thể đến và tận hưởng những món đồ uống
                            ngon lành, bánh ngọt tự làm và những kết nối ý nghĩa.</p>

                        <p class="wow fadeInUp">Là một thành viên tự hào của cộng đồng, chúng tôi cam kết đóng góp và tạo
                            ra tác động tích cực mọi nơi chúng tôi có thể. Từ việc hỗ trợ các nghệ nhân và nông dân địa
                            phương đến việc tổ chức các sự kiện tôn vinh sự đa dạng và hòa nhập, chúng tôi tin tưởng vào
                            việc sử dụng nền tảng của mình để lan tỏa niềm vui và thiện chí trong khu phố và xa hơn nữa.</p>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-6">
                                <img src="client/03_images/background/bg-side-4.jpg" class="card-img-top" alt="">
                            </div>
                            <div class="col-6">
                                <img src="client/03_images/background/bg-side-5.jpg" class="card-img-top" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Phần giờ mở cửa -->
        <section id="section-title-1" class="text-light jarallax">
            <img src="client/03_images/background/bg-side-18.jpg" class="card-img-top mb-5" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <h5 class="uptitle wow fadeInUp">Chúng tôi</h5>
                            <h2 class="wow fadeInUp">Mở cửa</h2>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay="0s">
                        <div class="text-center">
                            <span class="id-color-2 bold">Thứ 2 - Thứ 5</span>
                            <div class="fs20">10:30AM - 9:30PM</div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".1s">
                        <div class="text-center">
                            <span class="id-color-2 bold">Thứ 6</span>
                            <div class="fs20">10:00AM - 10:30PM</div>
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInRight" data-wow-delay=".2s">
                        <div class="text-center">
                            <span class="id-color-2 bold">Thứ 7 - Chủ nhật</span>
                            <div class="fs20">09:30AM - 11:00PM</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
