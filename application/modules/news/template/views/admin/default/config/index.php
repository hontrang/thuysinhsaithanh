<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 3:56 PM
 * Date: 10/3/17 11:28 AM
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
                    <?php foreach ($configs as $item){ ?>
                    <div class="form-group">
                        <label class="col-md-2 control-label"><?php echo $item->name;?>:</label>

                        <div class="col-md-8">
                            <?php if($item->type == "0"){ ?>
                                <input type="text" id="<?php echo $item->k;?>" name="<?php echo $item->k;?>" value="<?php echo set_value($item->k,$item->value)?>" class="form-control">

                                <?php if($item->k == "logo" or $item->k == "logo_en" or $item->k == "nen-1" or $item->k == "nen-2" or $item->k == "nen-3" or $item->k == "nen-4"or $item->k == "video-banner" or $item->k == "image-banner" or $item->k == "block-3---image"){?>
                                    <button onclick="open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=<?php echo $item->k;?>&akey=datnguyen2017&relative_url=1&fldr=/')" type="button" class="btn btn-w-m btn-primary">Tải và Chọn file ảnh từ thư viện</button>
                                <?php } ?>

                            <?php }else{ ?>
                                <textarea class="form-control" name="<?php echo $item->k;?>" rows="5"><?php echo set_value($item->k,$item->text)?></textarea>
                            <?php } ?>
                            <div class="help-block"><?php echo $item->note;?></div>
                            <?php echo form_error($item->k, '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" value="submit" name="submit" type="submit">Lưu</button>
                        </div>
                    </div>
                </form>

        </div>

        </div>
    </div>
</div>