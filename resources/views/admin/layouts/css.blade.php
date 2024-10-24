<style>
    .heart-btn {
        width: 70px;
        height: 40px;
        background-color: #4267cd;
        border-radius: 6px;
        border: 2px solid #4267cd;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }

    .heart-btn i {
        font-size: 25px;
        color: #ffffff;
        transition: color 0.3s ease;
    }

    /* Hover Effect */
    .heart-btn:hover {
        background-color: #62cd42;
        border-color: #62cd42;
        transform: translateY(-5px);
        box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.15);
    }

    .heart-btn:hover i {
        color: #fff;
    }

    .heart-btn.clicked {
        background-color: #9370DB;
        border-color: #9370DB;
    }

    .heart-btn.clicked i {
        color: #4267cd;
    }

    .bi-trash0::before {
        content: "\f5de";
        padding-top: 16px;
        padding-left: 2px;
    }

    /* Scrollbar styling */
    .sidebarMenuScroll {
        max-height: 600px;
        /* Chiều cao tối đa, có thể điều chỉnh theo ý muốn */
        overflow-y: auto;
        /* Kích hoạt thanh cuộn dọc */
    }

    .sidebarMenuScroll::-webkit-scrollbar {
        width: 8px;
    }

    .sidebarMenuScroll::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 4px;
    }
</style>
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Căn chỉnh các trường input, select và button */
    form .form-control-sm,
    form .form-select-sm {
        height: 38px;
    }

    form .btn-sm {
        height: 38px;
        padding: 8px 16px;
    }

    .filter-btn i {
        font-size: 24px;
        margin-left: 10px;
    }

    /* Khoảng cách giữa các hàng trong bảng và các ô */
    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .table th {
        font-weight: bold;
        color: #343a40;
        background-color: #f8f9fa;
    }

    .table td .actions i {
        font-size: 18px;
        margin-right: 8px;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f3f5;
    }

    .pagination {
        animation: fadeIn 0.3s;
    }


.delete-svgIcon  {
  width: 15px;
  transition-duration: 0.3s;
}

.delete-svgIcon path {
  fill: rgb(241, 21, 21);
}
.delete-svgIcon1 path {
  fill: rgb(21, 104, 228);
}
.delete-svgIcon1  {
  width: 15px;
  transition-duration: 0.3s;
}

</style>
