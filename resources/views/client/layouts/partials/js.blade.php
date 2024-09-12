<!-- Javascript Files
    ================================================== -->
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
        jQuery(document).ready(function () {
            // revolution slider
            jQuery("#revolution-slider").revolution({
                sliderType: "standard",
                sliderLayout: "fullscreen",
                delay: 3500,
                navigation: {
                    arrows: { enable: true }
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