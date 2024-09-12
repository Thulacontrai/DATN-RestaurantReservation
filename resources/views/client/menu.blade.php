@extends('client.layouts.master')
@section('title', 'Menu')

@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-1.jpg',
        'subtitle' => 'Welcome',
        'title' => 'Our Menu',
        'currentPage' => 'Menu',
    ])

    <div id="content" class="no-bottom no-top">
        <!-- Categories Section -->
        <section class="position-relative py-5" style="background-color: #f7f7f7;">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-12 text-center">
                        <h5 class="uptitle text-uppercase text-primary">Categories</h5>
                        <h2 class="text-dark" >Danh Mục Món Ăn</h2>
                        <div class="spacer-half"></div>

                        @if (isset($categories) && $categories->count() > 0)
                            <div class="row">
                                @foreach ($categories as $category)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <div class="menu-category p-3" style="background-color: #fff; border-radius: 10px;">
                                            <a href=""><h5 class="text-secondary">{{ $category->name }}</h5></a>
                                            <p class="text-muted">{{ $category->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>Không có danh mục nào.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Dishes Section (Styled as Cards) -->
        <section class="position-relative py-5">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-12 text-center">
                        <h5 class="uptitle text-uppercase text-primary">Main Dishes</h5>
                        <h2 class="text-while">Danh Sách Món Ăn</h2>
                        <div class="spacer-half"></div>

                        @if (isset($dishes) && $dishes->count() > 0)
                            <div class="row">
                                @foreach ($dishes as $dish)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <div class="card h-100 shadow-sm" style="border-radius: 15px;">
                                            <img src="{{ asset('storage/' . $dish->image) }}" class="card-img-top" alt="{{ $dish->name }}" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                            <div class="card-body">
                                                <h5 class="card-title text-dark">{{ $dish->name }}</h5>
                                                <p class="card-text text-muted">{{ $dish->description }}</p>
                                                <p class="text-danger">Giá: {{ number_format($dish->price, 0, ',', '.') }} VND</p>
                                            </div>
                                            <div class="card-footer text-center" style="background-color: #f8f9fa; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                                                <a href="#" class="btn btn-primary btn-block" style="border-radius: 20px;">Đặt chỗ ngay</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <!-- Nút phân trang -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $dishes->links('pagination::bootstrap-4') }} <!-- Sử dụng phân trang với Bootstrap 4 -->
                            </div>
                        @else
                            <p>Không có món ăn nào.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Combos Section (Styled as Cards) -->
        <section class="position-relative py-5" style="background-color: #f7f7f7;">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-12 text-center">
                        <h5 class="uptitle text-uppercase text-primary">Special Combos</h5>
                        <h2 class="text-dark">Danh Sách Combo</h2>
                        <div class="spacer-half"></div>

                        @if (isset($combos) && $combos->count() > 0)
                            <div class="row">
                                @foreach ($combos as $combo)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <div class="card h-100 shadow-sm" style="border-radius: 15px;">
                                            <img src="{{ asset('storage/' . $combo->image) }}" class="card-img-top" alt="{{ $combo->name }}" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                            <div class="card-body">
                                                <h5 class="card-title text-dark">{{ $combo->name ?? 'Không có tên' }}</h5>
                                                <p class="card-text text-muted">{{ Str::limit(strip_tags($combo->description), 50, '...') }}</p>
                                                <p class="text-danger">Giá: {{ number_format($combo->price, 0, ',', '.') }} VND</p>
                                            </div>
                                            <div class="card-footer text-center" style="background-color: #f8f9fa; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                                                <a href="#" class="btn btn-primary btn-block" style="border-radius: 20px;">Đặt chỗ ngay</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>Không có combo nào.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
