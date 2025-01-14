<h4 class="heading-primary"><?php echo $this->lang->line("danh_muc");?></h4>
<ul class="news-cat nav nav-list mb-xlg">
    <?php if(isset($noibo_cats))foreach ($noibo_cats as $item){ ?>
    <li class="<?php if(isset($current_parent_id) and $current_parent_id == $item->id)echo "active";?>"><a href="/tin-noi-bo/<?php echo $item->slug;?>.html"><?php echo $item->name;?></a></li>
    <?php } ?>
	
	<?php if($this->session->userdata("userid") != ""){?>
	<li ><a style="color:red; font-weight: bold;" href="/dang-xuat.html">Đăng xuất</a></li>
	<?php } ?>
</ul>