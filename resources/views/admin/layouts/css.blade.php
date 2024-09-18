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

    </style>

