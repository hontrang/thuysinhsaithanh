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
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Banner</th>
                        <th>Tên</th>
                        <th>Lượt xem</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(isset($list))
                        foreach($list as $item)
                        {
                            ?>
                            <tr>
                                <td><?php echo $item->orders;?>
                                    <a href="?order=up&id=<?php echo $item->id;?>">
                                        <i class="fa fa-chevron-up"> </i>
                                    </a>

                                    <a href="?order=down&id=<?php echo $item->id;?>">
                                        <i class="fa fa-chevron-down"> </i>
                                    </a>
                                </td>
                                <td><img src="<?php echo base_url('public/small/'.$item->image);?>" width="150px"> </td>
                                <td><img src="<?php if($item->banner != "") echo base_url('public/small/'.$item->banner);?>" width="150px"> </td>
                                <td><?php echo $item->name;?></td>
                                <td><?php echo $item->view;?></td>
                                <td>
                                    <div style="margin-bottom: 3px"><a href="<?php echo base_url('admin/'.$current_module.'/edit/'.$item->id);?>"><button class="btn btn-warning btn-sm " type="button"><i class="fa fa-edit"></i>&nbsp;Sửa</button></a></div>
                                    <div style="margin-bottom: 3px"><button  onclick="remove('/admin/<?php echo $current_module;?>/del/<?php echo $item->id;?>');" class="btn btn-danger btn-danger btn-sm" type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button> </div>
                                </td>
                            </tr>

                            <?php
                        }
                    ?>
                    </tbody>
                </table>
                <div align="center">
                    <?php if(!empty($pagination_link)) echo $pagination_link;?>
                </div>

            </div>

        </div>
    </div>
</div>
