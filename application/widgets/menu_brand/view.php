<div class="module shop-widget category-widget secondary-module">
    <h4 class="module-title"><i class="fa fa-bars" aria-hidden="true"></i>Thương hiệu<span class="toggle-btn"></span></h4>
    <div class="module-content mobile-collapse">
        <ul class="menu side-menu brand-menu">
            <?php if(isset($brands))foreach ($brands as $brand){ ?>
            <li class="menu-item">
                <a href="/thuong-hieu/<?php echo $brand->slug;?>.html"><?php echo $brand->name;?></a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>