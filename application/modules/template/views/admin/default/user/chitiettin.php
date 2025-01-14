<?php

$this->load->helper('form');
    $this->load->library('form_validation');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Chi tiết tin</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <form class="form-horizontal" role="form" action="" method="POST">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content animated fadeInRight">
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Tiêu đề (<span class="required">*</span>):</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control input-sm" id="post_title" name="title" placeholder="" value="<?php echo set_value('title',$bds->title)?>">
                            <?php echo form_error('title');?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" >Nhu cầu (<span class="required">*</span>):</label>
                        <div class="col-sm-4">
                            <select name="type" id="post_type" class="form-control input-sm">
                                <option value="0">-- Chọn như cầu --</option>
                                <?php
                                    $select1 = $select2 = false;
                                    if($bds->type == 1)
                                        $select1 = true;
                                    if($bds->type == 2)
                                        $select2 = true;
                                ?>
                                <option value="1" <?php echo  set_select('type', 1,$select1); ?>>Cần bán</option>
                                <option value="2" <?php echo  set_select('type', 2,$select2); ?>>Cần cho thuê</option>
                            </select>
                            <?php echo form_error('type');?>
                        </div>
                        <label class="control-label col-sm-2" >Loại (<span class="required">*</span>):</label>
                        <div class="col-sm-4">
                            <select name="cat" id="post_cat" class="form-control input-sm">
                                <option value="">-- Chọn loại nhà đất --</option>
                                <?php
                                $listcat = json_decode(modules::run('search/ajax/getCatbyType',$bds->type));
                                foreach($listcat as $cat)
                                {

                                    $select = false;
                                    if($bds->cat == $cat->id)
                                        $select = true;
                                    ?>
                                    <option value="<?php echo $cat->id;?>" <?php echo  set_select('cat', $cat->id, $select); ?>><?php echo $cat->name;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo form_error('cat');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php
                        $listtinhthanh = modules::run('search/ajax/getTinhThanh');
                        ?>
                        <label class="control-label col-sm-2" >Tỉnh/Thành phố (<span class="required">*</span>):</label>
                        <div class="col-sm-4">
                            <select name="province" id="post_province" class="form-control input-sm">
                                <option value="">-- Chọn Tỉnh/Thành phố --</option>
                                <?php
                                foreach($listtinhthanh as $tinhthanh)
                                {
                                    $select = false;
                                    if($bds->province == $tinhthanh->id)
                                        $select = true;
                                    ?>
                                    <option value="<?php echo $tinhthanh->id;?>" <?php echo  set_select('province', $tinhthanh->id, $select); ?>><?php echo $tinhthanh->name;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo form_error('province');?>
                        </div>
                        <label class="control-label col-sm-2" >Quận/Huyện (<span class="required">*</span>):</label>
                        <div class="col-sm-4">
                            <select name="district" id="post_district" class="form-control input-sm">
                                <option value="">-- Chọn Quận/ Huyện --</option>
                                <?php
                                $listquanhuyen = json_decode(modules::run('search/ajax/getQuanHuyen',$bds->province));
                                foreach($listquanhuyen as $quanhuyen)
                                {
                                    $select = false;
                                    if($bds->district == $quanhuyen->id)
                                        $select = true;
                                    ?>
                                    <option value="<?php echo $quanhuyen->id;?>" <?php echo  set_select('district', $quanhuyen->id, $select); ?>><?php echo $quanhuyen->name;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo form_error('district');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Phường/xã (<span class="required">*</span>):</label>
                        <div class="col-sm-4">
                            <select name="ward" id="post_ward" class="form-control input-sm">
                                <option value="">-- Chọn Phường/Xã --</option>
                                <?php
                                $listphuongxa = json_decode(modules::run('search/ajax/getPhuongXa',$bds->district));
                                foreach($listphuongxa as $phuongxa)
                                {
                                    $select = false;
                                    if($bds->ward == $phuongxa->id)
                                        $select = true;
                                    ?>
                                    <option value="<?php echo $phuongxa->id;?>" <?php echo  set_select('ward', $phuongxa->id, $select); ?>><?php echo $phuongxa->name;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo form_error('ward');?>
                        </div>
                        <label class="control-label col-sm-2" >Đường:</label>
                        <div class="col-sm-4">
                            <select name="street" id="post_street" class="form-control input-sm">
                                <option value="">-- Chọn Đường --</option>
                                <?php
                                $listduong = json_decode(modules::run('search/ajax/getDuong',$bds->district));
                                foreach($listduong as $duong)
                                {
                                    $select = false;
                                    if($bds->street == $duong->id)
                                        $select = true;
                                    ?>
                                    <option value="<?php echo $duong->id;?>" <?php echo  set_select('street', $duong->id, $select); ?>><?php echo $duong->name;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo form_error('street');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Địa chỉ (<span class="required">*</span>):</label>
                        <div class="col-sm-10">
                            <input name="address" type="text" id="post_address" value="<?php echo set_value('address',$bds->address);?>" class="form-control input-sm" />
                            <?php echo form_error('address');?>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Diện tích:</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input name="area" type="text" id="post_area" value="<?php echo set_value('area',$bds->area);?>" class="form-control input-sm" />
                                <span class="input-group-addon" id="basic-addon2">m<sup>2</sup></span>

                            </div>
                            <?php echo form_error('area');?>
                        </div>
                        <label class="control-label col-sm-1" >Giá:</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input name="price" type="text" id="post_price" onkeyup="getPriceText(this.value);" value="<?php echo set_value('price',0);?>" class="form-control input-sm" />
                                <span class="input-group-addon" id="basic-addon2">VNĐ</span>

                            </div>
                            <?php echo form_error('price');?>
                        </div>
                        <div class="col-sm-3">
                            <select name="unit" id="post_unit" class="form-control input-sm" style="float: left;">
                                <option value="1" <?php if($bds->unit == 1)echo "selected";?>>Tổng diện tích</option>
                                <option value="2" <?php if($bds->unit == 2)echo "selected";?>>m&#178;</option>
                                <option value="3" <?php if($bds->unit == 3)echo "selected";?>>m&#178;/tháng</option>
                                <option value="3" <?php if($bds->unit == 4)echo "selected";?>>tháng</option>
                            </select>
                            <?php echo form_error('unit');?>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Giá:</label>
                        <div class="col-sm-10">
                            <div id="text-price" class="text-price"></div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Mô tả (<span class="required">*</span>):</label>
                        <div class="col-sm-10">
                            <textarea name="detail" rows="10" class="form-control" id="detail"><?php echo set_value('detail',$bds->detail);?></textarea>
                            <?php echo form_error('detail');?><br />

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content animated fadeInRight">
                    <h3>Hình ảnh & bản đồ</h3>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content animated fadeInRight">
                    <h3>Thông tin chi tiết</h3>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Chiều dài:</label>
                        <div class="col-sm-4">
                            <input name="landlong" type="text" id="post_landlong" value="<?php echo set_value('landlong',$bds->landlong);?>" class="form-control input-sm" />
                            <?php echo form_error('long');?>
                        </div>
                        <label class="control-label col-sm-2" >Chiều rộng:</label>
                        <div class="col-sm-4">
                            <input name="landwidth" type="text" id="post_landwidth" value="<?php echo set_value('landwidth',$bds->landwidth);?>" class="form-control input-sm" />
                            <?php echo form_error('address');?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" >Mặt tiền:</label>
                        <div class="col-sm-4">
                            <input name="facade" type="text" id="post_facade" value="<?php echo set_value('facade',$bds->facade);?>" class="form-control input-sm" />
                            <?php echo form_error('facade');?>
                        </div>
                        <label class="control-label col-sm-2" >Hướng:</label>
                        <div class="col-sm-4">
                            <select name="direction" id="post_direction" class="form-control input-sm">
                                <option value="0">Không xác định</option>
                            </select>
                            <?php echo form_error('direction');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Số tầng:</label>
                        <div class="col-sm-4">
                            <input name="floor" type="text" id="post_floor" value="<?php echo set_value('floor',$bds->floor);?>" class="form-control input-sm" />
                            <?php echo form_error('floor');?>
                        </div>
                        <label class="control-label col-sm-2" >Số phòng ngủ:</label>
                        <div class="col-sm-4">
                            <input name="bedroom" type="text" id="post_bedroom" value="<?php echo set_value('bedroom',$bds->bedroom);?>" class="form-control input-sm" />
                            <?php echo form_error('bedroom');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Đường vào:</label>
                        <div class="col-sm-4">
                            <input name="street_width" type="text" id="post_street_width" value="<?php echo set_value('street_width',$bds->street_width);?>" class="form-control input-sm" />
                            <?php echo form_error('street_width');?>
                        </div>
                        <label class="control-label col-sm-2" >Toilet</label>
                        <div class="col-sm-4">
                            <input name="toilet" type="text" id="post_toilet" value="<?php echo set_value('toilet',$bds->toilet);?>" class="form-control input-sm" />
                            <?php echo form_error('toilet');?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Pháp lý:</label>
                        <div class="col-sm-4">
                            <select name="juridical" id="post_juridical" class="form-control input-sm">
                                <option value="0">Pháp lý</option>
                                <option value="1">Sổ đỏ</option>
                            </select>
                            <?php echo form_error('juridical');?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content animated fadeInRight">
                    <h3>Thời hạn</h3>
                    <div class="form-group">
                        <label class="control-label col-sm-1" style="min-width: 90px;" >Loại tin (<span class="required">*</span>):</label>
                        <div class="col-sm-2">
                            <select name="vip_type" id="post_vip_type" class="form-control input-sm">
                                <option value="1" <?php if($bds->vip_type == 1)echo "selected";?>>Thường</option>
                                <option value="2" <?php if($bds->vip_type == 2)echo "selected";?>>VIP</option>
                                <option value="3" <?php if($bds->vip_type == 3)echo "selected";?>>Premium</option>
                            </select>
                            <?php echo form_error('vip_type');?>
                        </div>
                        <?php
                        $date_from = date_format(date_create($bds->date_from),"d/m/Y");
                        $date_to = date_format(date_create($bds->date_to),"d/m/Y");
                        ?>
                        <label class="control-label col-sm-1" style="min-width: 80px;" >Từ ngày (<span class="required">*</span>):</label>
                        <div class="col-sm-3">
                            <input name="date_from" type="text" id="post_date_from" value="<?php echo set_value('date_from',$date_from);?>" class="form-control input-sm datepicker" />
                            <?php echo form_error('date_from');?>
                        </div>

                        <label class="control-label col-sm-1" style="min-width: 90px;" >Đến ngày (<span class="required">*</span>):</label>
                        <div class="col-sm-3">
                            <input name="date_to" type="text" id="post_date_to" value="<?php echo set_value('date_to',$date_to);?>" class="form-control input-sm datepicker" />
                            <?php echo form_error('date_to');?>
                        </div>
                    </div>


                        <div id="text_daynumber" style="font-size: 20px; padding-top: 10px">
                            <strong>Tổng ngày:</strong>
                            <span style="color: green"></span>
                        </div>
                        <div id="text_totalprice" style="font-size: 20px;" >
                            <strong>Tổng Tiền:</strong>
                            <span style="color: red"></span>
                        </div>



                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content animated fadeInRight" align="center">
                    <?php
                        if($bds->status == 0) {
                            ?>
                            <a href="/admin/user/duyettin/<?php echo $bds->id; ?>">
                                <button class="btn btn-warning"
                                " type="button"><i class="fa fa-edit"></i>&nbsp;Duyệt</button></a>
                            <?php
                        }
                    ?>

                    <?php
                    if($bds->status == 1) {
                        ?>
                        <a href="/admin/user/huyduyet/<?php echo $bds->id; ?>">
                            <button class="btn btn-warning"
                            " type="button"><i class="fa fa-edit"></i>&nbsp;Hủy duyệt</button></a>
                        <?php
                    }
                    ?>

                    <button onclick="remove('/admin/user/xoatin/<?php echo $bds->id; ?>');"
                            class="btn btn-danger btn-danger"
                    " type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                </div>
            </div>
        </div>
    </form>
</div>

