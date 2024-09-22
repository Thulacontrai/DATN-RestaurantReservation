<!-- Javascript Files
    ================================================== -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var selectedTime = null;
        var selectedDate = null;

        // Khi người dùng bấm vào ngày
        $('.day-selector').click(function() {
            var index = $(this).data('index'); // Lấy chỉ số của ngày được bấm

            // Ẩn tất cả các khung thời gian
            $('.time-slots').hide();

            // Hiển thị khung thời gian của ngày được chọn
            $('#day-' + index).show();

            // Đổi màu chữ cho ngày đã chọn
            $('.day-selector .fw-bold').removeClass('text-warning').addClass('text-light');
            $(this).find('.fw-bold').removeClass('text-light').addClass('text-warning');
        });

        // Khi người dùng chọn khung giờ
        $('.time-slot').click(function() {
            // Bỏ chọn khung giờ trước đó
            $('.time-slot').removeClass('bg-warning');
            $('.time-slot p').removeClass('text-light').addClass(
                'text-warning');

            // Đánh dấu khung giờ được chọn
            $(this).addClass('bg-warning');
            $(this).find('p').removeClass('text-warning').addClass(
                'text-light');

            // Lưu lại khung giờ và ngày được chọn
            selectedTime = $(this).data('time');
            selectedDate = $(this).data('date');
        });

        $('#confirm-button').click(function() {
            if (selectedTime && selectedDate) {

                Swal.fire({
                    icon: "question",
                    html: 'Bạn đã chọn thời gian dùng bữa lúc <b>' + selectedTime +
                        '</b> vào ngày <b>' + selectedDate + '</b>',
                    title: 'Vui lòng xác nhận!',
                    showCancelButton: true,
                    confirmButtonText: "Xác nhận",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = '/customerInformation?date=' + encodeURIComponent(
                                selectedDate) +
                            '&time=' +
                            encodeURIComponent(selectedTime);
                        window.location.href = url;
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: "Vui lòng chọn khung giờ!",
                    timer: 4000
                });
            }
        });

    });
</script>
<script src="client/js/plugins.js"></script>
<script src="client/js/designesia.js"></script>

<!-- RS5.0 Core JS Files -->
<script src="client/revolution/js/jquery.themepunch.tools.min838f.js?rev=5.0"></script>
<script src="client/revolution/js/jquery.themepunch.revolution.min838f.js?rev=5.0"></script>

<!-- RS5.0 Extensions Files -->
<script src="client/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="client/revolution/js/extensions/revolution.extension.parallax.min.js"></script>

<script>
    jQuery(document).ready(function() {
        // revolution slider
        jQuery("#revolution-slider").revolution({
            sliderType: "standard",
            sliderLayout: "fullscreen",
            delay: 3500,
            navigation: {
                arrows: {
                    enable: true
                }
            },
            parallax: {
                type: "mouse",
                origo: "slidercenter",
                speed: 2000,
                levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
            },
            spinner: "off",
            gridwidth: 1140,
            gridheight: 600,
            disableProgressBar: "on"
        });
    });
</script>
