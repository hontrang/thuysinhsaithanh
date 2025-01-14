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
                <div style="text-align: center; color: red;font-weight: bold; margin-bottom: 10px;">
                    <?php echo $this->session->flashdata("error");?>
                </div>
                <form method="POST" action="" class="form-horizontal">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Module (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="set" value="<?php echo $this->session->userdata("set_home");?>" class="form-control">
                            <?php echo form_error('set', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Key (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="key" value="<?php echo set_value('key')?>" class="form-control">
                            <?php echo form_error('key', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Tiếng việt (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="text" value="<?php echo set_value('text')?>" class="form-control">
                            <?php echo form_error('text', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>



                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" value="submit" name="submit" type="submit">Thêm</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>