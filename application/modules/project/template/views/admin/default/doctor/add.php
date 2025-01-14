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
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <form method="POST" action="" class="form-horizontal">
                    <input type="hidden" value="" name="act">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tên (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="name" value="<?php echo set_value('name')?>" class="form-control">
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Chức danh (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <input type="text" name="position" value="<?php echo set_value('position')?>" class="form-control">
                            <?php echo form_error('position', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Phòng ban - Khoa (<span class="required">*</span>):</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="department_id">
                                <option value="">- Chọn phòng ban - Khoa -</option>
                                <?php if(isset($cats))foreach ($cats as $cat){
                                    ?>
                                    <option value="<?php echo $cat->id;?>" <?php echo set_select("department_id", $cat->id);?>>--- <?php echo $cat->name;?></option>

                                <?php } ?>
                            </select>
                            <?php echo form_error('department_id', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Ảnh đại diện (<span class="required">*</span>):</label>
                        <div class="col-sm-10">
                            <div class="input-group"><input id="post_image" name="image" type="text" class="form-control" value="<?php echo set_value('image')?>"> <span class="input-group-btn"><button onclick="open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=post_image&akey=datnguyen2017&relative_url=1&fldr=<?php echo $module;?>/')" type="button" class="btn btn-w-m btn-primary">Tải và Chọn file ảnh từ thư viện</button></span></div>
                            <span>Lưu ý: Hình ảnh nên có kích thước 800x400px.</span>
                            <?php echo form_error('image', '<div class="error">', '</div>'); ?>

                            <div><img style="max-width: 300px;" id="post_image_thumb" alt="" src="" alt="" /></div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2" >Giới thiệu (<span class="required">*</span>):</label>
                        <div class="col-md-10">
                            <textarea id="news" name="detail" rows="10" class="form-control"><?php echo set_value('detail')?></textarea>
                            <?php echo form_error('detail');?>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group"><label class="col-sm-2 control-label">Phòng làm việc (<span class="required">*</span>):</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="room_id">
                                <option value="">- Chọn phòng -</option>
                                <?php if(isset($rooms))foreach ($rooms as $room){
                                    ?>
                                    <option value="<?php echo $room->id;?>" <?php echo set_select("room_id", $room->id);?>>--- <?php echo $room->name;?></option>

                                <?php } ?>
                            </select>
                            <?php echo form_error('room_id', '<div class="error">', '</div>'); ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Thời gian làm việc (<span class="required">*</span>):</label>

                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Thứ 2</th>
                                    <th>Thứ 3</th>
                                    <th>Thứ 4</th>
                                    <th>Thứ 5</th>
                                    <th>Thứ 6</th>
                                    <th>Thứ 7</th>
                                    <th>CN</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <?php for($i=2; $i<9;$i++){?>
                                    <td>
                                        <div><label class="checkbox-inline i-checks"> <input type="checkbox" name="time[am][]" value="<?php echo $i;?>"> Sáng</label></div>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <?php for($i=2; $i<9;$i++){?>
                                        <td>
                                            <div><label class="checkbox-inline i-checks"> <input type="checkbox" name="time[pm][]" value="<?php echo $i;?>"> Chiều</label></div>
                                        </td>
                                    <?php } ?>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary" value="submit" name="submit" type="submit">Thêm</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>