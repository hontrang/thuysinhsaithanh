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
<?php
echo $this->load->widget('lang_box');
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <form method="POST" action="" class="form-horizontal">
                    <input type="hidden" value="" name="act">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tên (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="name" value="<?php echo set_value('name',$info->name)?>" class="form-control">
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Sub name (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="sub_name" value="<?php echo set_value('sub_name',$info->sub_name)?>" class="form-control">
                            <?php echo form_error('sub_name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Danh mục (<span class="required">*</span>):</label>
                        <div class="col-sm-4">
                           <select class="form-control" name="cat_id">
                                <option value="">- Chọn danh mục -</option>
                                <?php if(isset($cats))foreach ($cats as $cat){
                                    $select = false;
                                    if($info->cat_id==$cat->id){$select=true;};
                                    ?>
                                    <option value="<?php echo $cat->id;?>" <?php echo set_select("cat_id", $cat->id,$select);?>>---- <?php echo $cat->name;?></option>

                                <?php } ?>
                            </select>
                            <?php echo form_error('cat_id', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>



                    <div class="form-group"><label class="col-sm-2 control-label">Ảnh đại diện (<span class="required">*</span>):</label>
                        <div class="col-sm-10">
                            <div class="input-group"><input id="post_image" name="image" type="text" class="form-control" value="<?php echo set_value('image',$info->image)?>"> <span class="input-group-btn"><button onclick="open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=post_image&akey=datnguyen2017&relative_url=1&fldr=<?php echo $module;?>/')" type="button" class="btn btn-w-m btn-primary">Tải và Chọn file ảnh từ thư viện</button></span></div>
                            <span>Lưu ý: Hình ảnh nên có kích thước 500x500px.</span>
                            <?php echo form_error('image', '<div class="error">', '</div>'); ?>

                            <div><img style="max-width: 300px;" id="post_image_thumb" alt="" src="<?php echo base_url('public/userfiles/'.$info->image);?>" alt="" /></div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" >Mô tả (<span class="required">*</span>):</label>
                        <div class="col-md-10">
                            <textarea  name="des" rows="5" class="form-control"><?php echo set_value('des',$info->des)?></textarea>
                            <?php echo form_error('des');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" >Tổng quan (<span class="required">*</span>):</label>
                        <div class="col-md-10">
                            <textarea name="detail" rows="10" class="form-control fulleditor"><?php echo set_value('detail',$info->detail)?></textarea>
                            <?php echo form_error('detail');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" >Vị trí (<span class="required">*</span>):</label>
                        <div class="col-md-10">
                            <textarea name="vitri" rows="10" class="form-control fulleditor"><?php echo set_value('vitri',$info->vitri)?></textarea>
                            <?php echo form_error('vitri');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" >Mặt bằng (<span class="required">*</span>):</label>
                        <div class="col-md-10">
                            <textarea name="matbang" rows="10" class="form-control fulleditor"><?php echo set_value('matbang',$info->matbang)?></textarea>
                            <?php echo form_error('matbang');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" >Tiện ích (<span class="required">*</span>):</label>
                        <div class="col-md-10">
                            <textarea name="tienich" rows="10" class="form-control fulleditor"><?php echo set_value('tienich',$info->tienich)?></textarea>
                            <?php echo form_error('tienich');?>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="control-label col-md-2" >Phương thức thanh toán (<span class="required">*</span>):</label>
                        <div class="col-md-10">
                            <textarea name="phuongthucthanhtoan" rows="10" class="form-control fulleditor"><?php echo set_value('phuongthucthanhtoan',$info->phuongthucthanhtoan)?></textarea>
                            <?php echo form_error('phuongthucthanhtoan');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Tin nổi bật:</label>
                        <div class="col-md-8">
                            <label class="checkbox-inline i-checks"> <input type="checkbox" name="is_hot" value="1" <?php if($info->is_hot=="1")echo 'checked="checked"';?>> </label>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" value="submit" name="submit" type="submit">Sửa</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>