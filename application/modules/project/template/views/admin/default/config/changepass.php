<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 10:19 AM
 * Date: 9/15/17 4:09 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 10:20 AM
 * Date: 9/15/17 3:34 PM
 *
 */

$this->load->helper('form');
$this->load->library('form_validation');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title;?></h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <form method="POST" action="" class="form-horizontal">
                    <input type="hidden" value="" name="act">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Mật khẩu cũ (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="password" name="oldpass" value="<?php echo set_value('oldpass')?>" class="form-control">
                            <?php echo form_error('oldpass', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Mật khẩu mới (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="password" name="newpass" value="<?php echo set_value('newpass')?>" class="form-control">
                            <?php echo form_error('newpass', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Nhập lại mật khẩu mới (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="password" name="renewpass" value="<?php echo set_value('renewpass')?>" class="form-control">
                            <?php echo form_error('renewpass', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div style="text-align: center; font-weight: bold; color: red"><?php echo $this->session->flashdata('changepass_msg');?></div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" value="submit" name="submit" type="submit">Thay đổi</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>