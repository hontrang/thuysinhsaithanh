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
                <a href="/admin/<?php echo $module;?>/add" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            </div>
            <div class="ibox-content">
                <div class="row" style="margin-bottom: 15px;">

                    <form action="/admin/<?php echo $module;?>/search/" method="GET">
                    <div class="col-md-2">
                        <input name="name" class="form-control" placeholder="Tìm theo tên" />
                    </div>
                    <div class="col-md-2">
                        <input name="code" class="form-control" placeholder="Tìm theo mã số"/>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="cat_id">
                            <option value="">- Danh mục -</option>
                            <?php if(isset($cats))foreach ($cats as $cat){
                                ?>
                                <option value="<?php echo $cat->id;?>" <?php echo set_select("cat_id", $cat->id);?>><?php echo $cat->name;?></option>
                                <?php if(isset($cat->sub))foreach ($cat->sub as $sub){ ?>
                                    <option value="<?php echo $sub->id;?>" <?php echo set_select("cat_id", $sub->id);?>>--- <?php echo $sub->name;?></option>
                                <?php } ?>


                            <?php } ?>
                        </select>
                    </div>
                        <div class="col-md-2">
                            <input type="checkbox" name="new" value="1"> Sản phẩm mới
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" name="hot" value="1"> Sản phẩm HOT
                        </div>
                    <div class="col-md-2">
                        <button name="submit" class="btn btn-primary" type="submit">Search</button>
                    </div>
                    </form>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Sắp xếp</th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
                        <th>Lượt xem</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="tooltip-demo">

                    <?php
                    if(isset($list))
                        foreach($list as $item)
                        {
                            ?>
                            <tr <?php if($item->hide == '1') echo 'style="background-color:#838181; color:#fff"';?>>
                                <td><input data-toggle="tooltip" data-placement="top" title="" data-original-title="Nhấn Enter để lưu" data-module="<?php echo $module;?>" data-id="<?php echo $item->id;?>" class="input_orders" id="orders_<?php echo $item->id;?>" size="5" value="<?php echo $item->orders;?>" /></td>
                                <td><img src="<?php echo base_url('public/small/'.$item->image);?>" width="100px"> </td>
                                <td><?php echo $item->name;?></td>
                                <td><?php echo $item->view;?></td>
                                <td>
                                    <div style="margin-bottom: 3px"><a href="<?php echo base_url('admin/'.$current_module.'/edit/'.$item->id);?>"><button class="btn btn-warning btn-sm " type="button"><i class="fa fa-edit"></i>&nbsp;Sửa</button></a></div>
                                    <div style="margin-bottom: 3px"><a href="<?php echo base_url('admin/'.$current_module.'/addimage/'.$item->id);?>"><button class="btn btn-success btn-sm" type="button"><i class="fa fa-picture-o"></i>&nbsp;Thêm hình ảnh</button></a> </div>
                                    <div style="margin-bottom: 3px"><button  onclick="remove('/admin/<?php echo $current_module;?>/del/<?php echo $item->id;?>');" class="btn btn-danger btn-danger btn-sm" type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button> </div>
                                </td>
                            </tr>

                            <?php
                        }
                    ?>
                    </tbody>
                </table>
				
                <div class="row" style="background-color: #ece6e6;border-radius: 10px;padding: 0 10px;">
					<div class="col-md-6" style="margin: 25px 0;">
						<a href="/admin/<?php echo $module;?>/syncOrder"><i class="fa fa-refresh"></i> Đồng bộ</a>
					</div>
					<div class="col-md-6">
						<?php if(!empty($pagination_link)) echo $pagination_link;?>
					</div>
                </div>

            </div>

        </div>
    </div>
</div>
