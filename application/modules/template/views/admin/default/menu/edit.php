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
                        <label class="col-md-2 control-label">Menu cha (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <select name="parent_id" class="form-control" >
                                <option value="0">Root</option>
                                <?php if(isset($menus))foreach ($menus as $menu){
                                    $select = '';
                                    if($info->parent_id == $menu->id)
                                        $select = 'selected';
                                    ?>
                                    <option value="<?php echo $menu->id;?>" <?php echo $select;?> ><?php echo $menu->name;?></option>
										<?php if(isset($menu->sub))foreach($menu->sub as $sub){
											$select = '';
											if($info->parent_id == $sub->id)
												$select = 'selected';
											?>
											<option value="<?php echo $sub->id;?>" <?php echo $select;?>>  |-- <?php echo $sub->name;?></option>

										<?php } ?>

                                <?php } ?>
                            </select>
                            <?php echo form_error('parent_id', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="col-md-2 control-label">Tên menu (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="name" value="<?php echo set_value('name',$info->name)?>" class="form-control">
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>



                    <div class="form-group" id="linkngoai">
                        <label class="col-md-2 control-label">Link (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="url" value="<?php echo set_value('url',$info->url)?>" class="form-control">
                            <?php echo form_error('url', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Loại (<span class="required">*</span>):</label>
                        <div class="col-md-8">
                            <label class="checkbox-inline "> <input <?php if($info->target == "_self")echo "checked";?> type="radio" name="target" value="_self" checked> Cùng cửa sổ</label>
                            <label class="checkbox-inline "> <input <?php if($info->target == "_blank")echo "checked";?> type="radio" name="target" value="_blank"> Cửa sổ mới</label>
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
