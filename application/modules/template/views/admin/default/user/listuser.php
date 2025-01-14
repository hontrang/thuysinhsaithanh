<?php
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
        <h2>Danh sách </h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox-content animated fadeInRight">

                <table class="table table-striped table-hover dataTables">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Họ tên</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Giới tính</th>
                        <th style="min-width: 170px">Create</th>
                        <th style="min-width: 170px">Thao tác</th>
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
                                <td><?php echo $item->email;?></td>
                                <td><?php echo $item->fullname;?></td>
                                <td><?php echo $item->address;?></td>
                                <td><?php echo $item->phone;?></td>
                                <td><?php if($item->gender == 1)echo "Nam";else echo "Nữ";?></td>
                                <td><?php echo date("d/m/Y H:i:s", strtotime($item->create_time));?></td>
                                <td><a href="/admin/user/edit/<?php echo $item->id;?>"><button class="btn btn-warning " type="button"><i class="fa fa-edit"></i>&nbsp;Sửa</button></a>
                                    <button  onclick="remove('/admin/user/del/<?php echo $item->id;?>');" class="btn btn-danger btn-danger " type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button></td>
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

