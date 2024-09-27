{{-- @extends('pos.layouts.master')

@section('title', 'Menu')

@section('content')
@include('pos.layouts.partials.header', [

])
<div class="content-page">
    <div class="container-fluid r-banner-cap">

<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card card-block card-stretch card-height r-odr-block">
            <div class="d-flex align-items-center justify-content-between p-20">
                <div class="text-warning">
                    <i class="fas fa-utensils resto-img"></i>
                </div>
                <div class="iq-card-text">
                    <h2 class="mb-0 line-height">25 K</h2>
                    <p class="mb-0">Order Served</p>
                </div>
                <div>
                    <span class="badge badge-success cust-badge">75% <i class="fas fa-angle-up ml-1"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card card-block card-stretch card-height r-odr-block success">
            <div class="d-flex align-items-center justify-content-between p-20">
                <div class="text-success">
                    <i class="fas fa-users resto-img"></i>
                </div>
                <div class="iq-card-text">
                    <h2 class="mb-0 line-height">15 K</h2>
                    <p class="mb-0">Daily User's</p>
                </div>
                <div>
                    <span class="badge badge-success cust-badge">53% <i class="fas fa-angle-up ml-1"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6">
        <div class="card card-block card-stretch card-height r-odr-block info">
            <div class="d-flex align-items-center justify-content-between p-20">
                <div class="text-info">
                    <i class="fas fa-coins resto-img"></i>
                </div>
                <div class="iq-card-text">
                    <h2 class="mb-0 line-height">40 K</h2>
                    <p class="mb-0">Total Earning</p>
                </div>
                <div>
                    <span class="badge badge-danger cust-badge">25% <i class="fas fa-angle-down ml-1"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 ">
        <div class="card card-block card-stretch card-height r-odr-block danger">
            <div class="d-flex align-items-center justify-content-between p-20">
                <div class="text-danger">
                    <i class="fas fa-comment-alt resto-img"></i>
                </div>
                <div class="iq-card-text">
                    <h2 class="mb-0 line-height">258</h2>
                    <p class="mb-0">New Feedback</p>
                </div>
                <div>
                    <span class="badge badge-danger cust-badge">20% <i class="fas fa-angle-down ml-1"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card card-block card-stretch card-height">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Trending Order's</h4>
                </div>
                <div id="trending-order-slick-arrow" class="slick-aerrow-block"><button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="">Previous</button>

                <button class="slick-next slick-arrow" aria-label="Next" type="button" style="">Next</button></div>
            </div>
            <div class="card-body">
                <div class="trending-order slick-initialized slick-slider">
                    <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 3210px; transform: translate3d(-642px, 0px, 0px);"><div class="item slick-slide slick-cloned" data-slick-index="-2" id="" aria-hidden="true" tabindex="-1" style="width: 321px;">
                        <img src="poss/assets/images/layouts/layout-6/or-3.png" class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                        <div class="odr-content bg-danger-light">
                            <span class="badge badge-white text-center"><i class="fas fa-heart text-danger"></i></span>
                            <h5 class="mb-1">Veg Fried Rice</h5>
                            <h5><strong>$15.25</strong></h5>
                            <p class="mb-0">order: 55</p>
                        </div>
                    </div><div class="item slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 321px;">
                        <img src="poss/assets/images/layouts/layout-6/or-1.png" class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                        <div class="odr-content bg-danger-light">
                            <span class="badge badge-white text-center"><i class="fas fa-heart text-danger"></i></span>
                            <h5 class="mb-1">Mix Sushi Rice</h5>
                            <h5 class="mb-1"><strong>$25.25</strong></h5>
                            <p class="mb-0">order: 85</p>
                        </div>
                    </div><div class="item slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 321px;">
                        <img src="poss/assets/images/layouts/layout-6/or-1.png" class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                        <div class="odr-content bg-danger-light">
                            <span class="badge badge-white text-center"><i class="fas fa-heart text-danger"></i></span>
                            <h5 class="mb-1">Mix Sushi Rice</h5>
                            <h5><strong>$25.25</strong></h5>
                            <p class="mb-0">order: 85</p>
                        </div>
                    </div><div class="item slick-slide slick-active" data-slick-index="1" aria-hidden="false" tabindex="0" style="width: 321px;">
                        <img src="poss/assets/images/layouts/layout-6/or-2.png" class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                        <div class="odr-content bg-success-light">
                            <span class="badge badge-white text-center"><i class="fas fa-heart text-danger"></i></span>
                            <h5 class="mb-1">Tropical Fruits</h5>
                            <h5><strong>$36.25</strong></h5>
                            <p class="mb-0">order: 70</p>
                        </div>
                    </div><div class="item slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" style="width: 321px;">
                        <img src="poss/assets/images/layouts/layout-6/or-3.png" class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                        <div class="odr-content bg-danger-light">
                            <span class="badge badge-white text-center"><i class="fas fa-heart text-danger"></i></span>
                            <h5 class="mb-1">Veg Fried Rice</h5>
                            <h5><strong>$15.25</strong></h5>
                            <p class="mb-0">order: 55</p>
                        </div>
                    </div><div class="item slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1" style="width: 321px;">
                        <img src="poss/assets/images/layouts/layout-6/or-1.png" class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                        <div class="odr-content bg-danger-light">
                            <span class="badge badge-white text-center"><i class="fas fa-heart text-danger"></i></span>
                            <h5 class="mb-1">Mix Sushi Rice</h5>
                            <h5 class="mb-1"><strong>$25.25</strong></h5>
                            <p class="mb-0">order: 85</p>
                        </div>
                    </div><div class="item slick-slide slick-cloned" data-slick-index="4" id="" aria-hidden="true" tabindex="-1" style="width: 321px;">
                        <img src="poss/assets/images/layouts/layout-6/or-1.png" class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                        <div class="odr-content bg-danger-light">
                            <span class="badge badge-white text-center"><i class="fas fa-heart text-danger"></i></span>
                            <h5 class="mb-1">Mix Sushi Rice</h5>
                            <h5><strong>$25.25</strong></h5>
                            <p class="mb-0">order: 85</p>
                        </div>
                    </div><div class="item slick-slide slick-cloned" data-slick-index="5" id="" aria-hidden="true" tabindex="-1" style="width: 321px;">
                        <img src="poss/assets/images/layouts/layout-6/or-2.png" class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                        <div class="odr-content bg-success-light">
                            <span class="badge badge-white text-center"><i class="fas fa-heart text-danger"></i></span>
                            <h5 class="mb-1">Tropical Fruits</h5>
                            <h5><strong>$36.25</strong></h5>
                            <p class="mb-0">order: 70</p>
                        </div>
                    </div><div class="item slick-slide slick-cloned" data-slick-index="6" id="" aria-hidden="true" tabindex="-1" style="width: 321px;">
                        <img src="poss/assets/images/layouts/layout-6/or-3.png" class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                        <div class="odr-content bg-danger-light">
                            <span class="badge badge-white text-center"><i class="fas fa-heart text-danger"></i></span>
                            <h5 class="mb-1">Veg Fried Rice</h5>
                            <h5><strong>$15.25</strong></h5>
                            <p class="mb-0">order: 55</p>
                        </div>
                    </div><div class="item slick-slide slick-cloned" data-slick-index="7" id="" aria-hidden="true" tabindex="-1" style="width: 321px;">
                        <img src="poss/assets/images/layouts/layout-6/or-1.png" class="img-fluid rounded-circle avatar-120 odr-img" alt="image">
                        <div class="odr-content bg-danger-light">
                            <span class="badge badge-white text-center"><i class="fas fa-heart text-danger"></i></span>
                            <h5 class="mb-1">Mix Sushi Rice</h5>
                            <h5 class="mb-1"><strong>$25.25</strong></h5>
                            <p class="mb-0">order: 85</p>
                        </div>
                    </div></div></div>



                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-transparent">
            <div class="resto-blog slick-initialized slick-slider">
                <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 2728px; transform: translate3d(-682px, 0px, 0px);"><div class="item slick-slide slick-cloned" data-slick-index="-2" id="" aria-hidden="true" tabindex="-1" style="width: 341px;">
                    <img src="poss/assets/images/layouts/layout-6/blog-2.jpg" class="rounded img-fluid w-100" alt="image">
                    <div class="r-blog-content">
                        <h4 class="mb-1">Pancake World</h4>
                        <div class="d-flex justify-content-left mb-1">
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-light"></i></a>
                        </div>
                        <p class="body-text font-weight-bold mb-1"><i class="las la-map-marker-alt mr-1"></i> 8517 West Norcross, GA
                            30092</p>
                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div><div class="item slick-slide slick-cloned" data-slick-index="-1" id="" aria-hidden="true" tabindex="-1" style="width: 341px;">
                    <img src="poss/assets/images/layouts/layout-6/blog-3.jpg" class="rounded img-fluid w-100" alt="image">
                    <div class="r-blog-content">
                        <h4 class="mb-1">Green Curry</h4>
                        <div class="d-flex justify-content-left mb-1">
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-light"></i></a>
                        </div>
                        <p class="body-text font-weight-bold mb-1"><i class="las la-map-marker-alt mr-1"></i> 8517 West Norcross, GA
                            30092</p>
                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div><div class="item slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 341px;">
                    <img src="poss/assets/images/layouts/layout-6/blog-1.jpg" class="rounded img-fluid w-100" alt="image">
                    <div class="r-blog-content">
                        <h4 class="mb-1">Green Curry</h4>
                        <div class="d-flex justify-content-left mb-1">
                            <a href="#" tabindex="0"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="0"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="0"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="0"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="0"><i class="las la-star text-light"></i></a>
                        </div>
                        <p class="body-text font-weight-bold mb-1"><i class="las la-map-marker-alt mr-1"></i> 8517 West Norcross, GA 30092</p>
                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div><div class="item slick-slide slick-active" data-slick-index="1" aria-hidden="false" tabindex="0" style="width: 341px;">
                    <img src="poss/assets/images/layouts/layout-6/blog-2.jpg" class="rounded img-fluid w-100" alt="image">
                    <div class="r-blog-content">
                        <h4 class="mb-1">Pancake World</h4>
                        <div class="d-flex justify-content-left mb-1">
                            <a href="#" tabindex="0"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="0"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="0"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="0"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="0"><i class="las la-star text-light"></i></a>
                        </div>
                        <p class="body-text font-weight-bold mb-1"><i class="las la-map-marker-alt mr-1"></i> 8517 West Norcross, GA
                            30092</p>
                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div><div class="item slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" style="width: 341px;">
                    <img src="poss/assets/images/layouts/layout-6/blog-3.jpg" class="rounded img-fluid w-100" alt="image">
                    <div class="r-blog-content">
                        <h4 class="mb-1">Green Curry</h4>
                        <div class="d-flex justify-content-left mb-1">
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-light"></i></a>
                        </div>
                        <p class="body-text font-weight-bold mb-1"><i class="las la-map-marker-alt mr-1"></i> 8517 West Norcross, GA
                            30092</p>
                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div><div class="item slick-slide slick-cloned" data-slick-index="3" id="" aria-hidden="true" tabindex="-1" style="width: 341px;">
                    <img src="poss/assets/images/layouts/layout-6/blog-1.jpg" class="rounded img-fluid w-100" alt="image">
                    <div class="r-blog-content">
                        <h4 class="mb-1">Green Curry</h4>
                        <div class="d-flex justify-content-left mb-1">
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-light"></i></a>
                        </div>
                        <p class="body-text font-weight-bold mb-1"><i class="las la-map-marker-alt mr-1"></i> 8517 West Norcross, GA 30092</p>
                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div><div class="item slick-slide slick-cloned" data-slick-index="4" id="" aria-hidden="true" tabindex="-1" style="width: 341px;">
                    <img src="poss/assets/images/layouts/layout-6/blog-2.jpg" class="rounded img-fluid w-100" alt="image">
                    <div class="r-blog-content">
                        <h4 class="mb-1">Pancake World</h4>
                        <div class="d-flex justify-content-left mb-1">
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-light"></i></a>
                        </div>
                        <p class="body-text font-weight-bold mb-1"><i class="las la-map-marker-alt mr-1"></i> 8517 West Norcross, GA
                            30092</p>
                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div><div class="item slick-slide slick-cloned" data-slick-index="5" id="" aria-hidden="true" tabindex="-1" style="width: 341px;">
                    <img src="poss/assets/images/layouts/layout-6/blog-3.jpg" class="rounded img-fluid w-100" alt="image">
                    <div class="r-blog-content">
                        <h4 class="mb-1">Green Curry</h4>
                        <div class="d-flex justify-content-left mb-1">
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-warning"></i></a>
                            <a href="#" tabindex="-1"><i class="las la-star text-light"></i></a>
                        </div>
                        <p class="body-text font-weight-bold mb-1"><i class="las la-map-marker-alt mr-1"></i> 8517 West Norcross, GA
                            30092</p>
                        <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div></div></div>


            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card card-block card-stretch card-height">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Order List</h4>
                </div>
                <div class="card-header-toolbar d-flex align-items-center">
                    <button class="btn btn-warning">View All</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="DataTables_Table_0"></label></div><table class="table mb-0 table-borderless data-table dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead class="order-resto">
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order ID: activate to sort column descending" style="width: 84.6875px;">Order ID</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Order Name: activate to sort column ascending" style="width: 154.65px;">Order Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 171.238px;">Customer Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date &amp;amp; Time: activate to sort column ascending" style="width: 171.875px;">Date &amp; Time</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 75.95px;">Amount</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Ph No.: activate to sort column ascending" style="width: 180.25px;">Ph No.</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending" style="width: 82.125px;">Quantity</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending" style="width: 80.125px;">Location</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 76.025px;">Status</th><th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 77.075px;">Action</th></tr>
                        </thead>
                        <tbody class="odr-tble">



                        <tr role="row" class="odd">
                                <td class="sorting_1">
                                    #12345
                                </td>
                                <td>Lorem Ipsum Idor
                                </td>
                                <td>
                                    Mario Speedwagon
                                </td>
                                <td>
                                    09/09/2020 , 09:30
                                </td>
                                <td>
                                    $85
                                </td>
                                <td>
                                    + 114 12345 67891
                                </td>
                                <td>
                                    05
                                </td>
                                <td>
                                    Canada
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                        <a class="badge bg-danger-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
                            </tr><tr role="row" class="even">
                                <td class="sorting_1">
                                    #56565
                                </td>
                                <td>Lorem Ipsum Idor
                                </td>
                                <td>
                                    Petey Cruiser
                                </td>
                                <td>
                                    08/09/2020 , 11:30
                                </td>
                                <td>
                                    $21
                                </td>
                                <td>
                                    + 114 12345 67891
                                </td>
                                <td>
                                    15
                                </td>
                                <td>
                                    England
                                </td>
                                <td>
                                    <span class="badge badge-danger">Pending</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                        <a class="badge bg-danger-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
                            </tr><tr role="row" class="odd">
                                <td class="sorting_1">
                                    #766768
                                </td>
                                <td>Lorem Ipsum Idor
                                </td>
                                <td>
                                    Anna Sthesia
                                </td>
                                <td>
                                    05/09/2020 , 07:30
                                </td>
                                <td>
                                    $65
                                </td>
                                <td>
                                    + 114 12345 67891
                                </td>
                                <td>
                                    08
                                </td>
                                <td>
                                    London
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                        <a class="badge bg-danger-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
                            </tr></tbody>
                    </table><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 3 of 3 entries</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous">Previous</a><span><a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" id="DataTables_Table_0_next">Next</a></div></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection --}}
