<aside class="aside-item collection-category">
    <div class="aside-title">
        <h3 class="title-head margin-top-0"><span>Danh mục</span></h3>
    </div>
    <div class="aside-content">
        <nav class="nav-category navbar-toggleable-md">
            <ul class="nav navbar-pills">
                <?php if(isset($news_cats))foreach ($news_cats as $item){ ?>
                    <li class="nav-item <?php if(isset($current_parent_id) and $current_parent_id == $item->id)echo "active";?>"><a href="/tin-tuc/<?php echo $item->slug;?>.html"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $item->name;?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</aside>