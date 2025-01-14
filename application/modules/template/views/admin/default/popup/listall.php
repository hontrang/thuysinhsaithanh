<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/6/17 11:25 AM
 * Date: 10/6/17 11:32 AM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/6/17 11:04 AM
 * Date: 10/6/17 11:04 AM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 4:03 PM
 * Date: 10/4/17 1:58 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 10:02 AM
 * Date: 9/15/17 4:02 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/22/17 5:04 PM
 * Date: 8/29/17 10:44 AM
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
            <div style="margin-bottom: 10px">
                <a href="/admin/popup/add" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm Popup</a>
            </div>
        <div class="ibox-content">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Hình ảnh</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
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
                            <td><?php echo $item->id;?></td>
                            <td><?php echo $item->title;?></td>
                            <td><img src="<?php echo base_url('public/userfiles/'.$item->image);?>" width="400px"></td>
                            <td><?php if($item->status == 1)echo "Đang hiển thị";else echo "Đang Tắt";?></td>
                            <td><?php echo $item->create_date;?></td>
                            <td>
                                <a href="<?php echo base_url('admin/popup/active/'.$item->id);?>"><button class="btn btn-success " type="button"><i class="fa fa-send"></i> Kích hoạt/Hủy kích hoạt</button></a>
                                <a href="<?php echo base_url('admin/popup/edit/'.$item->id);?>"><button class="btn btn-warning " type="button"><i class="fa fa-edit"></i>&nbsp;Sửa</button></a>
                                <button  onclick="remove('/admin/popup/del/<?php echo $item->id;?>');" class="btn btn-danger btn-danger " type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button></td>
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
