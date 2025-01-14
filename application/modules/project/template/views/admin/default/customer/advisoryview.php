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
                        <label class="col-md-2 control-label">Địa chỉ:</label>

                        <div class="col-md-10">
                            <input type="text" name="address" value="<?php echo $info->address;?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Tuồi:</label>

                        <div class="col-md-10">
                            <input type="text" name="age" value="<?php echo $info->age;?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Giới tính:</label>

                        <div class="col-md-10">
                            <input type="text" name="sex" value="<?php if($info->sex == 0)echo "Nữ"; else echo "Nam";?>" class="form-control">
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tiêu đề:</label>

                        <div class="col-md-10">
                            <input type="text" name="title" value="<?php echo $info->title; ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Hình ảnh:</label>

                        <div class="col-md-10">
                            <div class="row lightBoxGallery">
                            <?php if(isset($images))foreach ($images as $image){ ?>
                            <div class="col-md-2">
                                <a href="<?php echo base_url('public/userfiles/'.$image->image);?>" data-gallery>
                                    <img src="<?php echo base_url('public/userfiles/'.$image->image);?>" class="img-responsive" />
                                </a>
                            </div>
                            <?php } ?>
                            </div>

                        </div>


                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Nội dung câu hỏi:</label>

                        <div class="col-md-10">
                            <textarea class="form-control textmini" name="detail" rows="15"><?php set_value('detail',$info->detail);?></textarea>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Câu trả lời:</label>

                        <div class="col-md-10">
                            <textarea class="form-control" name="answer" id="news" rows="15"><?php set_value('answer',$info->answer);?></textarea>
                            <?php echo form_error('answer', '<span class="required">', '</span>'); ?>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" value="submit" name="btnSubmit" type="submit">Gửi phản hồi</button>
                        </div>
                    </div>
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