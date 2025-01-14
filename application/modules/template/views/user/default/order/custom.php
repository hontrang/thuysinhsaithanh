<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url();?>">Trang chủ</a></li>
                    <?php if(!empty($breadcrumb)) {
                        foreach ($breadcrumb as $title_br => $link_br) {
                            if($link_br != ""){
                                ?>
                                <li><a href="<?php echo site_url($link_br);?>"><?php echo $title_br;?></a></li>
                            <?php }else{ ?>
                                <li class="active"><?php echo $title_br;?></li>
                            <?php } } } ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container tour-info">
    <div class="row tour-backgroud">
        <div class="col-md-12 order-title">
            Thông tin đặt chỗ
        </div>

    </div>
    <div class="row tour-backgroud">
        <div class="col-md-12">
            <div class="col-md-12 tour-item listing-item">
                <div class="col-md-12">
                            <span class="thumb-info-caption-text">
                                <div class="info">
                                    <div class="col-md-12 paddding-left-0">
                                        <div class="col-md-6 paddding-left-0">Xuất phát: <strong><?php echo $from;?></strong></div>
                                        <div class="col-md-6 paddding-left-0">Điểm đến: <strong><?php echo $to;?></strong></div>
                                    </div>
                                    <div class="col-md-12 paddding-left-0">
                                        <div class="col-md-6 paddding-left-0">Loại Tour: <strong><?php echo $cat;?></strong></div>
                                        <div class="col-md-6 paddding-left-0">Ngày xuất phát: <strong><?php echo $date;?></strong></div>
                                    </div>
                                    <div class="col-md-12 paddding-left-0">
                                        <div class="col-md-6 paddding-left-0">Giá: <strong><?php if($price != "")echo ($price);?></strong></div>
                                    </div>
                                </div>
                            </span>
                </div>
            </div>

        </div>

    </div>
    <div class="row tour-backgroud">
        <div class="col-md-12 order-title">
            Thông tin liên lạc
        </div>

    </div>
    <div class="row tour-backgroud">
        <div class="col-md-12">
            <form id="contactForm" action="" method="POST">
                <input type="hidden" name="from" value="<?php echo $from;?>" />
                <input type="hidden" name="to" value="<?php echo $to;?>" />
                <input type="hidden" name="cat" value="<?php echo $cat;?>" />
                <input type="hidden" name="date" value="<?php echo $date;?>" />
                <input type="hidden" name="price" value="<?php echo $price;?>" />

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Họ Tên *</label>
                            <input type="text" value="<?php if($fullname != "")echo $fullname;?>" maxlength="100" class="form-control" name="name" id="name" required>
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label>Email *</label>
                            <input type="email" value="<?php if($email != "")echo $email;?>" placeholder="VD: abc@gmail.com" maxlength="100" class="form-control" name="email" id="email" required>
                            <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Số Điện Thoại *</label>
                            <input type="text" value="<?php if($phone != "")echo $phone;?>" maxlength="100" class="form-control" name="phone" id="phone" required>
                            <?php echo form_error('phone', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label>Địa chỉ</label>
                            <input type="address" value="" placeholder="" maxlength="200" class="form-control" name="address" id="address">
                            <?php echo form_error('address', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Ghi chú</label>
                            <textarea maxlength="5000" rows="5" class="form-control" name="note" id="content"></textarea>
                            <?php echo form_error('note', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <input type="submit" name="submit" value="GỬI ĐẶT CHỖ" class="btn btn-primary btn-lg mb-xlg">
                    </div>
                </div>
            </form>
        </div>

    </div>



</div>


