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
            Đặt chỗ thành công!
        </div>

    </div>
    <div class="row tour-backgroud">
        <div class="col-md-12">
            <div class="col-md-12 tour-item listing-item">
                <div class="col-md-12">
                            <span class="thumb-info-caption-text">
                                <div class="info text-center">
                                    Bộ phận chăm sóc khách hàng sẽ liên lạc với quý khách để hướng dẫn và xác nhận thành toán. Cảm ơn quý khách!
                                </div>
                            </span>
                </div>
            </div>

        </div>

    </div>



</div>


