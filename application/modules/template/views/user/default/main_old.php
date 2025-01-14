<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="vi, en" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon" />
    <link rel="icon" href="favicon.ico" type="image/gif" />

    <link rel="stylesheet" type="text/css" href="/public/templates/user/default/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/public/templates/user/default/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/public/templates/user/default/css/hover-min.css"/>
    <link rel="stylesheet" href="/public/templates/user/default/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="/public/fancybox/jquery.fancybox.min.css"/>
    <link href="https://fonts.googleapis.com/css?family=Anton&amp;subset=latin-ext,vietnamese" rel="stylesheet">

    <link href="/public/fileuploader/css/jquery.fileuploader.css" rel="stylesheet" type="text/css" />
    <link href="/public/fileuploader/css/jquery.fileuploader-theme-thumbnails-user.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="/public/templates/user/default/css/style.css"/>
    <script type="text/javascript" src="/public/templates/user/default/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/templates/user/default/js/embed-flash.js"></script>
    <title><?php if(isset($title) and $title != "")echo $title." | ".$site_config['title_'.$lang];else echo $site_config['title_'.$lang];?></title>
    <meta name="keywords" content="Shing Mark Hospital, shingmarkhospital, shingmark hospital, shing mark hospital,bệnh viên vì người nghèo, bênh viện đại học y dược" />
    <meta name="description" content="<?php if(isset($description))echo max_len($description,250);else echo max_len($site_config['description_'.$lang],250);?>" />

    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php if(isset($title) and $title != "")echo $title." | ".$site_config['title_'.$lang];else echo $site_config['title_'.$lang];?>" />
    <meta property="og:image" content="<?php if(isset($image_share))echo $image_share;else echo base_url('public/userfiles/logo_share.jpg');?>" />
    <meta property="og:url" content="<?php echo site_url(uri_string());?>" />
    <meta property="og:site_name" content="<?php if(isset($title) and $title != "")echo $title;else echo $site_config['title_'.$lang];?>" />
    <meta property="og:description" content="<?php if(isset($description))echo max_len($description,250);else echo max_len($site_config['description_'.$lang],250);?>" />

</head>
<body>


<?php
echo $this->load->widget('menu_top');
?>


<?php
echo $this->load->view('user/'.$current_template.'/'.$module.'/'.$method);
?>


<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-4 col-xs-12">
                <h2><?php echo $this->lang->line('contact');?></h2>

                <ul>
                    <li class="footer-title"><h1><?php echo $site_config['title_'.$lang];?></h1></li>
                    <li>Add: <?php echo $site_config['address_'.$lang];?></li>
                    <li>Tel: <?php echo $site_config['phone'];?></li>
                    <li>Email: <a href="mailto:<?php echo $site_config['email'];?>"><?php echo $site_config['email'];?></a></li>
                </ul>			</div>
            <div class="col-lg-3 col-xs-12">
                <h2><?php echo $this->lang->line('hotline');?></h2>

                <?php echo $site_config['business_phone_'.$lang];?>
            </div>
            <div class="col-lg-3 col-xs-12">
                <h2><?php echo $this->lang->line('business_time');?></h2>

                <?php echo $site_config['gio-lam-viec-1_'.$lang];?>
            </div>
            <div class="col-lg-3 col-xs-12">
                <h2><?php echo $this->lang->line('register_email');?>
                </h2>
                <ul>

                    <li>
                        <form class="form-horizontal" action="/subscribe" method="post">
                            <input placeholder="<?php echo $this->lang->line('hay_nhap_email');?>" class="email-s" name="email" type="text">
                            <input name="btnSubmit" value="<?php echo $this->lang->line('register');?>" class="btn btn-danger btn-sm" style="margin: 0 10px;" type="submit">
                            <div style="clear:both">
                            </div>
                        </form>
                    </li>
                    <li>
                        <div class="fb-page" data-href="<?php echo $site_config['facebook'];?>" data-width="380"
                             data-hide-cover="false"
                             data-show-facepile="false"><blockquote cite="<?php echo $site_config['facebook'];?>" class="fb-xfbml-parse-ignore"><a href="<?php echo $site_config['facebook'];?>">University Medical Shing Mark Hospital</a></blockquote></div>

                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-12 fanpage">
                </div>
        </div>
        <div class="copyright row">
            <div class="container">
                <div class="site-name">©2017 <?php echo $site_config['title_'.$lang];?>.</div>
                <div class="dos">Phát triển bởi <a href="http://dos.vn">DOS.VN</a> </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="/public/templates/user/default/js/bootstrap-toolkit.min.js"></script>
<script type="text/javascript" src="/public/templates/user/default/js/jssor.slider-26.8.0.min.js"></script>
<script type="text/javascript" src="/public/templates/user/default/js/image-scale.min.js"></script>
<script type="text/javascript" src="/public/templates/user/default/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/public/templates/user/default/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/public/fancybox/jquery.fancybox.min.js"></script>
<script src="/public/templates/admin/default/js/plugins/tinymce/tinymce.min.js"></script>
<?php
if(isset($scripts))
    foreach ($scripts as $script)
        echo $script;
?>

<script type="text/javascript" src="/public/templates/user/default/js/common.js"></script>
<?php echo $site_config['google-analytic'];?>
<?php echo $site_config['chat'];?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=344955252529739';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
	
</body>
</html>
