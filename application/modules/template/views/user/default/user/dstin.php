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
<?php
echo $this->load->widget('breadcrumb_box');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox-content">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Khu vực</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
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
                                <td><?php echo $item->date_create;?></td>
                                <td><?php echo ($item->status == 1)?"Đã duyệt":"Chờ duyệt";?></td>
                                
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

