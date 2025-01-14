<?php

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
            <div style="margin-bottom: 10px">
                <a href="/admin/ads/add" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm ads</a>
            </div>
        <div class="ibox-content">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>

                    <th>Vị trí</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody class="tooltip-demo">

                <?php
                if(isset($list))
                    foreach($list as $item)
                    {
                        ?>
                        <tr>
                            <td><input data-toggle="tooltip" data-placement="top" title="" data-original-title="Nhấn Enter để lưu" data-module="<?php echo $module;?>" data-id="<?php echo $item->id;?>" class="input_orders" id="orders_<?php echo $item->id;?>" size="5" value="<?php echo $item->orders;?>" /></td>
                            <td><?php echo $item->name;?></td>

                            <td><?php echo $item->position;?></td>
                            <td><?php echo $item->ads_from;?></td>
                            <td><?php echo $item->ads_to;?></td>
                            <td><?php echo $item->create_time;?></td>
                            <td><a href="<?php echo base_url('admin/ads/edit/'.$item->id);?>"><button class="btn btn-warning " type="button"><i class="fa fa-edit"></i>&nbsp;Sửa</button></a>
                                <button  onclick="remove('/admin/ads/del/<?php echo $item->id;?>');" class="btn btn-danger btn-danger " type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button></td>
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
