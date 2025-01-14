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

                    <form action="/admin/product/search/" method="GET">
                    <div class="col-md-2">
                        <input name="name" class="form-control" placeholder="Tìm theo tên" />
                    </div>
					<!--
                    <div class="col-md-2">
                        <input name="code" class="form-control" placeholder="Tìm theo mã số"/>
                    </div>
					-->
                    <div class="col-md-4">
                        <select class="form-control" name="cat_id">
                            <option value="">- Danh mục -</option>
                            <?php if(isset($cats))foreach ($cats as $cat){
                                ?>
                                <option value="<?php echo $cat->id;?>" <?php echo set_select("cat_id", $cat->id);?>><?php echo $cat->name;?></option>
                                <?php if(isset($cat->sub))foreach ($cat->sub as $sub){ ?>
                                    <option value="<?php echo $sub->id;?>" <?php echo set_select("cat_id", $sub->id);?>>--- <?php echo $sub->name;?></option>
									<?php 
										$list_sub = $this->MCommon->getAllRowByWhere_lang('vi','product_cat',['parent_id'=>$sub->id],null,"orders ASC");
										if($list_sub)foreach($list_sub as $sub2){
									?>
										<option value="<?php echo $sub2->id;?>" <?php echo set_select("cat_id", $sub2->id);?>>------ <?php echo $sub2->name;?></option>
									<?php } ?>
                                <?php } ?>


                            <?php } ?>
                        </select>
                    </div>
					
					<div class="col-md-2">
                        <select class="form-control" name="brand_id">
                            <option value="">- Thương hiệu -</option>
                            <?php if(isset($brands))foreach ($brands as $brand){
                                ?>
                                <option value="<?php echo $brand->id;?>" <?php echo set_select("brand_id", $brand->id);?>><?php echo $brand->name;?></option>
                                

                            <?php } ?>
                        </select>
                    </div>
                        <div class="col-md-1">
                            <input type="checkbox" name="new" value="1"> NEW
                        </div>
                        <div class="col-md-1">
                            <input type="checkbox" name="hot" value="1"> HOT
                        </div>
                    <div class="col-md-2">
                        <button name="submit" class="btn btn-primary" type="submit">Search</button>
                    </div>
                    </form>
                </div>
				<style>
					.td_price{
						text-align: right;
					}
				</style>
				<form id="productForm" action="/admin/product/dels" method="post">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Sắp xếp</th>
                        <th></th>
                        <th>Hình ảnh</th>
                        <th>Tên</th>
						<th>Mã SP</th>
                        <th>Giá</th>
                        <th>Giá cũ</th>
                        
                        <th>Danh mục</th>
                        <th>Hot</th>
                        <th>New</th>

                        <th>Ẩn</th>
                        <th>Lượt xem</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="tooltip-demo">

                    <?php
                    if(isset($list))
                        foreach($list as $item)
                        {
                            $danhmuc = "";
                            $getdm = $this->MCommon->getRow_lang('vi','product_cat',['id'=>$item->cat_id]);
                            if($getdm)
                                $danhmuc = $getdm->name;
							
							$thuonghieu = "";
                            $getth = $this->MCommon->getRow('product_brand',['id'=>$item->brand_id]);
                            if($getth)
                                $thuonghieu = $getth->name;
                            ?>
                            <tr <?php if($item->hide == '1') echo 'style="background-color:#838181; color:#fff"';?>>
                                <td><input data-toggle="tooltip" data-placement="top" title="" data-original-title="Nhấn Enter để lưu" data-module="<?php echo $module;?>" data-id="<?php echo $item->id;?>" class="input_orders" id="orders_<?php echo $item->id;?>" size="5" value="<?php echo $item->orders;?>" /></td>
                                <td><input type="checkbox" name="ids[]" value="<?php echo $item->id;?>" style="display: inline-block" /></td>
								<td> <img src="<?php echo base_url('public/userfiles/'.$item->image);?>" width="100px"> </td>
                                <td><?php echo $item->name;?></td>
								 <td><?php echo $item->code;?></td>
                                <td id="td_price_<?php echo $item->id;?>" class="td_price" data-type="price" data-price="<?php echo $item->price;?>" data-key="id_<?php echo $item->id;?>" data-id="<?php echo $item->id;?>"><?php echo number_format($item->price);?></td>
                                <td id="td_price_old_<?php echo $item->id;?>" class="td_price" data-type="price_old" data-price="<?php echo $item->price_old;?>" data-key="id_<?php echo $item->id;?>" data-id="<?php echo $item->id;?>"><?php echo number_format($item->price_old);?></td>
                                <!--<td><?php echo $thuonghieu;?></td>-->
                                <td><?php echo $danhmuc;?></td>
                                <td><input onclick="set_status('hot','<?php echo $item->id;?>');" type="checkbox" <?php if($item->is_hot=="1")echo 'checked="checked"';?></td>
                                <td><input onclick="set_status('new','<?php echo $item->id;?>');" type="checkbox" <?php if($item->is_new=="1")echo 'checked="checked"';?></td>

                                <td><input onclick="set_status('hide','<?php echo $item->id;?>');" type="checkbox" <?php if($item->hide=="1")echo 'checked="checked"';?></td>
                                <td><?php echo $item->view;?></td>
                                <td>
                                    <div style="margin-bottom: 3px"><a href="<?php echo base_url('admin/'.$current_module.'/edit/'.$item->id);?>"><button class="btn btn-warning btn-sm " type="button"><i class="fa fa-edit"></i>&nbsp;Sửa</button></a> <a href="<?php echo base_url('admin/'.$current_module.'/copy/'.$item->id);?>"><button class="btn btn-info btn-sm " type="button"><i class="fa fa-copy"></i>&nbsp;Copy</button></a> </div>
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
						<a href="/admin/<?php echo $module;?>/syncOrder" style="font-weight: 700; margin-right: 15px"><i class="fa fa-refresh"></i> Đồng bộ lại thứ tự</a> | 
						<a href="javascript:deleteSelected('productForm');" style="color: red; margin-left: 15px"><i class="fa fa-trash"></i> Xoá</a>
					</div>
					<div class="col-md-6">
						<?php if(!empty($pagination_link)) echo $pagination_link;?>
					</div>
                </div>
				
				</form>

            </div>

        </div>
    </div>
</div>
