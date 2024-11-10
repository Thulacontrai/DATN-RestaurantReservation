@extends('pos.layouts.master')

@section('title', "Menu $table")

@section('content')
<div class="menu-container p-3 d-flex">
    <!-- Cột 1: Phần Menu -->
    <div class="menu-section" style="flex: 2; padding-right: 20px;">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-left" style="color: #007acc; font-weight: bold;">Danh sách món</h1>
        </div>

        <!-- Bộ lọc danh mục with improved style -->
        <div class="filter-section mb-4 mt-3 d-flex justify-content-start">
            <button class="btn btn-filter active" data-category="all">Tất cả</button>
            @foreach($categories as $category => $items)
                <button class="btn btn-filter" data-category="{{ strtolower($category) }}">{{ $category }}</button>
            @endforeach
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="product-grid" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
            @foreach($categories as $category => $items)
                @foreach($items as $item)
                    <div class="product-item" data-category="{{ strtolower($category) }}" style="width: calc(20% - 10px); margin-bottom: 20px; text-align: center; transition: transform 0.3s, box-shadow 0.3s;">
                        <img src="{{ asset($item['image'] ? 'storage/' . $item['image'] : 'images/placeholder.jpg') }}" alt="{{ $item['name'] }}" style="width: 120px; height: 120px; border-radius: 5px; object-fit: cover;">
                        <p style="font-weight: bold;">{{ $item['name'] }}</p>
                        <p>{{ number_format($item['price'], 2) }} VNĐ</p>
                        <button class="btn btn-primary btn-sm add-to-cart" data-name="{{ $item['name'] }}" data-price="{{ $item['price'] }}">Thêm</button>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    <!-- Cột 2: Phần Giỏ hàng -->
    <aside class="cart-summary" style="flex: 1; background-color: #f9f9f9; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
        {{-- <h3 class="text-center" style="color: #007acc; font-weight: bold;">Giỏ hàng</h3> --}}
        <ul id="cart-items" class="list-group" style="max-height: 300px; overflow-y: auto;"></ul>
        <div class="d-flex justify-content-between mt-3" style="font-size: 1.2em;">
            <strong>Tổng cộng:</strong>
            <span id="total-price">0.00 VNĐ</span>
        </div>
        <button class="btn btn-danger mt-3" id="clear-cart-button" style="width: 100%;">Xóa </button>
        <button class="btn btn-success mt-3" id="checkout-button" style="width: 100%;">Thanh toán</button>
    </aside>
</div>

<!-- Improved Notification for Table and Area -->
<div id="cart-notification" class="cart-notification">
    <span class="close-btn" onclick="hideNotification()">&#10005;</span>
    <div class="notification-content">
        <p><strong>Thành công!</strong> Món đã được thêm </p>
        <p>Số bàn: <strong>{{ $table }}</strong>, Khu vực: <strong>{{ $tableArea }}</strong></p>
    </div>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="checkoutModalLabel">Chọn sản phẩm để thanh toán</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" style="background-color: #f9f9f9; border-radius: 10px; transition: transform 0.3s;">
                <form id="checkout-form" action="{{ route('Ppayment', ['table_number' => $table]) }}" method="POST">
                    @csrf
                    <ul class="list-group" id="checkout-items-list" style="list-style: none; padding-left: 0;"></ul>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="select-all-items">
                            <label class="custom-control-label" for="select-all-items">Chọn tất cả</label>
                        </div>
                        <strong class="ml-auto">Tổng cộng: <span id="checkout-total-price" class="text-danger">0.00 VNĐ</span></strong>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="confirm-checkout">Xác nhận thanh toán</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="editItemModalLabel">Chỉnh sửa món ăn</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-item-form">
                    <div class="form-group">
                        <label for="itemName">Tên món ăn</label>
                        <input type="text" class="form-control" id="itemName" disabled>
                    </div>
                    <div class="form-group">
                        <label for="itemQuantity">Số lượng</label>
                        <input type="number" class="form-control" id="itemQuantity" min="1">
                    </div>
                    <div class="form-group">
                        <label for="itemPrice">Giá tiền</label>
                        <input type="text" class="form-control" id="itemPrice">
                    </div>
                    <div class="form-group">
                        <label for="itemDescription">Mô tả món ăn</label>
                        <textarea class="form-control" id="itemDescription" rows="3" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="itemNotes">Ghi chú</label>
                        <textarea class="form-control" id="itemNotes" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                <button type="button" class="btn btn-primary" id="saveItemChanges">Lưu thay đổi</button>
            </div>
        </div>
    </div>
</div>

<!-- Updated Script for Cart Handling and Edit Item Modal -->
<script>
    let cart = [];
    let totalAmount = 0;

    document.querySelectorAll('.btn-filter').forEach(button => {
        button.addEventListener('click', function () {
            document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            const selectedCategory = this.getAttribute('data-category');
            document.querySelectorAll('.product-item').forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                if (selectedCategory === 'all' || itemCategory === selectedCategory) {
                    item.style.display = 'block';
                    item.style.opacity = 0;
                    setTimeout(() => {
                        item.style.opacity = 1;
                    }, 100);
                } else {
                    item.style.opacity = 0;
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    function showNotification() {
        const notification = document.getElementById('cart-notification');
        notification.classList.add('show');
        setTimeout(() => {
            notification.classList.remove('show');
        }, 5000);
    }

    function hideNotification() {
        const notification = document.getElementById('cart-notification');
        notification.classList.remove('show');
    }

    function addToCart(name, price) {
        const existingItem = cart.find(item => item.name === name);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push({ name, price, quantity: 1 });
        }
        updateCart();
        showNotification();
    }

    function updateCart() {
        const cartItemsContainer = document.getElementById('cart-items');
        cartItemsContainer.innerHTML = '';
        let total = 0;
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<li class="list-group-item">Giỏ hàng trống</li>';
        }
        cart.forEach((item, index) => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
                <span class="cart-item-name">${item.name.length > 20 ? item.name.substring(0, 20) + '...' : item.name} x${item.quantity}</span>
                <div>
                    <span>${(item.price * item.quantity).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</span>
                    <button class="btn btn-info btn-sm edit-cart-item" data-index="${index}" style="margin-left: 10px;">Chỉnh sửa</button>
                    <button class="btn btn-danger btn-sm remove-from-cart" data-index="${index}" style="margin-left: 10px;">X</button>
                </div>
                <small>${item.notes ? "Ghi chú: " + item.notes : ""}</small>`;
            cartItemsContainer.appendChild(li);
            total += item.price * item.quantity;
        });
        document.getElementById('total-price').innerText = total.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    }

    function populateCheckoutModal() {
        const checkoutItemsList = document.getElementById('checkout-items-list');
        checkoutItemsList.innerHTML = '';
        cart.forEach((item, index) => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input checkout-item" id="checkout-item-${index}" name="items[]" value="${item.name}" data-index="${index}" data-price="${item.price * item.quantity}">
                    <label class="custom-control-label" for="checkout-item-${index}">${item.quantity} x ${item.name}</label>
                </div>
                <span>${(item.price * item.quantity).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</span>`;
            checkoutItemsList.appendChild(li);
        });
    }

    document.querySelector('.menu-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('add-to-cart')) {
            const name = e.target.getAttribute('data-name');
            const price = parseFloat(e.target.getAttribute('data-price'));
            addToCart(name, price);
        }
    });

    document.querySelector('.menu-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('edit-cart-item')) {
            const index = parseInt(e.target.getAttribute('data-index'));
            const item = cart[index];

            // Gán giá trị vào modal
            document.getElementById('itemName').value = item.name;
            document.getElementById('itemQuantity').value = item.quantity;
            document.getElementById('itemPrice').value = (item.price * item.quantity).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
            document.getElementById('itemNotes').value = item.notes || '';

            // Save original price for calculations
            const originalPrice = item.price;

            // Update price dynamically when quantity changes
            document.getElementById('itemQuantity').addEventListener('input', function () {
                const newQuantity = parseInt(this.value);
                if (newQuantity > 0) {
                    const newPrice = (originalPrice * newQuantity).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
                    document.getElementById('itemPrice').value = newPrice;
                }
            });

            // Hiển thị modal
            $('#editItemModal').modal('show');

            // Xử lý khi người dùng lưu thay đổi
            document.getElementById('saveItemChanges').addEventListener('click', function () {
                const newQuantity = parseInt(document.getElementById('itemQuantity').value);
                const newNotes = document.getElementById('itemNotes').value;

                if (newQuantity > 0) {
                    // Cập nhật số lượng và ghi chú
                    cart[index].quantity = newQuantity;
                    cart[index].notes = newNotes;

                    // Cập nhật lại giỏ hàng và đóng modal
                    updateCart();
                    $('#editItemModal').modal('hide');
                } else {
                    alert('Số lượng phải lớn hơn 0.');
                }
            });
        }
    });

    document.querySelector('.menu-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-from-cart')) {
            const index = parseInt(e.target.getAttribute('data-index'));
            cart.splice(index, 1);
            updateCart();
        }
    });

    document.getElementById('checkout-button').addEventListener('click', function () {
        populateCheckoutModal();
        $('#checkoutModal').modal('show');
    });

    document.getElementById('checkout-items-list').addEventListener('change', function (e) {
        const items = document.querySelectorAll('.checkout-item');
        totalAmount = 0;
        items.forEach(item => {
            if (item.checked) {
                totalAmount += parseFloat(item.getAttribute('data-price'));
            }
        });
        document.getElementById('checkout-total-price').innerText = totalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    });

    document.getElementById('select-all-items').addEventListener('change', function () {
        const items = document.querySelectorAll('.checkout-item');
        const isChecked = this.checked;
        items.forEach(item => {
            item.checked = isChecked;
        });
        document.getElementById('checkout-items-list').dispatchEvent(new Event('change'));
    });

    document.getElementById('confirm-checkout').addEventListener('click', function () {
        if (totalAmount > 0) {
            document.getElementById('checkout-form').submit();
        } else {
            alert('Vui lòng chọn ít nhất một sản phẩm để thanh toán.');
        }
    });

    document.getElementById('clear-cart-button').addEventListener('click', function () {
        if (confirm('Bạn có chắc chắn muốn xóa giỏ hàng?')) {
            cart = [];
            updateCart();
        }
    });
</script>
@endsection
