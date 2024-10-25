@extends('client.layouts.master')
@section('title', 'Menu')

@section('content')
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-1.jpg',
        'subtitle' => 'Welcome',
        'title' => 'Our Menu',
        'currentPage' => 'Menu',
    ])

    <div id="content" class="no-bottom no-top" style="background-color: #090909;">
        <!-- Tab Navigation Section -->
        <section class="py-5" style="background-color: #040404;">
            <div class="container">
                <div class="row align-items-center wow fadeInUp">
                    <div class="col-lg-12 text-center">
                        <h5 class="uptitle text-uppercase text-primary">Categories</h5>
                        <h3 class="text-light">THỰC ĐƠN THEO NHÀ HÀNG</h3>
                        <div class="spacer-half"></div>
                        <ul class="nav nav-tabs justify-content-center">
                            <!-- Combo Tab -->
                            <li class="nav-item">
                                <a class="nav-link active" id="combo-tab" href="javascript:void(0)"
                                    onclick="showCategory('combo')">
                                    Combo
                                </a>
                            </li>
                            @foreach ($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link" id="category-tab-{{ $category->id }}" href="javascript:void(0)"
                                        onclick="showCategory('{{ $category->id }}')">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Combo Section (Displayed First) -->
        <div class="wrapper">
            <section id="category-combo" class="category-section py-5" style="display: block;">
                <div class="container">
                    <div class="row align-items-center">
                        @if ($combos->count() > 0)
                            @foreach ($combos as $combo)
                                <div class="col-md-12 mb-4">
                                    <div class="d-flex">
                                        <!-- Combo Image -->
                                        <div class="col-md-4">
                                            <img src="{{ asset($combo->image ? 'storage/' . $combo->image : 'images/placeholder.jpg') }}"
                                                alt="{{ $combo->name }}" class="img-fluid rounded" />
                                        </div>

                                        <!-- Combo Info -->
                                        <div class="col-md-8 pl-4">
                                            <h3 class="text-dark">{{ $combo->name }}</h3>
                                            <!-- Strip tags and limit description to 150 characters -->
                                            <p class="text-muted fst-italic">
                                                <i class="fas fa-info-circle"></i> <!-- Icon mô tả -->
                                                {!! Str::limit(strip_tags($combo->description), 150) !!}
                                            </p>


                                            <p class="text-danger">
                                                <span class="badge bg-warning text-dark p-2">
                                                    <i class="fas fa-money-bill-wave"></i> <!-- Icon tiền -->
                                                    {{ number_format($combo->price, 0, ',', '.') }} VND
                                                </span>
                                            </p>

                                            <p class="text-muted">
                                                <i class="bi bi-calendar"></i> <!-- Icon lịch Bootstrap -->
                                                {{ $combo->created_at->isoFormat('DD/MM/YYYY, h:mm A') }}
                                            </p>


                                            <button class="learn-more">
                                                <span class="circle" aria-hidden="true">
                                                    <span class="icon arrow"></span>
                                                </span>
                                                <span class="button-text"> <a href="{{ route('booking.client') }}">Xem
                                                    thêm</a></span>
                                            </button>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            @endforeach
                        @else
                            <p>Không có combo nào.</p>
                        @endif
                    </div>
                </div>
            </section>

            <!-- Dishes Section for Categories -->
            @foreach ($categories as $category)
                <section id="category-{{ $category->id }}" class="category-section py-5" style="display: none;">
                    <div class="container">
                        <div class="row align-items-center">
                            @if ($category->dishes->count() > 0)
                                @foreach ($category->dishes as $dish)
                                    <div class="col-md-12 mb-4">
                                        <div class="d-flex">
                                            <!-- Dish Image -->
                                            <div class="col-md-4">
                                                <img src="{{ asset($dish->image ? 'storage/' . $dish->image : 'images/placeholder.jpg') }}"
                                                    alt="{{ $dish->name }}" class="img-fluid rounded" />
                                            </div>

                                            <!-- Dish Info -->
                                            <div class="col-md-8 pl-4">
                                                <h3 class="text-dark">{{ $dish->name }}</h3>
                                                <p class="text-muted">{{ Str::limit(strip_tags($dish->description), 150) }}
                                                </p>
                                                <p class="text-danger">
                                                    <span class="badge bg-warning text-dark p-2">
                                                        <i class="fas fa-money-bill-wave"></i> <!-- Icon tiền -->
                                                        {{ number_format($dish->price, 0, ',', '.') }} VND
                                                    </span>
                                                </p>

                                                <p class="text-muted">
                                                    <i class="bi bi-calendar"></i> <!-- Icon lịch Bootstrap -->
                                                    {{ $dish->created_at->isoFormat('DD/MM/YYYY, h:mm A') }}
                                                </p>


                                                <button class="learn-more">
                                                    <span class="circle" aria-hidden="true">
                                                        <span class="icon arrow"></span>
                                                    </span>
                                                    <span class="button-text"> <a href="{{ route('booking.client') }}">Xem
                                                            thêm</a></span>

                                                </button>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                @endforeach
                            @else
                                <p>Không có món ăn nào.</p>
                            @endif
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    @endsection

    <script>
        function showCategory(categoryId) {
            // Hide all sections
            document.querySelectorAll('.category-section').forEach(section => {
                section.style.display = 'none';
            });

            // Show the selected category
            document.getElementById('category-' + categoryId).style.display = 'block';

            // Update active tab
            document.querySelectorAll('.nav-link').forEach(tab => {
                tab.classList.remove('active');
            });

            // Highlight the clicked tab
            if (categoryId === 'combo') {
                document.getElementById('combo-tab').classList.add('active');
            } else {
                document.getElementById('category-tab-' + categoryId).classList.add('active');
            }
        }
    </script>
    <style>

        /* Bao bọc cho phần */
        .wrapper {
            width: 80%; /* Điều chỉnh chiều rộng tổng thể của form */
            max-width: 1200px; /* Đặt chiều rộng tối đa */
            margin: 0 auto; /* Căn giữa container */
            padding: 0 20px; /* Thêm khoảng cách hai bên trái, phải */
        }
    
        /* Flexbox cho các phần tử trong form */
        .d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px; /* Khoảng cách giữa các phần tử */
        }
    
        /* Các cột */
        .col-md-4, .col-md-8 {
            flex: 1; /* Cân đối chiều rộng cho hình ảnh và nội dung */
            padding-left: 20px;
            padding-right: 20px;
        }
    
        /* Đảm bảo hình ảnh nằm gọn trong cột của nó */
        .col-md-4 img {
            width: 100%; /* Đảm bảo hình ảnh không bị tràn ra ngoài */
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            border: 1px solid #444; /* Đường viền cho hình ảnh */
        }
    
        /* Thêm khoảng cách cho nút bấm */
        .btn-danger {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #ff5252;
            border-radius: 5px;
            border: none;
            color: #fff;
            font-weight: 600;
            font-size: 16px;
        }
    
        /* Điều chỉnh bố cục văn bản */
        .col-md-8 {
            padding-left: 15px;
            color: #f0f0f0;
        }
    
        /* Kiểu dáng giá */
        .text-danger {
            font-size: 16px;
            font-weight: 600;
            color: #ff5252;
        }
    
        /* Điều chỉnh container */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }
    
        /* Khoảng cách giữa các section */
        .category-section {
            margin-bottom: 30px;
        }
    
    
    </style>
    <style>
        button {
            position: relative;
            display: inline-block;
            cursor: pointer;
            outline: none;
            border: 0;
            vertical-align: middle;
            text-decoration: none;
            background: transparent;
            padding: 0;
            font-size: inherit;
            font-family: inherit;
        }

        button.learn-more {
            width: 10rem;
            height: auto;
        }

        button.learn-more .circle {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: relative;
            display: block;
            margin: 0;
            width: 3rem;
            height: 3rem;
            background: #e85b3b;
            border-radius: 1.625rem;
        }

        button.learn-more .circle .icon {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: absolute;
            top: 0;
            bottom: 0;
            margin: auto;
            background: #fff;
        }

        button.learn-more .circle .icon.arrow {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            left: 0.625rem;
            width: 1.125rem;
            height: 0.125rem;
            background: none;
        }

        button.learn-more .circle .icon.arrow::before {
            position: absolute;
            content: "";
            top: -0.29rem;
            right: 0.0625rem;
            width: 0.625rem;
            height: 0.625rem;
            border-top: 0.125rem solid #fff;
            border-right: 0.125rem solid #fff;
            transform: rotate(45deg);
        }

        button.learn-more .button-text a {
            transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 0.75rem 0;
            margin: 0 0 0 1.85rem;
            color: #ffffff;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
        }

        button:hover .circle {
            width: 100%;
        }

        button:hover .circle .icon.arrow {
            background: #fff;
            transform: translate(1rem, 0);
        }

        button:hover .button-text a {
            color: #fff;
        }
    </style>
