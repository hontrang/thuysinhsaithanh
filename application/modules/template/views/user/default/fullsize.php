<!DOCTYPE html>
<html>
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $title;?> | <?php echo $site_config['title'];?></title>

    <meta name="keywords" content="Dạy tiếng Hàn, họcTiếng Hàn online" />
    <meta name="description" content="<?php echo $site_config['description'];?>">
    <meta name="author" content="dos.vn">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light|Bungee|Oswald:500" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/animate/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/magnific-popup/magnific-popup.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/css/theme-elements.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/css/theme-blog.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/css/theme-shop.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/css/jstarbox.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/rs-plugin/css/settings.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/rs-plugin/css/layers.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/rs-plugin/css/navigation.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/circle-flip-slideshow/css/component.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/nivo-slider/nivo-slider.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/nivo-slider/default/default.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/hover.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/stretchy-navigation/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/pace/themes/orange/pace-theme-flash.css">
    <link rel="stylesheet" href="/public/player/plyr.css">


    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/css/skins/default.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public/templates/user/'.$current_template);?>/css/custom.css">

    <!-- Head Libs -->
    <script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/modernizr/modernizr.min.js"></script>
    <script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/jquery/jquery.min.js"></script>
    <script>
        jQuery.ajax({
            type: "POST",
            url: "/thong-ke",
        });
    </script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
</head>
<body>


<?php
echo $this->load->view('user/'.$current_template.'/'.$module.'/'.$method);
?>





<!-- Vendor -->

<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/jquery-cookie/jquery-cookie.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/common/common.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/jquery.validation/jquery.validation.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/jquery.gmap/jquery.gmap.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/isotope/jquery.isotope.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/vide/vide.min.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/js/theme.js"></script>
<script src="/public/player/plyr.js"></script>


<!-- Current Page
<?php echo base_url('public/templates/user/'.$current_template);?>/vendor and Views -->
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/nivo-slider/jquery.nivo.slider.min.js"></script>
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/vendor/pace/pace.min.js"></script>


<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/js/views/view.home.js"></script>


<!-- Theme Custom -->
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="<?php echo base_url('public/templates/user/'.$current_template);?>/js/theme.init.js"></script>
<script>
    (function() {
        // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
        // e.g. just plyr.setup(); and leave it at that if you have no need for events
        var instances = plyr.setup({
        });


        // Get an element
        function get(selector) {
            return document.querySelector(selector);
        }

        // Custom event handler (just for demo)
        function on(element, type, callback) {
            if (!(element instanceof HTMLElement)) {
                element = get(element);
            }
            element.addEventListener(type, callback, false);
        }


        // Loop through each instance
        instances.forEach(function(instance) {
            // Play
            //on('.js-play', 'click', function() {
                //instance.play();
            //});
        });
    })();
</script>
<?php
if(isset($scripts))
    foreach ($scripts as $script)
        echo $script;
?>

<?php echo $site_config['tawk'];?>
</body>
</html>