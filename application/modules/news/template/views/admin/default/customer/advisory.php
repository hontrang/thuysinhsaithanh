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
            <div class="ibox-content">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Tiêu đề</th>
                        <th>Thời gian gửi</th>
                        <th>Trang thái</th>
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
                                <td><?php echo $item->phone;?></td>
                                <td><?php echo $item->email;?></td>
                                <td><?php echo $item->title;?></td>
                                <td><?php echo date("d/m/Y H:i:s", strtotime($item->create_date));?></td>
                                <td><?php if($item->answer == '')echo "Chưa trả lời";else echo "Đã trả lời";?></td>
                                <td>
                                    <div style="margin-bottom: 3px"><a href="<?php echo base_url('admin/'.$current_module.'/advisoryview/'.$item->id);?>"><button class="btn btn-warning btn-sm " type="button"><i class="fa fa-eye"></i>&nbsp;Xem</button></a>
                                    <button  onclick="remove('/admin/<?php echo $current_module;?>/advisorydel/<?php echo $item->id;?>');" class="btn btn-danger btn-danger btn-sm" type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button> </div>
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
