<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/28/17 10:47 AM
 * Date: 9/1/17 4:53 PM
 *
 */

$this->load->helper('form');
    $this->load->library('form_validation');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Nạp tiền cho người dùng</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox-content animated fadeInRight">
                <?php echo validation_errors(); ?>
                <form class="form-horizontal" role="form" action="" method="POST">
                <div class="" style="max-width: 1000px; margin: auto;">

                        <div class="form-group">
                            <label class="control-label col-sm-2" >Tên đăng nhập (<span class="required">*</span>):</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control input-sm" id="post_username" name="username" placeholder="" value="<?php echo set_value('username')?>">
                                <?php echo form_error('username');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" >Số tiền (<span class="required">*</span>):</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control input-sm" id="post_money" name="money" placeholder="" value="<?php echo set_value('money')?>">
                                <?php echo form_error('money');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" >Lý do (<span class="required">*</span>):</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control input-sm" id="post_note" name="note" value="<?php echo set_value('note', "Nạp tiền vào tài khoản")?>">
                                <?php echo form_error('note');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12" align="center">
                                <input type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" value="Nạp tiền" />
                            </div>
                        </div>


                </div>
                </form>
            </div>



        </div>
    </div>
</div>

