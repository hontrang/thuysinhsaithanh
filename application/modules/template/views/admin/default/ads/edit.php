<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/6/17 11:04 AM
 * Date: 10/6/17 11:18 AM
 *
 */

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
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tiêu đề (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="name" value="<?php echo set_value('name',$info->name)?>" class="form-control">
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Vị trí (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <select class="form-control" name="position">
                                <option value="left" <?php if($info->position == "left")echo "selected";?>>Menu trái</option>
                                <!--<option value="top" <?php if($info->position == "top")echo "selected";?>>Đầu trang</option>
                                <option value="bottom" <?php if($info->position == "bottom")echo "selected";?>>Cuối trang</option>-->
                            </select>
                            <?php echo form_error('position', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <!--

                    <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh (<span class="required">*</span>):</label>
                        <div class="col-sm-10">
                            <div class="input-group"><input id="post_image" name="image" type="text" class="form-control" value="<?php echo set_value('image',$info->image)?>"> <span class="input-group-btn"><button onclick="open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=post_image&akey=datnguyen2017&relative_url=1&fldr=slide/')" type="button" class="btn btn-w-m btn-primary">Tải và Chọn file ảnh từ thư viện</button></span></div>
                            <span>Lưu ý: Để đảm bảo bố cục, hình ảnh nên được crop giống nhau ở 750x300px.</span>
                            <?php echo form_error('image', '<div class="error">', '</div>'); ?>

                            <div><img style="max-width: 200px;" id="post_image_thumb" alt="" src="<?php echo base_url('public/userfiles/'.$info->image);?>" alt="" /></div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">URL:</label>

                        <div class="col-md-8">
                            <input type="text" name="url" value="<?php echo set_value('url',$info->url)?>" class="form-control">
                            <?php echo form_error('url', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ngày bắt đầu (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="date" name="ads_from" value="<?php echo set_value('ads_from',$info->ads_from)?>" class="form-control">
                            <?php echo form_error('ads_from', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ngày kết thúc (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="date" name="ads_to" value="<?php echo set_value('ads_to',$info->ads_to)?>" class="form-control">
                            <?php echo form_error('ads_to', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                    -->
                    <div class="form-group">
                        <label class="col-md-2 control-label">Nội dung (<span class="required">*</span>):</label>

                        <div class="col-md-10">
                            <textarea name="content" rows="10" class="form-control editor_full"><?php echo set_value('content',$info->content)?></textarea>
                            <?php echo form_error('content');?>
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