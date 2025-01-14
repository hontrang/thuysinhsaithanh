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
                    <div class="form-group">
                        <label class="col-md-2 control-label">Danh mục (<span class="required">*</span>):</label>
                        <div class="col-md-8">
                            <select class="form-control" name="cat_id" id="product_cat_id">
                                <option value="">- Hãy chọn danh mục -</option>
                                <?php if(isset($cats))foreach ($cats as $cat){
                                    ?>
                                    <option value="<?php echo $cat->id;?>" ><?php echo $cat->name;?></option>
                                    <?php if(isset($cat->sub))foreach ($cat->sub as $sub){ ?>
                                        <option value="<?php echo $sub->id;?>" >--- <?php echo $sub->name;?></option>
										<?php 
										$sub2s = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>$sub->id]);
										if($sub2s)foreach ($sub2s as $sub2){ ?>
											<option value="<?php echo $sub2->id;?>" >--------- <?php echo $sub2->name;?></option>
										<?php } ?>
                                    <?php } ?>


                                <?php } ?>
                            </select>
                            <?php echo form_error('cat_id', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Tên (<span class="required">*</span>):</label>

                        <div class="col-md-10">
                            <input type="text" name="name" value="<?php echo set_value('name')?>" class="form-control">
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-md-2 control-label">Mã sản phẩm (<span class="required">*</span>):</label>

                        <div class="col-md-10">
                            <input type="text" name="code" value="<?php echo set_value('code')?>" class="form-control">
                            <?php echo form_error('code', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                     <div class="form-group" style="display: none;">
                        <label class="col-md-2 control-label">Thương hiệu (<span class="required">*</span>):</label>

                        <div class="col-md-10">
                            <select class="form-control" name="brand_id">
                                
                                <?php if(isset($list_brand))foreach ($list_brand as $item){
                                    ?>
                                    <option value="<?php echo $item->id;?>" <?php echo set_select("brand_id", $item->id);?>><?php echo $item->name;?></option>
                                    <?php } ?>
                            </select>
                            <?php echo form_error('brand_id', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Giá:</label>

                        <div class="col-md-8">
                            <input type="text" name="price" value="<?php echo set_value('price')?>" class="form-control">
                            <?php echo form_error('price', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Giá cũ:</label>

                        <div class="col-md-8">
                            <input type="text" name="price_old" value="<?php echo set_value('price_old')?>" class="form-control">
                            <?php echo form_error('price_old', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					 <div class="form-group">
                        <label class="col-md-2 control-label">Đơn vị tính:</label>

                        <div class="col-md-8">
                            <input type="text" name="dvt" value="<?php echo set_value('dvt')?>" class="form-control">
                            <?php echo form_error('dvt', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
					<!--
                    <div class="form-group">
                        <label class="col-md-2 control-label">Trả góp:</label>

                        <div class="col-md-8">
                            <input type="number" name="tragop" value="<?php echo set_value('tragop')?>" class="form-control">
                            <?php echo form_error('tragop', '<div class="error">', '</div>'); ?>
                            <div>Để trống nếu không hỗ trợ trả góp</div>
                        </div>
                    </div>
					-->
                    <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh (<span class="required">*</span>):</label>
                        <div class="col-sm-10">
                            <div class="input-group"><input id="post_image" name="image" type="text" class="form-control" value="<?php echo set_value('image')?>"> <span class="input-group-btn"><button onclick="open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=post_image&akey=datnguyen2017&relative_url=1&fldr=product/')" type="button" class="btn btn-w-m btn-primary">Select Image From Library</button></span></div>
                            
                            <?php echo form_error('image', '<div class="error">', '</div>'); ?>

                            <div><img style="max-width: 300px;" id="post_image_thumb" alt="" src="" alt="" /></div>

                        </div>
                    </div>
					<!--
                    <div class="form-group repeater">
                        <label class="col-md-2 control-label">Thuộc tính:</label>
                        <div class="col-md-8" id="product_properties_repo">
                            (Vui lòng chọn danh mục)
                        </div>
                    </div>
					-->

                    <div class="form-group repeater" style="display:none">
                        <label class="col-md-2 control-label">Khuyến mãi:</label>
                        <div class="col-md-8">
                            <input id="product_version_image_temp" type="hidden" />
                            <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add btn-xs">
                                <i class="fa fa-plus"></i> Thêm
                            </a>

                            <hr>
                            
                            <div data-repeater-list="product_promotion">
                                <div data-repeater-item class="row mb-md">
                                    <div class="col-md-1">
                                        <label class="control-label">Image</label>
                                        <input type="hidden" name="product_promotion_image" value="image-default.png" placeholder="" class="form-control" />
                                        <div>
                                            <img class="open_select_image img-select" height="34px" width="34px" src="/public/userfiles/image-default.png" />
                                        </div>

                                    </div>
                                   
                                    <div class="col-md-4">
                                        <label class="control-label">Tên khuyến mãi (<span class="required">*</span>)</label>
                                        <input type="text" name="product_promotion_name" placeholder="" class="form-control" />
                                    </div>

                                    <div class="col-md-4">
                                        <label class="control-label">URL</label>
                                        <input type="text" name="product_promotion_url" placeholder="(Bỏ trống nếu không sử dụng)" class="form-control" />
                                    </div>

                                    <div class="col-md-1">
                                        <label class="control-label">&nbsp;</label><br />
                                        <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Mô tả:</label>

                        <div class="col-md-10">
						<button type="button" onclick="XoaLienKet('description')">Xoá liên kết</button>
                            <textarea name="description" rows="10" class="form-control editor_full"><?php echo set_value('description')?></textarea>
                            <?php echo form_error('description', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group" style="display:none">
						
                        <label class="col-md-2 control-label">Thông số kỹ thuật:</label>

                        <div class="col-md-10">
							<button type="button" onclick="XoaLienKet('parameter')">Xoá liên kết</button>
                            <textarea name="parameter" rows="10" class="form-control editor_full"><?php echo set_value('parameter')?></textarea>
                            <?php echo form_error('parameter', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label">Chi tiết (<span class="required">*</span>):</label>

                        <div class="col-md-10">
							<button type="button" onclick="XoaLienKet('detail')">Xoá liên kết</button>
                            <textarea name="detail" id="detail" rows="10" class="form-control editor_full"><?php echo set_value('detail')?></textarea>
                            <?php echo form_error('detail');?>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label class="col-md-2 control-label">Sản phẩm HOT:</label>
                        <div class="col-md-8">
                            <label class="checkbox-inline i-checks"> <input type="checkbox" name="is_hot" value="1"> </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Sản phẩm mới:</label>
                        <div class="col-md-8">
                            <label class="checkbox-inline i-checks"> <input type="checkbox" name="is_new" value="1"> </label>
                        </div>
                    </div>

                    <?php
                    echo $this->load->widget('seo_box');
                    ?>



                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" value="submit" name="submit" type="submit">Thêm mới</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
