<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/22/17 3:47 PM
 * Date: 9/1/17 3:42 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/21/17 10:45 PM
 * Date: 8/21/17 10:53 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/21/17 3:27 PM
 * Date: 8/21/17 10:11 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/21/17 2:48 PM
 * Date: 8/21/17 3:27 PM
 *
 */

$this->load->helper('form');
    $this->load->library('form_validation');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Danh sách đăng ký đại lý</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox-content animated fadeInRight">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Họ tên</th>
                        <th>Số dư</th>
                        <th>Nhóm</th>
                        <th>Khu vực</th>
                        <th>Ngày tham gia</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if($list)
                        foreach($list as $item)
                        {
                            ?>
                            <tr>
                                <td><?php echo $item->id;?></td>
                                <td><?php echo $item->username;?></td>
                                <td><?php echo $item->name;?></td>
                                <td><?php echo number_format($item->point);?> VNĐ</td>
                                <td><?php echo $item->group_name;?></td>
                                <td><?php echo $item->province_name;?></td>
                                <td><?php echo $item->date_create;?></td>
                                <td><a href="/admin/user/edit/<?php echo $item->id;?>"><button class="btn btn-warning " type="button"><i class="fa fa-edit"></i>&nbsp;Chi tiết</button></a>
                                    <a href="/admin/user/listpartnerwaiting/<?php echo $item->id;?>"><button class="btn btn-primary " type="button"><i class="fa fa-edit"></i>&nbsp;Duyệt</button></a></td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>

