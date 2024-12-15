@extends('client.layouts.master')
@section('title', 'Menu')

@section('content')
    <style>
        .menu-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            margin-bottom: 1rem;
        }

        .menu-item img {
            width: 100%;
            height: auto;
        }

        .menu-item .item-info {
            padding: 10px;
        }

        .menu-item .item-info h6 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        .menu-item .item-info .price {
            font-size: 14px;
            color: #888;
        }

        .menu-item .btn-add {
            background-color: #f5a623;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .menu-item .btn-add:hover {
            background-color: #e5941f;
        }

        .fixed-bottom-bar {
            position: fixed;
            border: none;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #ff8c00;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            z-index: 1000;
        }

        .fixed-bottom-bar button {
            background-color: #fff;
            color: #ff8c00;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        .fixed-bottom-bar button:hover {
            background-color: #ffae42;
            color: #fff;
        }

        .top-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .top-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin: 0 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .top-buttons .btn-combo {
            background-color: #ff8c00;
            color: white;
        }

        .top-buttons .btn-combo:hover {
            background-color: #e57a00;
        }

        .top-buttons .btn-other {
            background-color: #fff;
            color: #ff8c00;
            border: 1px solid #ff8c00;
        }

        .top-buttons .btn-other:hover {
            background-color: #ff8c00;
            color: white;
        }
    </style>
    @include('client.layouts.component.subheader', [
        'backgroundImage' => 'client/03_images/background/bg-1.jpg',
        'subtitle' => 'Menu Order',
        'title' => 'Steak House',
        'currentPage' => 'Bàn',
    ])
    <div class="container mt-4">
        <div class="top-buttons">
            <button class="btn-combo">Combo</button>
            <button class="btn-other">Món Khác</button>
        </div>

        <div class="row">
            <!-- Item 1 -->
            <div class="col-6">
                <div class="menu-item">
                    <img src="https://via.placeholder.com/150" alt="Cuốn thanh cua">
                    <div class="item-info">
                        <h6>Cuốn Thanh Cua</h6>
                        <p class="price">0đ/đĩa</p>
                        <button class="btn-add">+</button>
                    </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="col-6">
                <div class="menu-item">
                    <img src="https://via.placeholder.com/150" alt="Dẻ sườn bò sốt">
                    <div class="item-info">
                        <h6>Dẻ Sườn Bò Sốt</h6>
                        <p class="price">0đ/đĩa</p>
                        <button class="btn-add">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fixed Bottom Bar -->
    <button class="fixed-bottom-bar mx-4 mb-1 rounded">
        <span>Gọi món (0)</span>
        <span>0đ</span>
    </button>
@endsection
