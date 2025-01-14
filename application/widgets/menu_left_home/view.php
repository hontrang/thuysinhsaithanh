<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="nav-item start active">
        <a href="<?php echo site_url();?>" class="nav-link nav-toggle">
            <i class="icon-menu"><img class="icon icons8-Geo-fence" width="20" height="20" src="<?php echo base_url('public/templates/user/'.$current_template);?>/assets/layouts/layout4/img/marker.png"></i>
            <span class="title">Tất cả địa điểm</span>
        </a>
    </li>
    <li class="nav-item start active">
        <a href="<?php echo site_url('khuyen-mai');?>" class="nav-link nav-toggle">
            <i class="icon-menu"><img class="icon icons8-Sale-Filled" width="20" height="20" src="<?php echo base_url('public/templates/user/'.$current_template);?>/assets/layouts/layout4/img/sale.png"></i>
            <span class="title">Khuyến mãi</span>
        </a>
    </li>
    <li class="heading">
        <h3 class="uppercase">Danh mục</h3>
    </li>
    <?php
        foreach ($list as $menu){
    ?>
    <li class="nav-item ">
        <a href="<?php echo site_url($menu->slug);?>" class="nav-link">
            <i class="icon-menu"><img class="icon icons8-Shirt" width="20" height="20" src="<?php echo base_url('public/templates/user/'.$current_template);?>/assets/layouts/layout4/img/<?php echo $menu->icon;?>"></i>
            <span class="title"><?php echo $menu->name;?></span>
            <span class="arrow"></span>
        </a>
    </li>
    <?php } ?>

</ul>
<!-- END SIDEBAR MENU -->