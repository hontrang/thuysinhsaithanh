<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 7/28/17 11:26 AM
 * Date: 8/1/17 6:09 AM
 *
 */

$this->load->helper('form');
    $datefrom = date("d/m/Y");
    
    $dateto = date('d/m/Y',date(strtotime("+7 day", time())));
?>
<?php
echo $this->load->widget('breadcrumb_box');
?>
<div class="container">
    <div class="row">
    <form class="form-horizontal tooltip-set" id="dangtinForm" role="form" action="" method="POST">
      <div class="col-md-12">
        <?php echo validation_errors(); ?>
        <div class="panel panel-primary">
            <div class="panel-heading">Thông tin cơ bản</div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-2" >Danh mục (<span class="required">*</span>):</label>
                    <div class="col-sm-10">
                        <select name="cat" class="form-control">
                            <option value="">Chọn danh mục</option>
                            <?php
                            if(isset($listcat))
                                foreach($listcat as $cat)
                                {
                                    ?>
                                    <option value="<?php echo $cat->id;?>"><?php echo $cat->name;?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <?php echo form_error('cat');?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" >Tiêu đề (<span class="required">*</span>):</label>
                    <div class="col-sm-10">
                        <input type="text" maxlength="100" autocomplete="off" class="form-control input-sm" title="<strong>Tiêu đề:</strong><br />- Tiêu đề phải nhỏ hơn 100 ký tự.<br />- Dùng Tiếng Việt có dấu và phù hợp với nội dung tin đăng." id="post_title" name="title" placeholder="Tiêu đề phải nhỏ hơn 100 ký tự, sử dụng Tiếng Việt có dấu và phù hợp với nội dung tin đăng" value="<?php echo set_value('title')?>">
                        <?php echo form_error('title');?>
                        <div class="char_left" id="show_len"></div>
                    </div>
                </div>
                <div class="form-group">
                    
                    <label class="control-label col-sm-2" >Tỉnh/Thành phố (<span class="required">*</span>):</label>
                    <div class="col-sm-4">
                        <select name="province" id="post_province" class="form-control input-sm" title="<strong>Thông tin này là bắt buộc</strong>">
                            <option value="">-- Chọn Tỉnh/Thành phố --</option>
                            <?php
                                if(isset($listtinhthanh))foreach($listtinhthanh as $tinhthanh)
                                {
                            ?> 
                            <option value="<?php echo $tinhthanh->id;?>"><?php echo $tinhthanh->name;?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <?php echo form_error('province');?>
                    </div>
                    <label class="control-label col-sm-2" >Quận/Huyện (<span class="required">*</span>):</label>
                    <div class="col-sm-4">
                        <select name="district" id="post_district" class="form-control input-sm" title="<strong>Thông tin này là bắt buộc</strong>">
                            <option value="">-- Chọn Quận/ Huyện --</option>
                        </select>
                        <?php echo form_error('district');?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" >Phường/xã :</label>
                    <div class="col-sm-4">
                        <select name="ward" id="post_ward" class="form-control input-sm">
                            <option value="">-- Chọn Phường/Xã --</option>
                        </select>
                        <?php echo form_error('ward');?>
                    </div>
                    <label class="control-label col-sm-2" >Đường:</label>
                    <div class="col-sm-4">
                        <select name="street" id="post_street" class="form-control input-sm">
                            <option value="">-- Chọn Đường --</option>
                        </select>
                        <?php echo form_error('street');?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" >Địa chỉ (<span class="required">*</span>):</label>
                    <div class="col-sm-10">
                       <input name="address" type="text" id="post_address" autocomplete="off" value="<?php echo set_value('address');?>" class="form-control input-sm" title="<strong>Địa chỉ:</strong><br  />- Địa chỉ của BĐS"/>
                       <?php echo form_error('address');?>
                    </div>
                    
                </div>
                        
                <div class="form-group">
                    <label class="control-label col-sm-2" >Diện tích:</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input name="area" autocomplete="off" placeholder="Không xác định" id="post_area" onkeypress="return event.charCode === 46 || (event.charCode >= 48 && event.charCode <= 57)" value="<?php echo set_value('area');?>" class="form-control input-sm" title="<strong>Diện tích:</strong><br />- Là số nguyên và đơn vị tình bằng m vuông.<br />- <strong>Nếu bạn không xác định được diện tích hãy bỏ trống.<strong>" />
                            <span class="input-group-addon" id="basic-addon2">m<sup>2</sup></span>
                            
                        </div>
                        <?php echo form_error('area');?>
                    </div>
                    <label class="control-label col-sm-1" >Giá:</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input name="price" autocomplete="off" placeholder="Thỏa thuận" onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="post_price" value="<?php echo set_value('price');?>" class="form-control input-sm" title="<strong>Diện tích:</strong><br />- Là số nguyên.<br />- Hãy chọn đơn vị tính ở ô kế bên.<br />- <strong>Nếu giá là thỏa thuận hãy bỏ trống.<strong>"/>
                            <span class="input-group-addon" id="basic-addon2">VNĐ</span>
                            
                        </div>
                        <?php echo form_error('price');?>
                    </div>
                    <div class="col-sm-3">
                        <select name="unit" id="post_unit" class="form-control input-sm" style="float: left;">
                            <option value="1">Tổng diện tích</option>
                            <option value="2">m&#178;</option>
                            <option value="3">tháng</option>
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
                            <textarea name="detail" maxlength="3000" rows="10" class="form-control" id="detail" placeholder="Tối đa 3000 ký tự.
- Ghi bằng tiếng việt có dấu.
- Giới thiệu chung về bất động sản của bạn.
Ví dụ: Khu nhà gần công viên, gần trường học ... vừa được xây dựng, bao gồm toàn bộ nội thất..." title="<strong>Mộ tả:</strong><br />- Tối đa 3000 ký tự.<br />- Ghi bằng tiếng việt có dấu.<br />- Giới thiệu chung về bất động sản của bạn.<br />Ví dụ: Khu nhà gần công viên, gần trường học ... vừa được xây dựng, bao gồm toàn bộ nội thất..."><?php echo set_value('detail');?></textarea>
                            <?php echo form_error('detail');?><br />
                            <div class="char_left" id="show_len_detail"></div>

                            (<span class="required">*</span>) Thông tin đầy đủ sẽ giúp tin đăng có hiệu quả tiếp cận cao nhất.
                        </div>
                </div> 
                    

                
            
            </div>
        </div>


        <div class="panel panel-primary">
            <style>#map{height:490px;}</style>
            <div class="panel-heading">Hình ảnh & Vị trí</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="map"></div>
                        <input id="map_lat" name="map_lat" type="hidden" /><input id="map_lng" name="map_lng" type="hidden" />
                    </div>
                    <div class="col-md-12">
                        <input type="file" name="files">
                        <div>
                            <div class="bold red"><span class="required">*</span> Lưu ý:</div>
                            - Bạn được phép đăng tối đa <strong>10</strong> ảnh.<br />
                            - Dung lượng mỗi ảnh không vượt quá <strong>2 MB</strong>.<br />
                            - <strong>Tin rao có ảnh luôn có tỷ lệ giao dịch thành công gấp nhiều lần tin không có ảnh.</strong> Hãy đăng ảnh để giao dịch nhanh chóng.
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">Thông tin chi tiết</div>
            <div class="panel-body">

                <div id="box_chi_tiet">
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Chiều dài:</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input name="landlong" type="text" id="post_landlong" value="<?php echo set_value('landlong');?>" class="form-control input-sm" />
                                <span class="input-group-addon" id="basic-addon2">m<sup>2</sup></span>
                            </div>
                            <?php echo form_error('long');?>
                        </div>
                        <label class="control-label col-sm-2" >Chiều rộng:</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input name="landwidth" type="text" id="post_landwidth" value="<?php echo set_value('landwidth');?>" class="form-control input-sm" />
                                <span class="input-group-addon" id="basic-addon2">m<sup>2</sup></span>
                            </div>
                            <?php echo form_error('address');?>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Mặt tiền:</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input name="facade" type="text" id="post_facade" value="<?php echo set_value('facade');?>" class="form-control input-sm" />
                                <span class="input-group-addon" id="basic-addon2">m<sup>2</sup></span>
                            </div>
                            <?php echo form_error('facade');?>
                        </div>
                        <label class="control-label col-sm-2" >Hướng:</label>
                        <div class="col-sm-4">
                            <select name="direction" id="post_direction" class="form-control input-sm">
                                <?php foreach(HuongList() as $k => $v){?>
								<option value="<?php echo $k;?>"><?php echo $v;?></option>
								<?php } ?>
                            </select>
                            <?php echo form_error('direction');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Số tầng:</label>
                        <div class="col-sm-4">
                            <input name="floor" type="text" id="post_floor" value="<?php echo set_value('floor');?>" class="form-control input-sm" />
                            <?php echo form_error('floor');?>
                        </div>
                        <label class="control-label col-sm-2" >Số phòng ngủ:</label>
                        <div class="col-sm-4">
                            <input name="bedroom" type="text" id="post_bedroom" value="<?php echo set_value('bedroom');?>" class="form-control input-sm" />
                            <?php echo form_error('bedroom');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Đường vào:</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input name="street_width" type="text" id="post_street_width" value="<?php echo set_value('street_width');?>" class="form-control input-sm" />
                                <span class="input-group-addon" id="basic-addon2">m<sup>2</sup></span>
                            </div>
                            <?php echo form_error('street_width');?>
                        </div>
                        <label class="control-label col-sm-2" >Toilet</label>
                        <div class="col-sm-4">
                            <input name="toilet" type="text" id="post_toilet" value="<?php echo set_value('toilet');?>" class="form-control input-sm" />
                            <?php echo form_error('toilet');?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" >Pháp lý:</label>
                        <div class="col-sm-4">
                            <select name="juridical" id="post_juridical" class="form-control input-sm">
                                <?php foreach(PhapLyList() as $k => $v){?>
								<option value="<?php echo $k;?>"><?php echo $v;?></option>
								<?php } ?>
                            </select>
                            <?php echo form_error('juridical');?>
                        </div>
                        
                    </div>
                </div>
            
            </div>
        </div>

        

        <div class="col-md-12" align="center">
            <input type="submit" class="btn btn-primary" name="btnSubmit" id="BanSubmit" value="Đăng tin" />
        </div>
        <div class="col-md-12" style="padding-bottom:10px;">
            
        </div>
        
    </div>
    </form>
    </div>

</div>


    