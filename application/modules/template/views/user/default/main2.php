<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php if(isset($title) and $title != "")echo $title." | ".$site_config['title_'.$lang];else echo $site_config['title_'.$lang];?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="<?php if(isset($description))echo max_len($description,250);else echo max_len($site_config['description_'.$lang],250);?>" />

    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php if(isset($title) and $title != "")echo $title." | ".$site_config['title_'.$lang];else echo $site_config['title_'.$lang];?>" />
    <meta property="og:image" content="<?php if(isset($image_share))echo $image_share;else echo base_url('public/userfiles/logo_share.jpg');?>" />
    <meta property="og:url" content="<?php echo site_url(uri_string());?>" />
    <meta property="og:site_name" content="<?php if(isset($title) and $title != "")echo $title;else echo $site_config['title_'.$lang];?>" />
    <meta property="og:description" content="<?php if(isset($description))echo max_len($description,250);else echo max_len($site_config['description_'.$lang],250);?>" />

    <meta name="author" content="DOS.VN">

    <!-- ================= Meta ================== -->
    <meta name="keywords" content=", "/>
    <link rel="canonical" href=""/>
    <meta name='revisit-after' content='1 days' />
    <meta name="robots" content="noodp,index,follow" />
    <!-- ================= Favicon ================== -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='/public/templates/user/default/css/style.css?v=216' rel='stylesheet' type='text/css'  media='all'  />
    <link href='/public/templates/user/default/css/plugin.css?v=216' rel='stylesheet' type='text/css'  media='all'  />
    <link href='/public/templates/user/default/css/base.css?v=216' rel='stylesheet' type='text/css'  media='all'  />
    <link href='/public/templates/user/default/css/ant-furniture.css?v=216' rel='stylesheet' type='text/css'  media='all'  />
</head>
<body>
<?php
echo $this->load->widget('menu_top');
?>
<script src='/public/templates/user/default/js/jquery-2.2.3.min.js?v=216' type='text/javascript'></script>


<?php
echo $this->load->view('user/'.$current_template.'/'.$module.'/'.$method);
?>
<?php
echo $this->load->widget('footer');
?>
<div class="hotline_fixed">
    <a href="tel:<?php echo $site_config['phone'];?>" title="Click gọi điện liên hệ tư vấn ngay!!!"></a>
</div>
<script src='/public/templates/user/default/js/bootstrap-notify.js?v=216' type='text/javascript'></script>




<script src="/public/templates/user/default/js/option_selection.js" type="text/javascript"></script>
<script src="/public/templates/user/default/js/api.jquery.js" type="text/javascript"></script>
<script src="/public/templates/user/default/js/owl.carousel.min.js?v=216" type="text/javascript"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js" type='text/javascript'></script>
<script>$.validate({});</script>
<!-- Add to cart -->
<div class="ajax-load">
<span class="loading-icon">
		<svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
            <rect x="0" y="10" width="4" height="10" fill="#333" opacity="0.2">
            <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s" repeatCount="indefinite" />
            </rect>
            <rect x="8" y="10" width="4" height="10" fill="#333"  opacity="0.2">
            <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
            </rect>
            <rect x="16" y="10" width="4" height="10" fill="#333"  opacity="0.2">
            <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
            </rect>
            </svg></span>
</div>

<div class="loading awe-popup">
    <div class="overlay"></div>
    <div class="loader" title="2">
        <svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
            <rect x="0" y="10" width="4" height="10" fill="#333" opacity="0.2">
                <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.6s" repeatCount="indefinite" />
                <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.6s" repeatCount="indefinite" />
                <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s" repeatCount="indefinite" />
            </rect>
            <rect x="8" y="10" width="4" height="10" fill="#333"  opacity="0.2">
                <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
                <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite" />
            </rect>
            <rect x="16" y="10" width="4" height="10" fill="#333"  opacity="0.2">
                <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
                <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite" />
            </rect>
            </svg>
    </div>

</div>


<script src='/public/templates/user/default/js/appear.js?v=216' type='text/javascript'></script>
<script src='/public/templates/user/default/js/main.js?v=216' type='text/javascript'></script>

<link href='/public/templates/user/default/css/lightbox.css?v=216' rel='stylesheet' type='text/css'  media='all'  />
<script src='/public/templates/user/default/js/jquery.elevatezoom308.min.js?v=216' type='text/javascript'></script>

<script src='/public/templates/user/default/js/jquery.prettyPhoto.min005e.js?v=216' type='text/javascript'></script>
<script src='/public/templates/user/default/js/jquery.prettyPhoto.init.min367a.js?v=216' type='text/javascript'></script>

<div class="backdrop__body-backdrop___1rvky"></div>

</body>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            xfbml            : true,
            version          : 'v4.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
     attribution=setup_tool
     page_id="976017852472478"
     logged_in_greeting="Hi! Chúng tôi có thể hỗ trợ gì cho bạn?"
     logged_out_greeting="Hi! Chúng tôi có thể hỗ trợ gì cho bạn?">
</div>
</html>
