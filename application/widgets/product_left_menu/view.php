<aside class="aside-item collection-category">
    <div class="aside-title">
        <h3 class="title-head margin-top-0"><span>Danh mục</span></h3>
    </div>
    <div class="aside-content">
        <nav class="nav-category navbar-toggleable-md">
            <ul class="nav navbar-pills">
                <li class="nav-item "><a class="nav-link" href="<?php echo site_url();?>"><i class="fa fa-caret-right" aria-hidden="true"></i> Trang chủ</a></li>
                <li class="nav-item active">
                    <a href="/san-pham.html" class="nav-link"><i class="fa fa-caret-right" aria-hidden="true"></i> Sản phẩm</a>
                    <i class="fa fa-angle-down"></i>
                    <ul class="dropdown-menu">
                        <?php if(isset($product_cats))foreach ($product_cats as $product_cat){?>
                        <li class="nav-item ">
                            <a class="nav-link" href="/san-pham/<?php echo $product_cat->slug;?>.html"><?php echo $product_cat->name;?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item "><a class="nav-link" href="/tin-tuc.html"><i class="fa fa-caret-right" aria-hidden="true"></i> Tin tức</a></li>
                <li class="nav-item "><a class="nav-link" href="/lien-he.html"><i class="fa fa-caret-right" aria-hidden="true"></i> Liên hệ</a></li>
            </ul>
        </nav>
    </div>
</aside>