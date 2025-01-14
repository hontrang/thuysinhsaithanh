<h4 class="heading-primary"><?php echo $this->lang->line("danh_muc");?></h4>
<ul class="news-cat nav nav-list mb-xlg">
    <?php if(isset($listcat))foreach ($listcat as $item){ ?>
    <li class="<?php if(isset($current_parent_id) and $current_parent_id == $item->id)echo "active";?>"><a href="/bds/<?php echo $item->slug;?>.html"><?php echo $item->name;?></a></li>
    <?php } ?>
</ul>