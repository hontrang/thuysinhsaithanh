<?php

$lang = 'vi';
if ($this->session->userdata("lang") != "")
    $lang = $this->session->userdata("lang");

?>
<style>
	.hidden{
		display: none;
	}
	
</style>

<header class="header bg-fff">
	<div class="top-header">
		<div class="container">
			<ul id="menu-topbar-menu-left" class="navigation top-bar-menu left ">
				<li>
					<a href="tel: <?php echo $site_config['phone'];?>"><span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $site_config['phone'];?> </span></a>
				</li>
				<li>
					<a href="mailto:<?php echo $site_config['email'];?>"><span><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $site_config['email'];?></span></a>
				</li>
			</ul>
			<ul id="menu-topbar-menu-right" class="navigation top-bar-menu right hidden-xs">
				
				<li>
					<a href="/" target="_blank"><i class="fas fa-map-marker-alt"></i> <?php echo $site_config['address_vi'];?></a>
					
				</li>
				
				
			</ul>
		</div>
	</div>
    <div class="container header-top">
        <div id="b_scroll_left" style="display:none;"> </div>
        <div id="b_scroll_right" style="display:none;"> </div>

        <div class="logo">
            <a href="/">
                <img src="/public/userfiles/<?php echo $site_config['logo_vi'];?>" width="400" height="80" alt="<?php echo $site_config['title_vi'];?>">
            </a>
        </div>
        <div class="search">
            <span class="show-search">
                <i class="fas fa-search"></i>
            </span>
            <form name="search" id="search" action="/tim-kiem.html">
                <input type="text" id="text_search" name="q" placeholder="Bạn tìm gì...." autocomplete="off">
                <span class="btn-search" onClick="search.submit();">
                    <i class="fas fa-search"></i>
                </span>
                <div class="autocomplete-suggestions"></div>
            </form>

        </div>
        <div class="header-link">
			<a href="tel:<?php echo $site_config['phone'];?>" class="hotline hidden-xs">
                
               <i class="fa fa-phone-square" aria-hidden="true"></i><?php echo $site_config['phone'];?>
                <span>HOTLINE</span>
            </a>
			
			<a href="tel:<?php echo $this->lang->line('phone_cskh');?>" class="hotline hidden-xs">
                
                <i class="fa fa-phone-square" aria-hidden="true"></i><?php echo $this->lang->line('phone_cskh');?>
                <span>CSKH</span>
            </a>
            <a href="/gio-hang.html" class="icon-cart"><span><i class="fas fa-shopping-cart"></i><b id="count_shopping_cart_store"><?php echo $this->cart->total_items();?></b></span></a>
			
			
            
        </div>
    </div>
    <div class="menu-header">
        <div class="container heaed-table">
        <?php 
            $menuactive = "";
            if($module == "home")
                $menuactive = "active";
        ?>
            <div class="menu-left <?php echo $menuactive;?>">
                <span class="show-menu">
                    <i class="fas fa-bars"></i> Danh mục sản phẩm</span>
                <div class="nav active">
                    <div class="menu-item hidden">
                        <a href="/san-pham/khuyen-mai.html">GIẢM GIÁ ĐẶC BIỆT</a>
                    </div>
                    <?php if(isset($product_cats))foreach($product_cats as $cat){?>
                    <div class="menu-item">
                        <a href="/san-pham/<?php echo $cat->slug;?>.html"> <img src="/public/userfiles/icon.jpg" alt="icon cat product"> <?php echo $cat->name;?></a>
                        
                        <i class="fas fa-angle-right"></i>
                        <div class="menu-mega">
                            <ul class="main-sub">
								<?php
								$sub = $this->MCommon->getAllRowByWhere_lang($lang, 'product_cat', ['parent_id' => $cat->id], null, "orders ASC");
								if ($sub)foreach ($sub as $cat2) {?>
									<li class="item-sub">
										<a href="/san-pham/<?php echo $cat2->slug; ?>.html"><?php echo $cat2->name; ?></a>
										
										<ul class="main-child">
											<?php
												$sub2 = $this->MCommon->getAllRowByWhere_lang($lang, 'product_cat', ['parent_id' => $cat2->id], null, "orders ASC");
												if ($sub2)foreach ($sub2 as $cat3) {?>
												<li><a href="/san-pham/<?php echo $cat3->slug; ?>.html"><?php echo $cat3->name; ?></a></li>
											<?php } ?>
										</ul>
									</li>
								<?php } ?>
                                
                            </ul>
                        </div>

                    </div>
                    <?php } ?>

                    

                </div>
            </div>
            <div class="menu-right">
				 <nav class="nav-top">
					<div class="nav-fostrap">
						<ul>
							<?php if(isset($menu_tops))foreach($menu_tops as $item){?>
							<li>
								<a target="<?php echo $item->target;?>" href="<?php echo $item->url;?>"><?php echo $item->name;?> <?php if(isset($item->sub))echo '<span class="arrow-down"></span>';?></a>
								<?php if(isset($item->sub)){?>
								<ul class="dropdown">
									<?php foreach($item->sub as $sub){?>
									<li><a target="<?php echo $sub->target;?>" href="<?php echo $sub->url;?>"><?php echo $sub->name;?></a></li>
									<?php } ?>
								</ul>
								<?php } ?>
							</li>
							<?php } ?>
						   

						</ul>
					</div>
				 </nav>
            </div>
        </div>
    </div>
</header>

<script>
	$( document ).ready(function() {
		if($(window).width()> 768){
			var menu_height = $(".menu-left .nav").height();
			$(".banner").css("height",menu_height);
		}
		
	});
</script>