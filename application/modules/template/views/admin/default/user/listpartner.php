<?php


$this->load->helper('form');
$this->load->library('form_validation');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Danh sách đại lý</h2>
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
                                    </td>
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

