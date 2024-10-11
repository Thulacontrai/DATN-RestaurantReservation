<!-- CSS Files
    ================================================== -->
<link rel="stylesheet" href="client/css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="client/css/plugins.css" type="text/css">
<link rel="stylesheet" href="client/css/style.css" type="text/css">
<link rel="stylesheet" href="client/css/coloring.css" type="text/css">

<!-- css for scheme color -->
<link rel="stylesheet" href="client/css/colors/cream.css" type="text/css" id="colors">

<!-- custom css -->
<link rel="stylesheet" href="client/css/03_custom.css" type="text/css">

<!-- Slider Revolution Stylesheet -->
<link rel="stylesheet" type="text/css" href="client/revolution/css/settings.css">
<link rel="stylesheet" type="text/css" href="client/revolution/css/layers.css">
<link rel="stylesheet" type="text/css" href="client/revolution/css/navigation.css">
<link rel="stylesheet" type="text/css" href="client/revolution/css/rev-settings.css">

<link rel="stylesheet" href="{{ asset('adminn/assets/fonts/bootstrap/bootstrap-icons.css') }}">


<style>
    /* css của member */
    .progress-bar {
            background-color: #ff3300;
        }
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

    /* css login member  */
    

  .pagination {
    display: flex;
    justify-content: center;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
    margin: 0;
}

.pagination .page-item {
    margin: 0 8px;
}

.pagination .page-link {
    color: #070707;
    background-color: #ffffff; /* Neutral dark gray background */
    border: none;
    border-radius: 50%;
    padding: 10px 20px;
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background-color 0.3s ease, color 0.3s ease;
    font-size: 18px;
}

.pagination .page-link:hover {
    background-color: #28a745; /* Green for hover effect */
    color: white;
}

.pagination .page-item.active .page-link {
    background-color: #007bff; /* Highlight active page */
    color: white;
    border: 2px solid #007bff;
}

.pagination .page-link:focus {
    outline: none;
    box-shadow: none;
}

.pagination .page-link.disabled {
    background-color: #dee2e6;
    color: #6c757d;
    border: none;
}


.page-item .page-link {
    background-color: #fff; /* Màu nền mặc định cho các nút */
    color: #000; /* Màu chữ mặc định */
    border: 1px solid #ddd; /* Đường viền nhẹ */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 5px;
}

.page-item.active .page-link {
    background-color: #007bff; /* Màu xanh dương nhạt cho nút đang được chọn */
    color: #fff; /* Màu chữ trắng cho nút đang chọn */
    border-color: #007bff; /* Đường viền trùng với màu nền của nút */
}

.page-item .page-link:hover {
    background-color: #f0f0f0; /* Màu nền khi hover */
    color: #007bff; /* Màu chữ khi hover */
    border-color: #007bff; /* Đường viền khi hover */
}

.page-item.disabled .page-link {
    color: #ddd; /* Màu cho các nút bị vô hiệu hóa */
    background-color: transparent;
    border-color: #ddd;
}

.menu-category:hover {
                background-color: #f8f8f8;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                transform: scale(1.05);
            }

            .text-description {
                white-space: nowrap;
                /* Đảm bảo mô tả chỉ nằm trên 1 dòng */
                overflow: hidden;
                /* Ẩn phần văn bản vượt quá nếu quá dài */
                text-overflow: ellipsis;
                /* Thêm dấu '...' nếu văn bản quá dài */
            }


</style>
