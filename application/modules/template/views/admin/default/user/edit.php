<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/22/17 3:42 PM
 * Date: 8/22/17 3:52 PM
 *
 */

$this->load->helper('form');
    $this->load->library('form_validation');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Sửa thông tin</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div style="text-align: center; color: red; font-weight: bold; padding-top: 10px; padding-bottom: 10px"><?php echo $this->session->flashdata("userinfo");?></div>
        <div class="col-lg-6">

            <div class="ibox-content animated fadeInRight">
                <?php echo validation_errors(); ?>
                <form class="form-horizontal mb-lg" action="" method="post">
                    <div class="form-group">
                            <label class="control-label col-sm-2" >Tên đăng nhập (<span class="required">*</span>):</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control input-sm" id="post_username" name="username" placeholder="" value="<?php echo set_value('username',$userinfo->username)?>">
                                <?php echo form_error('username');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" >Mật khẩu (<span class="required">*</span>):</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control input-sm" id="post_password" name="password" placeholder="" value="<?php echo set_value('password')?>">
                                <?php echo form_error('password');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" >Nhập lại Mật khẩu (<span class="required">*</span>):</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control input-sm" id="post_repassword" name="repassword" placeholder="" value="<?php echo set_value('repassword')?>">
                                <?php echo form_error('repassword');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" >Tên đầy đủ (<span class="required">*</span>):</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control input-sm" id="post_name" name="fullname" placeholder="" value="<?php echo set_value('fullname',$userinfo->fullname)?>">
                                <?php echo form_error('fullname');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" >Email (<span class="required">*</span>):</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control input-sm" id="post_email" name="email" placeholder="" value="<?php echo set_value('email',$userinfo->email)?>">
                                <?php echo form_error('email');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" >SĐT (<span class="required">*</span>):</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control input-sm" id="post_phone" name="phone" placeholder="" value="<?php echo set_value('phone',$userinfo->phone)?>">
                                <?php echo form_error('phone');?>
                            </div>
                        </div>
                    


                    

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button style="width: 100%" type="submit" value="Login" name="btnSubmit" class="btn btn-3d btn-danger btn-lg ">Cập nhật thông tin</button>
                        </div>
                    </div>
                </form>
            </div>



        </div>

        
    </div>
</div>

