<link rel="stylesheet" href="{{ asset('poss/assets/css/backend.min.css') }}') }}">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">

<!-- Line Awesome -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">

<!-- Remixicon -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/remixicon/fonts/remixicon.css') }}">

<link rel="stylesheet" href="{{ asset('poss/assets/css/backend.min.css') }}">


<!-- Dripicons -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/@icon/dripicons/dripicons.css') }}">

<!-- FullCalendar -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/fullcalendar/core/main.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/fullcalendar/daygrid/main.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/fullcalendar/timegrid/main.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/fullcalendar/list/main.css') }}">

<!-- Mapbox -->
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/mapbox/mapbox-gl.css') }}">



<link rel="stylesheet" href="{{ asset('poss/assets/css/backend.min.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('poss/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/remixicon/fonts/remixicon.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/%40icon/dripicons/dripicons.css') }}">

<link rel='stylesheet' href="{{ asset('poss/assets/vendor/fullcalendar/core/main.css') }}">
<link rel='stylesheet' href="{{ asset('poss/assets/vendor/fullcalendar/daygrid/main.css') }}">
<link rel='stylesheet' href="{{ asset('poss/assets/vendor/fullcalendar/timegrid/main.css') }}">
<link rel='stylesheet' href="{{ asset('poss/assets/vendor/fullcalendar/list/main.css') }}">
<link rel="stylesheet" href="{{ asset('poss/assets/vendor/mapbox/mapbox-gl.css') }}">




<style>
    /* Active Tab Styling */
    .nav-link.active {
        color: #004a89;
        font-weight: bold;
        padding: 12px 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, color 0.3s ease;
        z-index: 2;
    }

    /* Inactive Tab Styling */
    .nav-link:not(.active) {
        margin-left:  10px;
        transition: all 0.3s ease;
        z-index: 0;
    }

    /* Hover effect for tabs */
    .nav-link:not(.active):hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: #fff;
        transition: all 0.3s ease-in-out;
    }

    /* Icon hover effect */
    .nav-link i {
        margin-right: 8px;
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    .nav-link:hover i {
        transform: scale(1.1);
    }

    /* Search Bar Styling */
    .form-control {
        background-color: transparent;
        border: none;
        border-bottom: 1px solid #fff;
        color: #fff;
        width: 250px;
        margin-left: 40px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-bottom: 1px solid #f1f1f1;
        outline: none;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
        font-size: 14px;
    }

    /* Wrapper styling */
    .wrapper {
        min-height: calc(100vh - 50px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Container flex layout */
    .container-fluid {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        flex-grow: 1;
        padding: 0 10px;
    }

    /* Table and Order sections */
    .table-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding: 20px;
    }

    .order-section {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-color: #ffffff;
        padding: 20px;
        margin-top: 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Search and icon button styles */
    .search-container {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 50px;
        padding: 5px 15px;
        background-color: #f7f7f7;
        max-width: 300px;
    }

    .icon-buttons {
        display: flex;
        gap: 15px;
    }

    .icon-buttons .btn-icon {
        background: none;
        border: none;
        color: #007bff;
        padding: 5px;
        font-size: 22px;
        border-radius: 50%;
        min-width: 40px;
        min-height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.2s ease;
    }

    .icon-buttons .btn-icon:hover {
        background-color: #f0f0f0;
    }

    /* Table grid layout */
    .table-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-gap: 20px;
        margin-top: 20px;
    }

    .table-box {
        background-color: white;
        width: 135px;
        height: 135px;
        display: flex;
        justify-content: center;
        text-align: center;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        border: 1px solid #ccc;
        transition: transform 0.2s, box-shadow 0.2s;
        padding: 10px;
    }

    .table-box:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .table-name {
        font-weight: bold;
        font-size: 16px;
    }

    .table-details {
        font-size: 14px;
        margin-top: 5px;
        color: #888;
    }

    .table-details i {
        margin-right: 5px;
    }

    /* Table location button */
    .table-location .btn {
        background-color: #f7f7f7;
        border: 1px solid #ddd;
        border-radius: 50px;
        color: #007bff;
        padding: 10px 20px;
        font-size: 14px;
    }

    .table-location .btn i {
        margin-right: 8px;
    }


     /* --------------------css Ben phía INDEX---------------------- */
     .table-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .table-box {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: calc(20% - 20px);
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            cursor: pointer;
        }

        .table-name {
            font-size: 18px;
            font-weight: bold;
        }

        .table-details {
            margin: 10px 0;
        }

        .table-status {
            font-size: 14px;
            color: gray;
        }

        .table-price {
            font-size: 16px;
            color: #28a745;
            font-weight: bold;
        }
        .filter-section {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .filter-btn {
            padding: 10px 20px;
            border-radius: 50px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
        }

        .filter-btn.active {
            background-color: #007bff;
            color: white;
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.15);
        }

        .filter-btn:hover {
            background-color: #0056b3;
            color: white;
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
        }

        .order-item {
            margin-bottom: 10px;
        }

        .order-item span:nth-child(2) {
            color: #28a745;
            font-weight: bold;
        }

        .quantity-input {
            margin-left: 10px;
        }

        #notification {
            display: none;
            position: fixed;
            bottom: 10px;
            right: 10px;
            z-index: 9999;
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        #notification strong {
            margin-right: 10px;
        }
</style>
