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
            Thông tin đặt Tour
        </div>

    </div>
    <div class="row tour-backgroud">
        <div class="col-md-12">
            <div class="col-md-12 tour-item listing-item">
                <?php if($info->ribbon != ""){?>
                    <div class="plan-ribbon-wrapper"><div class="plan-ribbon <?php echo $info->ribbon;?>">Tour Mới</div></div>
                <?php }?>
                <div class="col-md-3 ">
                    <img src="<?php echo base_url('public/userfiles/'.$info->image);?>" class="img-responsive" alt="<?php echo $info->name;?>" >
                </div>
                <div class="col-md-9">
                            <span class="thumb-info-caption-text">
                                <a href="/du-lich/tour-<?php echo $info->slug;?>-<?php echo $info->id;?>.html"><h5 class="mb-xs tour-title"><?php echo $info->name;?></h5></a>
                                <div class="tour-vote">
                                    <div></div>
                                    <div class="vote-box"><div class="vote" data-start-value="<?php echo $info->vote_point;?>"></div>
<strong><?php echo round($info->vote_point*5);?>/5</strong> điểm trong <strong><?php echo $info->vote;?></strong> đánh giá</div>
                                </div>
                                <div class="info">
                                    <div class="col-md-10 paddding-left-0">
                                        <div class="col-md-6 paddding-left-0"><i class="fa fa-clock-o"></i> Số ngày: <strong><?php echo $info->time;?></strong></div>
                                        <div class="col-md-6 paddding-left-0"><i class="fa fa-calendar"></i> Khởi hàng: <strong><?php echo date("d/m/Y H:i:s", strtotime($info->time_start));?></strong></div>
                                        <div class="col-md-6 paddding-left-0"><i class="fa fa-user"></i> Số chỗ còn lại: <strong><?php echo $info->seat;?></strong></div>
                                        <div class="col-md-6 paddding-left-0"><i class="fa fa-qrcode"></i> Mã tour: <strong><?php echo $info->code;?></strong></div>
                                    </div>
                                    <div class="col-md-2 tour-price-box">
                                        <div class="tour-price"><?php echo ($info->price);?></div>
                                        <div class="tour-view"><a class="btn btn-primary" href="/du-lich/tour-<?php echo $info->slug;?>-<?php echo $info->id;?>.html">Xem chi tiết</a></div>
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
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Họ Tên *</label>
                            <input type="text" value="" maxlength="100" class="form-control" name="name" id="name" required>
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                        <div class="col-md-6">
                            <label>Email *</label>
                            <input type="email" value="" placeholder="VD: abc@gmail.com" maxlength="100" class="form-control" name="email" id="email" required>
                            <?php echo form_error('name', '<div class="email">', '</div>'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Số Điện Thoại *</label>
                            <input type="text" value="" maxlength="100" class="form-control" name="phone" id="phone" required>
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


