<?php


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
                            <input type="text" name="name" value="<?php echo set_value('name')?>" class="form-control">
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Vị trí (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <select class="form-control" name="position">
                                <option value="left">Menu Trái</option>
                                <!--<option value="top">Đầu trang</option>
                                <option value="bottom">Cuối trang</option>-->
                            </select>
                            <?php echo form_error('position', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                    <!--
                    <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh (<span class="required">*</span>):</label>
                        <div class="col-sm-10">
                            <div class="input-group"><input id="post_image" name="image" type="text" class="form-control" value="<?php echo set_value('image')?>"> <span class="input-group-btn"><button onclick="open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=post_image&akey=datnguyen2017&relative_url=1&fldr=slide/')" type="button" class="btn btn-w-m btn-primary">Tải và Chọn file ảnh từ thư viện</button></span></div>
                            <span>Lưu ý: Để đảm bảo bố cục, hình ảnh nên được crop giống nhau ở 150x150px.</span>
                            <?php echo form_error('image', '<div class="error">', '</div>'); ?>

                            <div><img style="max-width: 200px;" id="post_image_thumb" alt="" src="" alt="" /></div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">URL:</label>

                        <div class="col-md-8">
                            <input type="text" name="url" value="<?php echo set_value('url')?>" class="form-control">
                            <?php echo form_error('url', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ngày bắt đầu (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="date" name="ads_from" value="<?php echo set_value('ads_from')?>" class="form-control">
                            <?php echo form_error('ads_from', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Ngày kết thúc (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="date" name="ads_to" value="<?php echo set_value('ads_to')?>" class="form-control">
                            <?php echo form_error('ads_to', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                    -->

                    <div class="form-group">
                        <label class="col-md-2 control-label">Nội dung (<span class="required">*</span>):</label>

                        <div class="col-md-10">
                            <textarea name="content" rows="10" class="form-control editor_full"><?php echo set_value('content')?></textarea>
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