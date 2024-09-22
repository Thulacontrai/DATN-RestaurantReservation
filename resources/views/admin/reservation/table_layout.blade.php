<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Layout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .table-layout {
            display: grid;
            grid-template-columns: repeat(5, 100px);
            gap: 20px;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table {
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #cccccc; /* Mặc định là màu trắng */
            border-radius: 10px;
            cursor: pointer;
            background-color: #ffffff; /* Trạng thái bàn trống */
            transition: background-color 0.3s, border-color 0.3s;
        }
        .table.selected {
            background-color: #28a745; /* Màu xanh khi được chọn */
            border-color: #28a745;
        }
        .table.Reserved {
            background-color: #fff9c4; /* Màu vàng nhạt cho bàn đã đặt */
            border-color: #fdd835;
            cursor: not-allowed;
        }
        .table.occupied {
            background-color: #ffcccb; /* Màu đỏ nhạt cho bàn đang sử dụng */
            border-color: #e53935;
            cursor: not-allowed;
        }
        .table-number {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Danh sách bàn</h1>

    <form action="{{ route('admin.submit.tables') }}" method="POST" id="reservationForm">
        @csrf
        <input type="hidden" name="reservation_id" value="{{ $reservationId }}">
        <div class="table-layout" id="table-layout">
            @foreach ($tables as $table)
                <div 
                    class="table 
                    {{ $table->status === 'Reserved' ? 'Reserved' : '' }}
                    {{ $table->status === 'Occupied' ? 'Occupied' : '' }}"
                    data-id="{{ $table->id }}"
                    data-status="{{ $table->status }}">
                    <span class="table-number">{{ $table->table_number }}</span>
                </div>
            @endforeach
        </div>

        <button type="submit" id="confirmSelection">Xác nhận</button>
    </form>

    <script>
        // Xử lý chọn bàn
        document.querySelectorAll('.table').forEach(table => {
            table.addEventListener('click', () => {
                const status = table.getAttribute('data-status');
                
                if (status === 'Reserved' || status === 'occupied') {
                    // Hiển thị thông báo nếu bàn đã được đặt hoặc đang sử dụng
                    alert('Bàn này đã được đặt hoặc đang có khách.');
                } else {
                    // Chọn hoặc bỏ chọn bàn
                    table.classList.toggle('selected');
                }
            });
        });

        // Gửi danh sách bàn đã chọn khi nhấn nút "Xác nhận"
        document.getElementById('reservationForm').addEventListener('submit', (event) => {
            event.preventDefault(); // Ngăn chặn submit form ngay lập tức
            
            // Lấy danh sách ID các bàn đã chọn
            const selectedTables = Array.from(document.querySelectorAll('.table.selected'))
                .map(table => table.getAttribute('data-id'));
            
            // Tạo input hidden cho từng ID của bàn đã chọn
            selectedTables.forEach(tableId => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'tables[]'; // Dạng mảng
                input.value = tableId;
                document.getElementById('reservationForm').appendChild(input);
            });

            // Sau khi thêm input, submit form
            document.getElementById('reservationForm').submit();
        });
    </script>
</body>
</html>
