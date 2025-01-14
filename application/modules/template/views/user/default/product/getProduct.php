<?php
    if(isset($list))foreach($list as $item){
        $product_promotion = $this->MCommon->getTotalRow('product_promotion',['product_id'=>$item->id]);
        if($product_promotion > 0) $product_promotion_text = "Có $product_promotion khuyến mãi.";
        else $product_promotion_text = "";
		$price = $item->price;
		if($discount_cat[$item->cat_id] > 0){
			$giam = $item->price_old*$discount_cat[$item->cat_id]/100;
			$price = round($item->price_old-$giam,-4);
		}
?>

    <div class="p-item item">
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
					<img src="<?php echo thumb($item->image);?>" alt="<?php echo $item->name;?>">
				
				</a>
				<div class="add-to-cart">
					<a rel="nofollow" class="buy_now" href="javascript:;" data-quantity="1" data-id="<?php echo $item->id;?>" class="button product_type_simple add_to_cart_button ajax_add_to_cart">Thêm vào giỏ</a></div>
			</div>
            <a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-name"><?php echo $item->name;?></a>
            <div class="p-price">
                <div class="p-price"><?php if((int)$price > 0){?><?php echo number_format($price); ?> VNĐ <?php }else{?>Liên hệ<?php } ?></div>
                <div class="p-price-old"><?php if((int)$item->price_old > 0){?><?php echo number_format($item->price_old);?> VNĐ <?php } ?></div>
            </div>
            
            <div class="khuyenmai">
                <?php if($product_promotion_text !=""){?>
                <p><img src="/public/userfiles/gift.gif" /><?php echo $product_promotion_text;?></p>
                <?php } ?>
            </div>
            

    </div>

<?php } ?>

<?php if(isset($show_page) and $show_page == 1){?>
<div class="load-more text-center">
	<input type="hidden" name="page" value="<?php echo $page;?>" id="current_page" />
    <a href="javascript:;" onclick="show_more_product(<?php echo $page+1;?>)">Xem thêm<i class="fas fa-sort-down"></i></a>
</div>
<?php } ?>