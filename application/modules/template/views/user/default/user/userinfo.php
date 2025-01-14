<section class="page-header page-header-color page-header-primary page-header-more-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $title;?></h1>
                <ul class="breadcrumb breadcrumb-valign-mid">
                    <li><a href="<?php echo site_url();?>">Home</a></li>
                    <?php if(!empty($breadcrumb)) {
                        foreach ($breadcrumb as $title_br => $link_br) {
                            if($link_br != ""){
                                ?>
                                <li><a href="<?php echo site_url($link_br);?>"><?php echo $title_br;?></a></li>
                            <?php }else{ ?>
                                <li class="active"><?php echo $title_br;?></li>
                            <?php } } } ?>
                    </ol>
                </ul>
            </div>
        </div>
    </div>
</section>


<?php $this->load->helper("form");?>
<div class="container my-cource">
    <div class="row">
        <div class="col-md-12">
            <div style="text-align: center;color: red;font-weight: bold; margin-bottom: 15px"><?php echo $this->session->flashdata("userinfo");?></div>
            <form class="form-horizontal mb-lg" action="" method="post" enctype="multipart/form-data">
                

                <div class="form-group mt-lg">
                    <div class="col-sm-6">
                        <label class="bold">Username</label>
                        <input value="<?php echo set_value("username",$user->username);?>" type="text" disabled="disabled"  class="form-control" />
                    </div>
                    <div class="col-sm-6">
                        <label class="bold">Tên</label>
                        <input value="<?php echo set_value("fullname",$user->fullname);?>" type="text" name="fullname" class="form-control " placeholder="Nhập tên của bạn" required/>
                        <?php echo form_error("name");?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="bold">Email</label>
                        <input value="<?php echo set_value("email",$user->email);?>" type="email" name="email" class="form-control" placeholder="Nhập Email" required/>
                        <?php echo form_error("email");?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label class="bold">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Nhập nật khẩu"/>
                        <?php echo form_error('password');?>
                    </div>
                    <div class="col-sm-6">
                        <label class="bold">Xác nhận mật khẩu</label>
                        <input type="password" name="repassword" class="form-control" placeholder="Nhận lại chính xác mật khẩu"/>
                        <?php echo form_error("repassword");?>
                    </div>
                </div>
                <div style="color: red; font-weight: bold">* Lưu ý: Nếu bạn không muốn đổi mật khẩu hãy để trống 2 mục này</div>
                <div class="form-group mt-lg">
                    <div class="col-sm-6">
                        <label class="bold">Giới tính</label>
                        <select class="form-control" name="gender">
                            <option value="">Chọn giới tính</option>
                            <?php $man = $woman = false; if($user->gender == "1"){$man = true;}else{$woman = true;} ?>
                            <option value="1" <?php echo set_select("gender", 1, $man);?>">Nam</option>
                            <option value="0" <?php echo set_select("gender", 0, $woman);?>>Nữ</option>
                        </select>
                        <?php echo form_error("gender");?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label class="bold">Số điện thoại</label>
                        <input value="<?php echo set_value("phone",$user->phone);?>"  type="number" name="phone" class="form-control" placeholder="Nhập số điện thoại" required/>
                        <?php echo form_error("phone");?>
                    </div>
                </div>

                <fieldset>
                    <legend>Thông tin bổ sung</legend>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="bold">Địa chỉ</label>
                            <input value="<?php echo set_value("address",$user->address);?>"  type="text" name="address" class="form-control" placeholder="Nhập địa chỉ"/>
                            <?php echo form_error("address");?>
                        </div>
                    </div>


                   

                </fieldset>

                <div class="form-group">
                    <div class="col-sm-12">
                        <button style="width: 100%" type="submit" value="Login" name="btnSubmit" class="btn btn-3d btn-danger btn-lg ">Cập nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>