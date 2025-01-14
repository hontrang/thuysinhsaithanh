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
                    <div class="form-group"><label class="col-sm-2 control-label">Danh mục (<span class="required">*</span>):</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="parent_id">
                                <option value="0">Root</option>
                                <?php if(isset($listparent))foreach ($listparent as $parent){
                                    $select = false;
                                    if($info->parent_id==$parent->id){$select=true;}
                                    ?>
                                    <option value="<?php echo $parent->id;?>" <?php echo set_select("parent_id", $parent->id, $select);?>><?php echo $parent->name;?></option>
									
									<?php $subs = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>$parent->id]);
										if($subs)foreach ($subs as $sub){
											$select2 = false;
											if($info->parent_id==$sub->id){$select2=true;}
									?>
										<option value="<?php echo $sub->id;?>" <?php echo set_select("parent_id", $sub->id, $select2);?>>---- <?php echo $sub->name;?></option>
									<?php } ?>
									
                                <?php } ?>
                            </select>

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
                            <div class="input-group"><input id="post_image" name="image" type="text" class="form-control" value="<?php echo set_value('image',$info->image)?>"> <span class="input-group-btn"><button onclick="open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=post_image&akey=datnguyen2017&relative_url=1&fldr=category/')" type="button" class="btn btn-w-m btn-primary">Select Image From Library</button></span></div>
                            <?php echo form_error('image', '<div class="error">', '</div>'); ?>

                            <div><img style="max-width: 300px;" id="post_image_thumb" alt="" src="<?php echo base_url('public/userfiles/'.$info->image);?>" alt="" /></div>

                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-2 control-label">Màu sắc (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="color" value="<?php echo set_value('color',$info->color)?>" class="form-control colorpicker">
                            <?php echo form_error('color', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="control-label col-md-2" >Mô tả:</label>
                        <div class="col-md-10">
                            <textarea  name="description" rows="10" class="form-control editor_full"><?php echo set_value('description',$info->description)?></textarea>
                            <?php echo form_error('description');?>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="control-label col-md-2" >Chi tiết:</label>
                        <div class="col-md-10">
                            <textarea  name="detail" rows="10" class="form-control editor_full"><?php echo set_value('detail',$info->detail)?></textarea>
                            <?php echo form_error('detail');?>
                        </div>
                    </div>
					
					<!--<div class="form-group">
                        <label class="col-md-2 control-label">Giảm giá:</label>

                        <div class="col-md-8">
                            <input type="number" name="discount" value="<?php echo set_value('discount',$info->discount)?>" class="form-control">
                            <?php echo form_error('discount', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					-->

                    <div class="form-group">
                        <label class="col-md-2 control-label">Hiện ở trang chủ:</label>
                        <div class="col-md-8">
                            <label class="checkbox-inline i-checks"> <input type="checkbox" name="show_home" value="1" <?php if($info->show_home=="1")echo 'checked="checked"';?> /> </label>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
					<!--
                    <div class="form-group repeater">
                        <label class="col-md-2 control-label">Thuộc tính:</label>
                        <div class="col-md-8">
                            <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add btn-xs">
                                <i class="fa fa-plus"></i> Thêm
                            </a>

                            <hr>
                            <?php if(isset($product_cat_properties)){foreach ($product_cat_properties as $item){?>
                            <div data-repeater-list="product_cat_properties">
                                <div data-repeater-item class="row mb-md">
                                    <div class="col-md-5">
                                        <label class="control-label">Tên thuộc tính</label>
                                        <input type="text" name="name" value="<?php echo $item->properties_name;?>" placeholder="" class="form-control" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="control-label">&nbsp;</label><br />
                                        <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
							<?php }else{ ?>

                            <div data-repeater-list="product_cat_properties">
                                <div data-repeater-item class="row mb-md">
                                    <div class="col-md-5">
                                        <label class="control-label">Tên thuộc tính</label>
                                        <input type="text" name="name" placeholder="" class="form-control" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="control-label">&nbsp;</label><br />
                                        <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    
                    
                    </div>-->

                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class="col-sm-2 control-label">Hình quảng cáo:</label>
                        <div class="col-sm-10">
                            <div class="input-group"><input id="post_ads_image" name="ads_image" type="text" class="form-control" value="<?php echo set_value('ads_image',$info->ads_image)?>"> <span class="input-group-btn"><button onclick="open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=post_ads_image&akey=datnguyen2017&relative_url=1&fldr=category/')" type="button" class="btn btn-w-m btn-primary">Select Image From Library</button></span></div>
                            <?php echo form_error('ads_image', '<div class="error">', '</div>'); ?>

                            <div><img style="max-width: 300px;" id="post_ads_image_thumb" alt="" src="<?php echo base_url('public/userfiles/'.$info->ads_image);?>" alt="" /></div>


                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Link :</label>

                        <div class="col-md-8">
                            <input type="text" name="ads_url" value="<?php echo set_value('ads_url',$info->ads_url)?>" class="form-control">
                            <?php echo form_error('ads_url', '<div class="error">', '</div>'); ?>
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