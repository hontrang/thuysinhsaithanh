<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 10:19 AM
 * Date: 9/15/17 4:09 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 10:20 AM
 * Date: 9/15/17 3:34 PM
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
<div id="upload_box">
    <input type="file" name="files">
</div>




<div>
    * Bạn có thể nhấn vào hình ảnh để chỉnh sửa
</div>

<div style="margin-top: 15px">
    <a class="btn btn-primary" href="/admin/<?php echo $module;?>/listall"><i class="fa fa-arrow-left"></i> Finish</a>
</div>