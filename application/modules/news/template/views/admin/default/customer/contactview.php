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
                <form method="POST" action="/admin/customer/contact.html" class="form-horizontal">
                    <input type="hidden" value="" name="act">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Họ tên:</label>

                        <div class="col-md-10">
                            <input type="text" name="name" value="<?php echo $info->name;?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">SĐT:</label>

                        <div class="col-md-10">
                            <input type="text" name="phone" value="<?php echo $info->phone;?>" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Email:</label>

                        <div class="col-md-10">
                            <input type="text" name="email" value="<?php echo $info->email;?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Tiêu đề:</label>

                        <div class="col-md-10">
                            <input type="text" name="email" value="<?php echo $info->title;?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Nội dung:</label>

                        <div class="col-md-10">
                            <textarea class="form-control" rows="15"><?php echo $info->content;?></textarea>
                        </div>
                    </div>


                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" value="submit" name="submit" type="submit">Quay lại</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>