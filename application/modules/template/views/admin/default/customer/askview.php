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
                        <label class="col-md-2 control-label">Họ tên:</label>

                        <div class="col-md-10">
                            <input type="text" name="name" value="<?php echo $info->fullname;?>" class="form-control">
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-2 control-label">Email:</label>

                        <div class="col-md-10">
                            <input type="text" name="email" value="<?php echo $info->email;?>" class="form-control">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Nội dung câu hỏi:</label>

                        <div class="col-md-10">
                            <textarea class="form-control textmini" name="detail" rows="15"><?php echo set_value('detail',$info->content);?></textarea>
                        </div>
                    </div>
                    <!---
                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class="col-sm-2 control-label">Ảnh đại diện (<span class="required">*</span>):</label>
                        <div class="col-sm-10">
                            <div class="input-group"><input id="post_image" name="image" type="text" class="form-control" value="<?php echo set_value('image',$info->image)?>"> <span class="input-group-btn"><button onclick="open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=post_image&akey=datnguyen2017&relative_url=1&fldr=<?php echo $module;?>/')" type="button" class="btn btn-w-m btn-primary">Tải và Chọn file ảnh từ thư viện</button></span></div>
                            <span>Lưu ý: Hình ảnh nên có kích thước 500x500px.</span>
                            <?php echo form_error('image', '<div class="error">', '</div>'); ?>

                            <div><img style="max-width: 300px;" id="post_image_thumb" alt="" src="<?php echo base_url('public/userfiles/'.$info->image);?>" alt="" /></div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Câu trả lời:</label>

                        <div class="col-md-10">
                            <textarea class="form-control" name="answer" id="news" rows="15"><?php echo set_value('answer',$info->answer);?></textarea>
                            <?php echo form_error('answer', '<span class="required">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" value="submit" name="btnSubmit" type="submit">Gửi phản hồi</button>
                        </div>
                    </div>
                    -->
                    <a onclick="window.history.back();" class="btn btn-primary"><i class="fa fa-arrow-circle-o-left"></i> Quay lại</a>
                </form>

            </div>

        </div>
    </div>
</div>

<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>