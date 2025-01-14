<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/22/17 9:41 AM
 * Date: 8/22/17 9:55 AM
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
        <h2>Danh sách tin</h2>
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
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Khu vực</th>
                        <th>Người đăng</th>
                        <th>Ngày tạo</th>
                        <th>Tin thường</th>
                        <th>Tin VIP</th>
                        <th>Tin Siêu VIP</th>
                        <th style="min-width: 250px">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(isset($listBDS)){
                        foreach($listBDS as $item)
                        {
                            ?>
                            <tr>
                                <td><?php echo $item->id;?></td>
                                <td><img src="<?php echo base_url('public/small/'.$item->default_image);?>" height="80px" /></td>
                                <td><?php echo $item->title;?></td>
                                <td><?php echo $item->province_name;?> - <?php echo $item->district_name;?></td>
                                <td><?php echo $item->user_name;?></td>
                                <td><?php echo $item->date_create;?></td>
                                <td><input onclick="set_status('1','<?php echo $item->id;?>','bds');" type="radio" name="vip_type_<?php echo $item->id;?>" <?php if($item->vip_type=="1")echo 'checked="checked"';?></td>
                                <td><input onclick="set_status('2','<?php echo $item->id;?>','bds');" type="radio" name="vip_type_<?php echo $item->id;?>" <?php if($item->vip_type=="2")echo 'checked="checked"';?></td>
                                <td><input onclick="set_status('3','<?php echo $item->id;?>','bds');" type="radio" name="vip_type_<?php echo $item->id;?>" <?php if($item->vip_type=="3")echo 'checked="checked"';?></td>
								
                                <td><a href="/admin/bds/chitiettin/<?php echo $item->id;?>"><button class="btn btn-warning btn-sm" type="button"><i class="fa fa-edit"></i>&nbsp;Chi tiết</button></a>
                                    <a href="/admin/bds/huyduyet/<?php echo $item->id;?>"><button class="btn btn-warning btn-sm"" type="button"><i class="fa fa-edit"></i>&nbsp;Hủy duyệt</button></a>
                                    <button  onclick="remove('/admin/bds/xoatin/<?php echo $item->id;?>');" class="btn btn-danger btn-danger btn-sm"" type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button></td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {

                        ?>
                        <tr><td colspan="8" align="center"><h3>Không cón tin nào!</h3></td></tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div align="center">
                    <?php if(!empty($pagination_link)) echo $pagination_link;?>
                </div>
            </div>



        </div>
    </div>
</div>

