@extends('pos.layouts.master')
@section('title', 'Menu')

@section('content')

<div class="col-md-12 col-lg-8">
    <div class="pos-categories tabs_wrapper">
        <h5>Menu</h5>
        <ul class="tabs owl-carousel pos-category owl-loaded owl-drag">


        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all; width: 813px;"><div class="owl-item active" style="width: 154.577px; margin-right: 8px;"><li id="mainmenu">

                <a href="javascript:void(0);">
                    <img src="https://natashaskitchen.com/wp-content/uploads/2020/03/Pan-Seared-Steak-4.jpg" alt="">
                </a>
                <h6><a href="javascript:void(0);">Steak</a></h6>
                {{-- <span>4 Items</span> --}}
            </li></div><div class="owl-item active" style="width: 154.577px; margin-right: 8px;"><li id="drinks">
                <a href="javascript:void(0);">
                    <img src="https://blog.onelife.vn/wp-content/uploads/2023/09/96903f21-1.png" alt="">
                </a>
                <h6><a href="javascript:void(0);">Drinks</a></h6>
                {{-- <span>14 Items</span> --}}
            </li></div><div class="owl-item active" style="width: 154.577px; margin-right: 8px;"><li id="combo">
                <a href="javascript:void(0);">
                    <img src="https://bizweb.dktcdn.net/100/405/121/products/8dcccb6d-5848-4fb1-8765-6227d8a91055.jpg?v=1686775184043" alt="">
                </a>
                <h6><a href="javascript:void(0);">Combo</a></h6>
                {{-- <span>7 Items</span> --}}
            </li></div><div class="owl-item active" style="width: 154.577px; margin-right: 8px;"><li id="dessert">
                <a href="javascript:void(0);">
                    <img src="https://blog.onelife.vn/wp-content/uploads/2023/09/96903f21-1.png" alt="">
                </a>
                <h6><a href="javascript:void(0);">Dessert</a></h6>
                {{-- <span>16 Items</span> --}}
            </li></div><div class="owl-item active" style="width: 154.577px; margin-right: 8px;"><li id="salad">
                <a href="javascript:void(0);">
                    <img src="https://www.foodandwine.com/thmb/IuZPWAXBp4YaT9hn1YLHhuijT3k=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/FAW-recipes-big-italian-salad-hero-83e6ea846722478f8feb1eea33158b00.jpg" alt="">
                </a>
                <h6><a href="javascript:void(0);">Salad</a></h6>
                {{-- <span>18 Items</span> --}}
            </li></div></div></div><div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev disabled"><i class="fas fa-chevron-left"></i></button><button type="button" role="presentation" class="owl-next disabled"><i class="fas fa-chevron-right"></i></button></div><div class="owl-dots disabled"></div></ul>
        <div class="pos-products">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-3">Products</h5>
            </div>
            <div class="tabs_container">
                <div class="tab_content active" data-tab="all">
                    <div class="row">
                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3">
                            <div class="product-info default-cover card">
                                <a href="javascript:void(0);" class="img-bg">
                                    <img src="https://cdn.tgdd.vn/2020/11/CookProduct/1-1200x676-22.jpg" alt="Products">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check feather-16"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                </a>
                                <h6 class="cat-name"><a href="javascript:void(0);">Steak</a>
                                </h6>
                                <h6 class="product-name"><a href="javascript:void(0);">Sous Vide Steak</a></h6>
                                <div class="d-flex align-items-center justify-content-between price">
                                    <span>30 Pcs</span>
                                    <p>$15800</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-6 col-lg-3 col-xl-3 pe-2">
                            <div class="product-info default-cover card">
                                <a href="javascript:void(0);" class="img-bg">
                                    <img src="https://cdn.tgdd.vn/Files/2017/01/12/936951/giai-ngan-ngay-tet-voi-mon-salad-hoa-qua-kieu-han-quoc-202205241325570525.jpg" alt="Products">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check feather-16"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                                </a>
                                <h6 class="cat-name"><a href="javascript:void(0);">Salad</a>
                                </h6>
                                <h6 class="product-name"><a href="javascript:void(0);">Salad trái cây</a></h6>
                                <div class="d-flex align-items-center justify-content-between price">
                                    <span>140 Pcs</span>
                                    <p>$1000</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
