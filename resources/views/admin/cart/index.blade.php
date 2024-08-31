@extends('admin.master')

@section('title', 'Shopping Cart')

@section('content')

        <!-- Row start -->
        <div class="row">
            <div class="col-sm-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Items Added</div>
                        <div class="ml-auto">
                            <a href="{{ route('product.index') }}" class="btn btn-dark">Back to Products</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Row start -->
                        <div class="row">
                            <!-- Product Card 1 -->
                            <div class="col-xxl-6 col-sm-12 col-12">
                                <div class="product-added-card d-flex">
                                    <img class="product-added-img" src="{{ asset('../adminn/assets/images/food/img7.jpg') }}" alt="Admin Panel">
                                    <div class="product-added-card-body">
                                        <h5 class="product-added-title">Barbecue Chicken Salad</h5>
                                        <div class="product-added-price text-success">$25.00</div>
                                        <div class="product-added-description">
                                            Lettuce, cucumbers, tomatoes, scallions, corn, chicken with tangy barbecue ranch dressing.
                                        </div>
                                        <div class="product-added-actions mt-3">
                                            <button class="btn btn-light remove-from-cart">Remove from Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Card 1 -->

                            <!-- Product Card 2 -->
                            <div class="col-xxl-6 col-sm-12 col-12">
                                <div class="product-added-card d-flex">
                                    <img class="product-added-img" src="{{ asset('../adminn/assets/images/food/img9.jpg') }}" alt="Admin Panel">
                                    <div class="product-added-card-body">
                                        <h5 class="product-added-title">Harvest Cobb Salad</h5>
                                        <div class="product-added-price text-success">$15.00</div>
                                        <div class="product-added-description">
                                            Lettuce, cucumbers, tomatoes, scallions, corn, chicken with tangy barbecue ranch dressing.
                                        </div>
                                        <div class="product-added-actions mt-3">
                                            <button class="btn btn-light remove-from-cart">Remove from Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Card 2 -->

                            <!-- Product Card 3 -->
                            <div class="col-xxl-6 col-sm-12 col-12">
                                <div class="product-added-card d-flex">
                                    <img class="product-added-img" src="{{ asset('../adminn/assets/images/food/img2.jpg') }}" alt="Admin Panel">
                                    <div class="product-added-card-body">
                                        <h5 class="product-added-title">Greek Salad</h5>
                                        <div class="product-added-price text-success">$28.00</div>
                                        <div class="product-added-description">
                                            Lettuce, cucumbers, tomatoes, chicken with tangy barbecue ranch dressing.
                                        </div>
                                        <div class="product-added-actions mt-3">
                                            <button class="btn btn-light remove-from-cart">Remove from Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Card 3 -->

                            <!-- Product Card 4 -->
                            <div class="col-xxl-6 col-sm-12 col-12">
                                <div class="product-added-card d-flex">
                                    <img class="product-added-img" src="{{ asset('../adminn/assets/images/food/img6.jpg') }}" alt="Admin Panel">
                                    <div class="product-added-card-body">
                                        <h5 class="product-added-title">Garden Chickpea Salad</h5>
                                        <div class="product-added-price text-success">$22.00</div>
                                        <div class="product-added-description">
                                            Perfect for vegetarian and buffets, this is a job of gorgeous ingredients.
                                        </div>
                                        <div class="product-added-actions mt-3">
                                            <button class="btn btn-light remove-from-cart">Remove from Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Card 4 -->

                            <!-- Total and Checkout -->
                            <div class="col-12 mt-4">
                                <div class="sub-total-container d-flex justify-content-between align-items-center">
                                    <div class="total h4">Order Total: $90.00</div>
                                    <a href="{{ route('cart.show', ['cart' => 1]) }}" class="btn btn-success btn-lg">Checkout</a>
                                </div>
                            </div>
                            <!-- End Total and Checkout -->
                        </div>
                        <!-- Row end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->
    </div>
    <!-- Content wrapper end -->
</div>
<!-- Content wrapper scroll end -->
@endsection
