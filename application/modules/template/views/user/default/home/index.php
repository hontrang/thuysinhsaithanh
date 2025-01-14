<?php
echo $this->load->widget('slide_box');
?>
<style>
.pro_cat_item figure img {
	-webkit-transform: scale(1);
	transform: scale(1);
	-webkit-transition: .3s ease-in-out;
	transition: .3s ease-in-out;
}
.pro_cat_item figure:hover img {
	-webkit-transform: scale(1.3);
	transform: scale(1.3);
}
.pro_cat_a {
    display: block;
    text-align: center;
    height: 175px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #efefef;
    border-radius: 50%;
    margin: 0 auto;
    margin-bottom: 15px;
	border: 1px dashed #c90d0d;
	/*background-image: url(/public/userfiles/bd-cat.webp);*/
    background-size: 100% 100%;
    padding: 5px;
    max-width: 100%;
    height: auto;
	margin-right: 10px;

}
.pro_cat_item figure {
    border-radius: 100%;
}

figure {
    overflow: hidden;
}
.bg-pro-cat{
	padding-top: 30px;
}
.pro_cat_text h3 {
	text-align: center;
}
.pro_cat_text a {
	font-size: 14px;
	color: #fff;
	
}
.bg-red{
	background: linear-gradient(182deg, #e71f1f, #850404);
}
.pd-20{
	padding: 10px;
	border-radius: 5px;
}
.border-tab-custom{
	border-bottom: 2px solid red !important;
}
</style>
<div class="bg-white1">
<div class="container section-product">
    <div class="product-sale">
		<div class="row">
			<div class="col-lg-12 col-xs-12">
				<div class="popular-tabs container-tab ">
					<ul class="nav-tab one-line-mobile border-tab-custom">
						<li class="active">
							<a data-toggle="tab" href="#tab-hot" aria-expanded="false">BÁN CHẠY NHẤT   </a>
						</li>
						<li class="">
							<a data-toggle="tab" href="#tab-promotion" aria-expanded="false">KHUYẾN MÃI</a>
						</li>						
					</ul>					
					<div class="tab-content">
						<div id="tab-hot" class="tab-panel active">
							<div class="list-product-home-popular owl-dos list-product owl-carousel owl-theme tab-owl" data-autoplay="false" data-margin="10" data-slidespeed="200" data-autoheight="false" data-nav="true" data-dots="false" data-loop="true" data-autoplaytimeout="1000" data-autoplayhoverpause="true" data-responsive='{"0":{"items":"2"},"768":{"items":"4"},"992":{"items":"4"},"1200":{"items":"4"}}'>
								<?php
									
									$products = $this->MCommon->getAllRowByWhere_lang($lang,'product',['is_hot'=>1,'hide'=>0],9,"orders DESC");
									if($products)foreach($products as $item){
										$product_promotion = $this->MCommon->getTotalRow('product_promotion',['product_id'=>$item->id]);
										if($product_promotion > 0) $product_promotion_text = "Có $product_promotion khuyến mãi.";
										else $product_promotion_text = "";
										
									$price = $item->price;
									if($discount_cat[$item->cat_id] > 0){
										$giam = $item->price_old*$discount_cat[$item->cat_id]/100;
										$price = $item->price_old-$giam;
									}
								?>
								<div class="item">
									<div class="p-item">
										<?php if($item->tragop != ""){?>
										<span class="icon_tragop">Trả góp 
											<i><?php echo $item->tragop;?>%</i>
										</span>
										<?php } ?>
										
										<?php if((int)$item->price_old > (int)$price){
											$tile = ceil(100-((100/(int)$item->price_old)*(int)$price));
										?>
										<span class="icon_tragop">Giảm 
											<i><?php echo $tile;?>%</i>
										</span>
										<?php } ?>
											<div class="p-image">
												<a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-img">
													<img src="<?php echo thumb($item->image,'400x400',1);?>" width="400" height="400" alt="<?php echo $item->name;?>">
												
												</a>
												<div class="add-to-cart">
													<a rel="nofollow" class="buy_now" href="javascript:;" data-quantity="1" data-id="<?php echo $item->id;?>" class="button product_type_simple add_to_cart_button ajax_add_to_cart">Đặt hàng</a></div>
											</div>
											<div class="pr-box">
											<h3 style="margin:0px;"><a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-name"><?php echo $item->name;?></h3></a>
											<div class="p-price">
												<div class="p-price"><?php if((int)$price > 0){?><?php echo number_format($price); ?> <sup>₫</sup> <?php }else{?>Liên hệ<?php } ?></div>
												<div class="p-price-old"><?php if((int)$item->price_old > 0){?><?php echo number_format($item->price_old);?> <sup>₫</sup> <?php } ?></div>
											</div>
										   </div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
						<div id="tab-promotion" class="tab-panel">
							<div class="list-product-home-popular owl-dos list-product owl-carousel owl-theme tab-owl" data-autoplay="false" data-margin="10" data-slidespeed="200" data-autoheight="false" data-nav="true" data-dots="false" data-loop="true" data-autoplaytimeout="1000" data-autoplayhoverpause="true" data-responsive='{"0":{"items":"2"},"768":{"items":"4"},"992":{"items":"4"},"1200":{"items":"4"}}'>
								<?php
									
									$products = $this->MCommon->getAllRowByWhere_lang($lang,'product',['price_old !='=>0,'hide'=>0],9,"orders DESC");
									if($products)foreach($products as $item){
										$product_promotion = $this->MCommon->getTotalRow('product_promotion',['product_id'=>$item->id]);
										if($product_promotion > 0) $product_promotion_text = "Có $product_promotion khuyến mãi.";
										else $product_promotion_text = "";
										
									$price = $item->price;
									if($discount_cat[$item->cat_id] > 0){
										$giam = $item->price_old*$discount_cat[$item->cat_id]/100;
										$price = $item->price_old-$giam;
									}
								?>
								<div class="item">
									<div class="p-item">
										<?php if($item->tragop != ""){?>
										<span class="icon_tragop">Trả góp 
											<i><?php echo $item->tragop;?>%</i>
										</span>
										<?php } ?>
										
										<?php if((int)$item->price_old > (int)$price){
											$tile = ceil(100-((100/(int)$item->price_old)*(int)$price));
										?>
										<span class="icon_tragop">Giảm 
											<i><?php echo $tile;?>%</i>
										</span>
										<?php } ?>
										
											<div class="p-image">
												<a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-img">
													<img src="<?php echo thumb($item->image,'400x400',2);?>" width="400" height="400" alt="<?php echo $item->name;?>">
												
												</a>
												<div class="add-to-cart">
													<a rel="nofollow" class="buy_now" href="javascript:;" data-quantity="1" data-id="<?php echo $item->id;?>" class="button product_type_simple add_to_cart_button ajax_add_to_cart">Đặt hàng</a></div>
											</div>
											<div class="pr-box">
											<h3 style="margin:0px;"><a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-name"><?php echo $item->name;?></h3></a>
											<div class="p-price">
												<div class="p-price"><?php if((int)$price > 0){?><?php echo number_format($price); ?> <sup>₫</sup> <?php }else{?>Liên hệ<?php } ?></div>
												<div class="p-price-old"><?php if((int)$item->price_old > 0){?><?php echo number_format($item->price_old);?> <sup>₫</sup> <?php } ?></div>
											</div>
											
											<div class="	" style="display:none">
												<?php if($product_promotion_text !=""){?>
												<p><img src="/public/userfiles/gift.gif" /><?php echo $product_promotion_text;?></p>
												<?php } ?>
											</div>
										   </div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
		
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
</div>
<?php if (isset($product_cats_home)) foreach ($product_cats_home as $cat) { ?>
	<style>
		.section-product .product-cat-<?php echo $cat->id;?>{
			background-color: <?php echo $cat->color;?> !important;
			background-color: #980303 !important;
		}
		.nav-menu-blue li a.cat-<?php echo $cat->id;?>:hover, .nav-menu-blue li.active a.cat-<?php echo $cat->id;?> {
			background: <?php echo $cat->color;?> !important;
		}
	</style>
    <div class="section-product container-tab" data-cat="cat-<?php echo $cat->slug; ?>" id="pro-cat-<?php echo $cat->slug; ?>">
        <div class="container">

			<nav class="navbar nav-menu nav-menu-blue product-cat-<?php echo $cat->id;?> show-brand">
				<div class="container-title">
					<div class="navbar-brand">
						<a href="/san-pham/<?php echo $cat->slug; ?>.html"> <?php echo $cat->name; ?> </a>
					</div>
					<span class="toggle-menu">
					</span>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
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
					</div>
				</div>	
			</nav>
        </div>
        <div class="container">
            <div class="row">
                
				<div class="col-md-12">
               
                    <div class="box-product list-product product-featured-content" id="list_<?php echo $cat->id;?>">
						<div class="product-featured-list">
							<div class="tab-content">
								<?php 
									$i=0;
									$brands = $this->MCommon->getBrandByCats($cat->id);
									if($brands)foreach($brands as $brand){
								?>
								
								<div class="tab-panel <?php echo ($i==0)?'active':'';?>" id="cat-<?php echo $cat->id;?>-<?php echo $brand->id;?>">
									<div class="list-product-home owl-dos owl-carousel owl-theme tab-owl" data-autoplay="false" data-margin="10" data-slidespeed="200" data-autoheight="false" data-nav="true" data-dots="false" data-loop="true" data-autoplaytimeout="1000" data-autoplayhoverpause="true" data-responsive='{"0":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"4"}}'>
										<?php
											
											$products = $this->MCommon->getAllRowWithPageWhereIn_lang($lang,'product',8,0,"orders DESC",'cat_id',$this->MCommon->getCatIDs($cat->id),['hide'=>0,'brand_id'=>$brand->id]);
											if($products)foreach($products as $item){
												$product_promotion = $this->MCommon->getTotalRow('product_promotion',['product_id'=>$item->id]);
												if($product_promotion > 0) $product_promotion_text = "Có $product_promotion khuyến mãi.";
												else $product_promotion_text = "";
												
											$price = $item->price;
											if($discount_cat[$item->cat_id] > 0){
												$giam = $item->price_old*$discount_cat[$item->cat_id]/100;
												$price = $item->price_old-$giam;
											}
										?>
										<div class="item">
											<div class="p-item">
												<?php if($item->tragop != ""){?>
												<span class="icon_tragop">Trả góp 
													<i><?php echo $item->tragop;?>%</i>
												</span>
												<?php } ?>
												
												<?php if((int)$item->price_old > (int)$price){
													$tile = ceil(100-((100/(int)$item->price_old)*(int)$price));
												?>
												<span class="icon_tragop">Giảm 
													<i><?php echo $tile;?>%</i>
												</span>
												<?php } ?>
												
													<div class="p-image">
														<a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-img">
															<img src="<?php echo thumb($item->image,'400x400',1);?>" width="400" height="400" alt="<?php echo $item->name;?>">
														
														</a>
														<div class="add-to-cart">
															<a rel="nofollow" class="buy_now" href="javascript:;" data-quantity="1" data-id="<?php echo $item->id;?>" class="button product_type_simple add_to_cart_button ajax_add_to_cart">Đặt hàng</a></div>
													</div>
													<div class="pr-box">
													<h3 style="margin:0px;"><a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-name"><?php echo $item->name;?></h3></a>
													<div class="p-price">
														<div class="p-price"><?php if((int)$price > 0){?><?php echo number_format($price); ?> <sup>₫</sup> <?php }else{?>Liên hệ<?php } ?></div>
														<div class="p-price-old"><?php if((int)$item->price_old > 0){?><?php echo number_format($item->price_old);?> <sup>₫</sup> <?php } ?></div>
													</div>
													
													<div class="khuyenmai" style="display:none">
														<?php if($product_promotion_text !=""){?>
														<p><img src="/public/userfiles/gift.gif" /><?php echo $product_promotion_text;?></p>
														<?php } ?>
													</div>
												   
													</div>						
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
								<?php $i++;} ?>
							</div>
						</div>
                    </div>
					
                </div>
            </div>
			
        </div>
    </div>
<?php } ?>
<!-- Begin blog -->
<div class="section-blog">
    <div class="container">
        <div class="title">
            <h3>Tin tức, mẹo vặt, hướng dẫn</h3>
            <a href="/tin-tuc/bai-viet-huong-dan.html" class="view-all">Xem tất cả
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="blog-left b-item">
            <?php $i = 0; if(isset($news))foreach($news as $item){ if($i==0){?>
                <a href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="b-img show-video_article" data-video="<?php echo $item->id;?>">
                        <img src="<?php echo thumb($item->image,'600x400',1);?>" width="300" height="200" alt="<?php echo $item->name;?>">
                    </a>
                    <a href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="b-name show-video_article" data-video="<?php echo $item->id;?>"><?php echo $item->name;?></a>
            <?php } $i++; } ?>
        </div>
        <div class="blog-right">
            <?php $i = 0; if(isset($news))foreach($news as $item){ if($i>0){?>
            <div class="b-item">
                <a href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="b-img show-video_article" data-video="<?php echo $item->id;?>">
                    <img src="<?php echo thumb($item->image,'600x400',1);?>" width="300" height="200" alt="<?php echo $item->name;?>">
                </a>
                <a href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="b-name show-video_article" data-video="<?php echo $item->id;?>"><?php echo $item->name;?></a>
            </div>
            <?php } $i++; } ?>
         </div>
    </div>
</div><!-- End blog -->