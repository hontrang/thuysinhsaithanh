<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 10/4/17 2:01 PM
 * Date: 10/6/17 3:22 PM
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
                <a href="/admin/config/addbank" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm tài khoản</a>
            </div>
        <div class="ibox-content">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tên ngân hàng</th>
                    <th>Chi nhánh</th>
                    <th>Chủ tải khoản</th>
                    <th>Số tài khoản</th>
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
                            <td><?php echo $item->name;?></td>
                            <td><?php echo $item->branch;?></td>
                            <td><?php echo $item->account_name;?></td>
                            <td><?php echo $item->account_number;?></td>
                            <td><a href="<?php echo base_url('admin/config/editbank/'.$item->id);?>"><button class="btn btn-warning " type="button"><i class="fa fa-edit"></i>&nbsp;Sửa</button></a>
                                <button  onclick="remove('/admin/config/delbank/<?php echo $item->id;?>');" class="btn btn-danger btn-danger " type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button></td>
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
