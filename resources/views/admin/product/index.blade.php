@extends('admin.master')

@section('title', 'ds product')

@section('content')
<!-- Content wrapper scroll start -->
<div class="content-wrapper-scroll">

    <!-- Content wrapper start -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Product List</div>
                        <div class="ml-auto">
                            <a href="{{ route('cart.index') }}" class="btn btn-dark">
                                <span class="badge shade-red me-2">2</span>View Cart
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                <div class="product-card">
                                    <img class="product-card-img-top" src="../adminn/assets/images/food/img6.jpg" alt="Bootstrap Gallery">
                                    <div class="product-card-body">
                                        <h5 class="product-title">Green Salad</h5>
                                        <div class="product-price">
                                            <span class="disount-price">$20</span>
                                            <span class="actucal-price">$24</span>
                                            <span class="off-price">50% Off</span>
                                        </div>
                                        <div class="product-rating">
                                            <div class="rate2 rating-stars"></div>
                                            <div class="total-ratings">1050</div>
                                        </div>
                                        <div class="product-description">
                                            Xuartz movement, manufactured by Zitizen watch co., ltd.
                                        </div>
                                        <div class="product-actions">
                                            <button class="btn btn-success addToCart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                <div class="product-card">
                                    <img class="product-card-img-top" src="../adminn/assets/images/food/img1.jpg" alt="Bootstrap Gallery">
                                    <div class="product-card-body">
                                        <h5 class="product-title">Nicoise Salad</h5>
                                        <div class="product-price">
                                            <span class="disount-price">$19</span>
                                            <span class="actucal-price">$27</span>
                                            <span class="off-price">30% Off</span>
                                        </div>
                                        <div class="product-rating">
                                            <div class="rate1 rating-stars"></div>
                                            <div class="total-ratings">2750</div>
                                        </div>
                                        <div class="product-description">
                                            Xuartz movement, manufactured by Zitizen watch co., ltd.
                                        </div>
                                        <div class="product-actions">
                                            <button class="btn btn-success addToCart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                <div class="product-card">
                                    <img class="product-card-img-top" src="../adminn/assets/images/food/img8.jpg" alt="Bootstrap Gallery">
                                    <div class="product-card-body">
                                        <h5 class="product-title">Augustin Salad</h5>
                                        <div class="product-price">
                                            <span class="disount-price">$18</span>
                                            <span class="actucal-price">$22</span>
                                            <span class="off-price">27% Off</span>
                                        </div>
                                        <div class="product-rating">
                                            <div class="rate2 rating-stars"></div>
                                            <div class="total-ratings">3629</div>
                                        </div>
                                        <div class="product-description">
                                            Xuartz movement, manufactured by Zitizen watch co., ltd.
                                        </div>
                                        <div class="product-actions">
                                            <button class="btn btn-success addToCart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                <div class="product-card">
                                    <img class="product-card-img-top" src="../adminn/assets/images/food/img9.jpg" alt="Bootstrap Gallery">
                                    <div class="product-card-body">
                                        <h5 class="product-title">Bagatelle Salad</h5>
                                        <div class="product-price">
                                            <span class="disount-price">$15</span>
                                            <span class="actucal-price">$20</span>
                                            <span class="off-price">10% Off</span>
                                        </div>
                                        <div class="product-rating">
                                            <div class="rate3 rating-stars"></div>
                                            <div class="total-ratings">5329</div>
                                        </div>
                                        <div class="product-description">
                                            Xuartz movement, manufactured by Zitizen watch co., ltd.
                                        </div>
                                        <div class="product-actions">
                                            <button class="btn btn-success addToCart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                <div class="product-card">
                                    <img class="product-card-img-top" src="../adminn/assets/images/food/img2.jpg" alt="Bootstrap Gallery">
                                    <div class="product-card-body">
                                        <h5 class="product-title">Salade Lyonnaise</h5>
                                        <div class="product-price">
                                            <span class="disount-price">$21</span>
                                            <span class="actucal-price">$30</span>
                                            <span class="off-price">15% Off</span>
                                        </div>
                                        <div class="product-rating">
                                            <div class="rate4 rating-stars"></div>
                                            <div class="total-ratings">240</div>
                                        </div>
                                        <div class="product-description">
                                            Xuartz movement, manufactured by Zitizen watch co., ltd.
                                        </div>
                                        <div class="product-actions">
                                            <button class="btn btn-success addToCart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                <div class="product-card">
                                    <img class="product-card-img-top" src="../adminn/assets/images/food/img3.jpg" alt="Bootstrap Gallery">
                                    <div class="product-card-body">
                                        <h5 class="product-title">Cendrillon Salad</h5>
                                        <div class="product-price">
                                            <span class="disount-price">$9</span>
                                            <span class="actucal-price">$12</span>
                                            <span class="off-price">20% Off</span>
                                        </div>
                                        <div class="product-rating">
                                            <div class="rate3 rating-stars"></div>
                                            <div class="total-ratings">7632</div>
                                        </div>
                                        <div class="product-description">
                                            Xuartz movement, manufactured by Zitizen watch co., ltd.
                                        </div>
                                        <div class="product-actions">
                                            <button class="btn btn-success addToCart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                <div class="product-card">
                                    <img class="product-card-img-top" src="../adminn/assets/images/food/img4.jpg" alt="Bootstrap Gallery">
                                    <div class="product-card-body">
                                        <h5 class="product-title">Espagnole Salad</h5>
                                        <div class="product-price">
                                            <span class="disount-price">$27</span>
                                            <span class="actucal-price">$32</span>
                                            <span class="off-price">33% Off</span>
                                        </div>
                                        <div class="product-rating">
                                            <div class="rate4 rating-stars"></div>
                                            <div class="total-ratings">4587</div>
                                        </div>
                                        <div class="product-description">
                                            Xuartz movement, manufactured by Zitizen watch co., ltd.
                                        </div>
                                        <div class="product-actions">
                                            <button class="btn btn-success addToCart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                <div class="product-card">
                                    <img class="product-card-img-top" src="../adminn/assets/images/food/img5.jpg" alt="Bootstrap Gallery">
                                    <div class="product-card-body">
                                        <h5 class="product-title">Grande Duchesse</h5>
                                        <div class="product-price">
                                            <span class="disount-price">$25</span>
                                            <span class="actucal-price">$35</span>
                                            <span class="off-price">33% Off</span>
                                        </div>
                                        <div class="product-rating">
                                            <div class="rate6 rating-stars"></div>
                                            <div class="total-ratings">35</div>
                                        </div>
                                        <div class="product-description">
                                            Xuartz movement, manufactured by Zitizen watch co., ltd.
                                        </div>
                                        <div class="product-actions">
                                            <button class="btn btn-success addToCart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Row end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content wrapper end -->

</div>
<!-- Content wrapper scroll end -->
@endsection
