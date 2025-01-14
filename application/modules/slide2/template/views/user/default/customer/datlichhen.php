<?php
    $this->load->helper("form");
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                echo $this->load->widget('breadcrumb_box');
                ?>
                <div class="content">
                    <div class="cr_title_green_main">
                        <div style="padding-top: 7px;">
                            <div class="cr_title_green cr_title_green_main_text"><h2><?php echo $title;?></h2></div>
                            <div class="cr_title_triangle"></div>
                        </div>
                    </div>
                    <div class="content-item row">
                        <div class="col-md-12 content-text">
                            <div class="booking_msg">
                                <?php echo $this->session->flashdata("booking_msg");?>
                            </div>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label>Họ và Tên (<span class="required">*</span>):</label>
                                    <input type="text" name="name" value="<?php echo set_value('name');?>" class="form-control">
                                    <?php echo form_error('name', '<span class="required">', '</span>'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại (<span class="required">*</span>):</label>
                                    <input type="text" name="phone" value="<?php echo set_value('phone');?>" class="form-control">
                                    <?php echo form_error('phone', '<span class="required">', '</span>'); ?>
                                </div>

                                <div class="form-group">
                                    <label>Địa chỉ (<span class="required">*</span>):</label>
                                    <input type="text" name="address" value="<?php echo set_value('address');?>" class="form-control">
                                    <?php echo form_error('address', '<span class="required">', '</span>'); ?>
                                </div>

                                <div class="form-group">
                                    <label>Giới tính (<span class="required">*</span>):</label>
                                    <div><input type="checkbox" name="sex" value="1"> Nam <input type="checkbox" name="sex" value="0"> Nữ</div>
                                    <?php echo form_error('sex', '<span class="required">', '</span>'); ?>

                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Năm sinh (<span class="required">*</span>):</label>
                                        <input type="text" name="age" value="<?php echo set_value('age');?>" class="form-control">
                                        <?php echo form_error('age', '<span class="required">', '</span>'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Thời gian muốn khám bệnh (<span class="required">*</span>):</label>
                                        <input type="text" name="date_booking" value="<?php echo set_value('date_booking');?>" class="form-control datetime">
                                        <?php echo form_error('date_booking', '<span class="required">', '</span>'); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Chuyên Khoa:</label>
                                        <select class="form-control" name="department_id" id="department_post">
                                            <option value="">- Chọn Phòng ban - Khoa -</option>
                                            <?php if(isset($cats))foreach ($cats as $cat){
                                                ?>
                                                <option value="<?php echo $cat->id;?>" <?php echo set_select("department_id", $cat->id);?>><?php echo $cat->name;?></option>

                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('department_id', '<span class="error">', '</span>'); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>Bác sỹ :</label>
                                        <select class="form-control" name="doctor_id" id="doctor_post">
                                            <option value="">- Chọn bác sỹ -</option>
                                            <?php if(isset($doctors))foreach ($doctors as $doctor){                                                ?>
                                                <option value="<?php echo $doctor->id;?>" <?php echo set_select("doctor_id", $doctor->id);?>><?php echo $doctor->name;?></option>

                                            <?php } ?>
                                        </select>
                                        <?php echo form_error('doctor_id', '<span class="required">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú :</label>
                                    <textarea class="form-control" name="note" rows="5"><?php echo set_value('note');?></textarea>
                                </div>

                                <div class="checkbox">
                                    <label>(<span class="required">*</span>) Thông tin bắt buộc</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="btnSubmit" value="submit" class="btn btn-primary">Gừi thông tin</button>
                                </div>

                            </form>

                        </div>
                    </div>





                </div>
            </div>
            <div class="col-lg-4 sidebar">
                <div class="cr_title_green_main">
                    <div style="padding-top: 7px;">
                        <div class="cr_title_green cr_title_green_main_text"><h2><?php echo $this->lang->line('customer');?></h2></div>
                        <div class="cr_title_triangle"></div>
                    </div>
                </div>
                <div class="list-item row">
                        <div class="col-sm-12">
                            <a href="<?php echo site_url('khach-hang/dat-lich-hen');?>" title="<?php echo $this->lang->line('booking');?>"> <span><?php echo $this->lang->line('booking');?></span> </a>
                        </div>
                    <?php if(isset($menu_cats))foreach ($menu_cats as $item){ ?>
                        <div class="col-sm-12">
                            <a href="<?php echo site_url('khach-hang/'.$item->slug);?>" title="<?php echo $item->name;?>"> <span><?php echo $item->name;?></span> </a>
                        </div>
                    <?php } ?>
                </div>

                <?php
                echo $this->load->widget('tool_box');
                ?>

                <?php
                echo $this->load->widget('video_box');
                ?>

                <?php
                echo $this->load->widget('album_box');
                ?>


            </div>
        </div>
    </div>

    <div class="space-30"></div>


</section>