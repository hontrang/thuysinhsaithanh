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
                    <div class="form-group"><label class="col-sm-2 control-label">Danh mục (<span class="required">*</span>):</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="cat_id">
                                <option value="">- Hãy chọn danh mục -</option>
                                <?php if(isset($cats))foreach ($cats as $cat){
                                    $select = false;
                                    if($info->cat_id==$cat->id){$select=true;};
                                    ?>
                                    <option value="<?php echo $cat->id;?>" <?php echo set_select("cat_id", $cat->id,$select);?>><?php echo $cat->name;?></option>
                                    <?php if(isset($cat->sub))foreach ($cat->sub as $sub){
                                        $select = false;
                                        if($info->cat_id==$sub->id){$select=true;};
                                        ?>
                                        <option value="<?php echo $sub->id;?>" <?php echo set_select("cat_id", $sub->id,$select);?>>---- <?php echo $sub->name;?></option>
                                    <?php } ?>


                                <?php } ?>
                            </select>
                            <?php echo form_error('cat_id', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Tên (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="name" value="<?php echo set_value('name',$info->name)?>" class="form-control">
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>



                    <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh (<span class="required">*</span>):</label>
                        <div class="col-sm-10">
                            <div class="input-group"><input id="post_image" name="image" type="text" class="form-control" value="<?php echo set_value('image',$info->image)?>"> <span class="input-group-btn"><button onclick="open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=post_image&akey=datnguyen2017&relative_url=1&fldr=construction/')" type="button" class="btn btn-w-m btn-primary">Select Image From Library</button></span></div>
                            <span>* Ghi chú: Hình ảnh nên lớn hơn 1024x576px.</span>
                            <?php echo form_error('image', '<div class="error">', '</div>'); ?>

                            <div><img style="max-width: 300px;" id="post_image_thumb" alt="" src="<?php echo base_url('public/userfiles/'.$info->image);?>" alt="" /></div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Mỗ tả SEO:</label>

                        <div class="col-md-8">
                            <input type="text" name="description" value="<?php echo set_value('description',$info->description)?>" class="form-control">
                            <?php echo form_error('description', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Chi tiết (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <textarea id="news" name="detail" rows="10" class="form-control"><?php echo set_value('detail',$info->detail)?></textarea>
                            <?php echo form_error('detail');?>
                        </div>
                    </div>

                   

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" value="submit" name="submit" type="submit">Submit</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>