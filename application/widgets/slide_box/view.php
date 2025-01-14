<!-- Begin banner -->
<style>
@media (max-width: 575px){
	.hidden-xs{
		display: none !important;
	}
	
}
@media (max-width: 500px){
	#sync1 {
		height: 100% !important;
	}
	}
</style>
<div class="bg-white">
<div class="container">

    <div class="banner bg-fff">
        <div id="slider">
            <div style="position:relative">

                <div id="sync1" class="list-product-home-deal list-product owl-carousel owl-theme tab-owl" data-autoplay="true" data-margin="10" data-slidespeed="200" data-autoheight="false" data-nav="true" data-dots="false" data-loop="true" data-autoplaytimeout="1000" data-autoplayhoverpause="true" data-responsive='{"0":{"items":"1"},"768":{"items":"1"},"992":{"items":"1"},"1200":{"items":"1"}}'>
                    <?php if(isset($sliders))foreach($sliders as $item){?>
                    <div class="item"><img border=0 src="<?php echo base_url('public/userfiles/'.$item->image);?>" width="600" height="360" alt="<?php echo $item->name;?>" /> </div>
                    <?php } ?>
                </div>
                <!--<div class="btn_slide next_slide"></div>
                <div class="btn_slide prev_slide"></div>-->
            </div>
            <!--<div id="sync2" class="owl-carousel hidden-xs">
                <?php if(isset($sliders))foreach($sliders as $item){?>
                <div class="item">
                    <span><?php echo $item->name;?></span>
                </div>
                <?php } ?>
            </div>-->
        </div>
        <div class="banner-right-news hidden-xs">
            <div class="link-blog">
                <a href="/tin-tuc">
                    <h3><img style="max-width: 30px;" src="/public/userfiles/chat.png" width="64" height="64" alt="Thủ thuật chia sẻ"/>BÀI VIẾT - CHIA SẺ</h3>
                </a>
                <ul>
                    <?php if(isset($news_km))foreach($news_km as $item){?>
                    <li>
                        <a href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><?php echo $item->name;?></a>
                    </li>
                    <?php } ?>
                   
                </ul>
            </div>

           
        </div>
    </div>
</div>
<figure class="container banner-bottom">

</figure>
</div>

<!-- End banner -->
<div class="product_cat_top">
	<?php
		$product_cat_top = $this->MCommon->getAllRowByWhere_lang($lang,'product_cat',['parent_id'=>0],null,"orders ASC");
		if($product_cat_top)foreach($product_cat_top as $cat){
	?>
		<a href="/san-pham/<?php echo $cat->slug;?>.html" class="product_cat_top_item">
			<div class="icon-cat-home"><img src="<?php echo thumb($cat->image,'16x16');?>" alt="cat product icon"></div>
			<span><?php echo $cat->name;?></span>
		</a>
	<?php } ?>
</div>