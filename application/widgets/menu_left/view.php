<div class="module shop-widget category-widget secondary-module">
    <h4 class="module-title"><i class="fa fa-bars" aria-hidden="true"></i>Danh mục<span class="toggle-btn"></span></h4>
    <div class="module-content mobile-collapse">
        <ul class="menu side-menu">
            <?php if(isset($cats))foreach ($cats as $cat){ ?>
            <li class="menu-item <?php if(isset($current_parent_id) and $cat->id == $current_parent_id)echo "active";?>">
                <a href="/san-pham/<?php echo $cat->slug;?>.html"><i class="<?php echo $cat->icon;?>" aria-hidden="true"></i><?php echo $cat->name;?></a>
                <ul class="sub-menu mega-menu">
                    <?php if(isset($cat->sub))foreach ($cat->sub as $sub){ ?>
                    <li class="menu-sub <?php if(isset($current_slug) and $current_slug == $sub->slug)echo "active";?>">
                        <a href="/san-pham/<?php echo $sub->slug;?>.html"><?php echo $sub->name;?></a>
                    </li>
                    <?php }?>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>