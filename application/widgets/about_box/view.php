<aside class="aside-item collection-category">

    <div class="aside-content">
        <nav class="nav-category navbar-toggleable-md">
            <ul class="nav navbar-pills">
                <?php if(isset($about_list))foreach ($about_list as $item){ ?>
                    <li class="nav-item <?php if(isset($current_parent_id) and $current_parent_id == $item->id)echo "active";?>"><a href="/gioi-thieu/<?php echo $item->slug;?>.html"><i class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $item->name;?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</aside>