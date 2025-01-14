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
                <a href="/admin/<?php echo $module;?>/brandadd" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            </div>
            <div class="ibox-content">
				
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Hình ảnh</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="tooltip-demo">

                    <?php
                    if(isset($list))
                        foreach($list as $item)
                        {
                            ?>
                            <tr>
                               <td><input data-toggle="tooltip" data-placement="top" title="" data-original-title="Nhấn Enter để lưu"  data-method="updateOrderBrand" data-module="<?php echo $module;?>" data-id="<?php echo $item->id;?>" class="input_orders" id="orders_<?php echo $item->id;?>" size="5" value="<?php echo $item->orders;?>" /></td>
                                <td><?php echo $item->name;?></td>
                                <td><img src="<?php echo base_url('public/userfiles/'.$item->image);?>" width="50px"> </td>
                                <td>
                                    <a href="<?php echo base_url('admin/'.$current_module.'/brandedit/'.$item->id);?>"><button class="btn btn-warning btn-sm " type="button"><i class="fa fa-edit"></i>&nbsp;Sửa</button></a> 
                                    <button  onclick="remove('/admin/<?php echo $current_module;?>/branddel/<?php echo $item->id;?>');" class="btn btn-danger btn-danger btn-sm" type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                                </td>
                            </tr>

                            <?php
                        }
                    ?>
                    </tbody>
                </table>

                <div class="row" style="background-color: #ece6e6;border-radius: 10px;padding: 0 10px;">
					<div class="col-md-6" style="margin: 25px 0;">
						<a href="/admin/<?php echo $module;?>/syncOrderBrand" style="font-weight: 700; margin-right: 15px"><i class="fa fa-refresh"></i> Đồng bộ lại thứ tự</a> 
						
					</div>
					<div class="col-md-6">
						<?php if(!empty($pagination_link)) echo $pagination_link;?>
					</div>
                </div>

            </div>

        </div>
    </div>
</div>
