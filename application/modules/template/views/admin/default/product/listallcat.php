<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 10:02 AM
 * Date: 9/15/17 4:02 PM
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
            <div style="margin-bottom: 15px">
                <a href="/admin/<?php echo $module;?>/addcat" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            </div>
            <div class="ibox-content">
                <div class="help-box">
                    <div>Có thể nhấn vào biểu tượng <strong>≡</strong> và kéo lên, xuống, trái, phải để thay đổi vị trí sắp xếp và cấp bậc của menu</div>
                </div>
                <div id="productcat">
                    <div class="dd">
                        <ol class="dd-list">
                            <?php
                            if(isset($list)) foreach($list as $item){?>
                                <li class="dd-item dd3-item" data-id="<?php echo $item->id;?>">
                                    <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content"><?php echo $item->name;?> <?php if($item->show_home ==1)echo '<i class="fa fa-home"></i>';?> <?php if($item->discount > 0)echo '[Giảm giá '.$item->discount.'%]';?>
                                        <div class="action-box">
                                            <a href="<?php echo base_url('admin/'.$current_module.'/editcat/'.$item->id);?>"><button class="btn btn-warning btn-xs " type="button"><i class="fa fa-edit"></i>&nbsp;Edit</button></a>
                                            <button  onclick="remove('/admin/<?php echo $current_module;?>/delcat/<?php echo $item->id;?>');" class="btn btn-danger btn-danger btn-xs" type="button"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                        </div>
                                    </div>
                                    <?php if(isset($item->sub)){?>
                                        <ol class="dd-list">
                                            <?php foreach ($item->sub as $sub){?>
                                                <li class="dd-item dd3-item" data-id="<?php echo $sub->id;?>">
                                                    <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content"><?php echo $sub->name;?> <?php if($sub->show_home ==1)echo '<i class="fa fa-home"></i>';?> <?php if($sub->discount > 0)echo '[Giảm giá '.$sub->discount.'%]';?>
                                                        <div class="action-box">
                                                            <a href="<?php echo base_url('admin/'.$current_module.'/editcat/'.$sub->id);?>"><button class="btn btn-warning btn-xs " type="button"><i class="fa fa-edit"></i>&nbsp;Edit</button></a>
                                                            <button  onclick="remove('/admin/<?php echo $current_module;?>/delcat/<?php echo $sub->id;?>');" class="btn btn-danger btn-danger btn-xs" type="button"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                        </div>
                                                    </div>

                                                    <?php if(isset($sub->sub)){?>
                                                        <ol class="dd-list">
                                                            <?php foreach ($sub->sub as $sub2){?>
                                                                <li class="dd-item dd3-item" data-id="<?php echo $sub2->id;?>">
                                                                    <div class="dd-handle dd3-handle">Drag</div><div class="dd3-content"><?php echo $sub2->name;?> <?php if($sub2->show_home ==1)echo '<i class="fa fa-home"></i>';?> <?php if($sub2->discount > 0)echo '[Giảm giá '.$sub2->discount.'%]';?>
                                                                        <div class="action-box">
                                                                            <a href="<?php echo base_url('admin/'.$current_module.'/editcat/'.$sub2->id);?>"><button class="btn btn-warning btn-xs " type="button"><i class="fa fa-edit"></i>&nbsp;Edit</button></a>
                                                                            <button  onclick="remove('/admin/<?php echo $current_module;?>/delcat/<?php echo $sub2->id;?>');" class="btn btn-danger btn-danger btn-xs" type="button"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            <?php } ?>
                                                        </ol>
                                                    <?php } ?>

                                                </li>
                                            <?php } ?>
                                        </ol>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        </ol>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
