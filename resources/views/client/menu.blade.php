@extends('client.layouts.master')
@section('title', 'Menu')

@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-1.jpg',
        'subtitle' => 'Welcome',

        'title' => 'Our Menu',
        'currentPage' => 'Menu',
    ])

    <div id="content" class="no-bottom no-top" style="background-color: #2c2c2c;">
        <!-- Categories Section -->
        <!-- Categories Section -->
        <section class="position-relative py-5" style="background-color: #2c2c2c;">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-12 text-center">
                        <h5 class="uptitle text-uppercase text-primary">Categories</h5>
                        <h2 class="text-light">Danh Mục Món Ăn</h2>
                        <div class="spacer-half"></div>

                        @if (isset($categories) && $categories->count() > 0)
                            <div class="row justify-content-center">
                                @foreach ($categories as $category)
                                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                        <div class="menu-category p-4 text-center"
                                            style="background-color: #fff; border-radius: 10px; border: 1px solid #ddd; transition: all 0.3s ease;">
                                            <a href="" style="text-decoration: none; color: #333;">
                                                <h5 class="text-dark">{{ $category->name }}</h5>
                                            </a>
                                            <p class="text-muted text-description">{{ $category->description }}</p>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-light">Không có danh mục nào.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>


        <!-- Dishes Section -->
        <section class="position-relative py-5" style="background-color: #2c2c2c;">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-12 text-center">
                        <h5 class="uptitle text-uppercase text-primary">Main Dishes</h5>
                        <h2 class="text-light">Danh Sách Món Ăn</h2>
                        <div class="spacer-half"></div>

                        @if (isset($dishes) && $dishes)
                            <div class="row">
                                @foreach ($dishes as $dish)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <div class="card h-100 shadow-sm"
                                            style="background-color: #fff; border-radius: 15px; border: 1px solid #e3e3e3;">
                                            <img src="{{ asset($dish->image ? 'storage/' . $dish->image : 'images/placeholder.jpg') }}"
                                                class="card-img-top" alt="{{ $dish->name }}"
                                                style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                            <div class="card-body">
                                                <h5 class="card-title text-dark">{{ $dish->name }}</h5>
                                                <p class="card-text text-muted">{{ $dish->description }}</p>
                                                <p class="text-danger">Giá: {{ number_format($dish->price, 0, ',', '.') }}
                                                    VND</p>
                                            </div>
                                            <div class="card-footer text-center"
                                                style="background-color: #f8f9fa; border-radius: 15px;">
                                                <a href="{{ route('booking.client') }}"
                                                    style="display: inline-block; padding: 10px 20px; background-color: #dc3545; color: #fff; text-decoration: none; border-radius: 20px; font-weight: bold; transition: background-color 0.3s ease;">
                                                    Đặt chỗ ngay
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Nút phân trang -->
                            <div class="d-flex justify-content-center mt-4">
                                <nav aria-label="Page navigation example">
                                    {{ $dishes->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        @else
                            <p>Không có món ăn nào.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Combos Section -->
        <section class="position-relative py-5" style="background-color: #2c2c2c;">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-12 text-center">
                        <h5 class="uptitle text-uppercase text-primary">Special Combos</h5>
                        <h2 class="text-light">Danh Sách Combo</h2>
                        <div class="spacer-half"></div>

                        @if (isset($combos) && $combos->count() > 0)
                            <div class="row">
                                @foreach ($combos as $combo)
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                        <div class="card h-100 shadow-sm"
                                            style="background-color: #fff; border-radius: 15px; border: 1px solid #e3e3e3;">
                                            <img src="{{ asset('storage/' . $combo->image) }}" class="card-img-top"
                                                alt="{{ $combo->name }}"
                                                style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                            <div class="card-body">
                                                <h5 class="card-title text-dark">{{ $combo->name ?? 'Không có tên' }}</h5>
                                                <p class="card-text text-muted">
                                                    {{ Str::limit(strip_tags($combo->description), 50, '...') }}</p>
                                                <p class="text-danger">Giá: {{ number_format($combo->price, 0, ',', '.') }}
                                                    VND</p>
                                            </div>
                                            <div class="card-footer text-center"
                                                style="background-color: #f8f9fa; border-radius: 15px;">
                                                <a href="{{ route('booking.client') }}"
                                                    style="display: inline-block; padding: 10px 20px; background-color: #dc3545; color: #fff; text-decoration: none; border-radius: 20px; font-weight: bold; transition: background-color 0.3s ease;">
                                                    Đặt chỗ ngay
                                                </a>
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

<<<<<<< HEAD


=======
>>>>>>> cbe690915cdab5d2fad90d57c367c9ba08085177
@endsection
