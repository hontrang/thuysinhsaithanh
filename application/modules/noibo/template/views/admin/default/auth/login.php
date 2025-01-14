<?php
$this->load->library('form_validation');

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <img src="/public/userfiles/logo_preloader.png" width="100px" alt="logo">
        <p></p>
        <p>Vui lòng đăng nhập để tiếp tục.</p>
        <form class="m-t" role="form" method="POST" action="">
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="User" required="">
                <?php echo form_error('email', '<div class="error">', '</div>'); ?>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required="">
                <?php echo form_error('password', '<div class="error">', '</div>'); ?>
            </div>
            <button type="submit" name="btnSubmit" value="login" class="btn btn-primary block full-width m-b">Login</button>


        </form>
        <div class="col-md-12" align="center" style="padding-top: 10px;">
            <span style="font-weight: bold; color: red;"><?php if(isset($error)){echo $error;}?></span>
        </div>
        <p class="m-t"> <small>DOS.VN &copy; 2017</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/bootstrap.min.js"></script>

</body>

</html>
