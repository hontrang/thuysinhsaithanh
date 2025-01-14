<?php

echo $this->load->widget('breadcrumb');
?>
<style>
	#productFormFilter .pro-sort input {
		visibility: hidden;
		width: 0;
		height: 0;
	}
</style>

<div class="banner-product container">
    <div class="row">

    </div>
</div>
			
<form id="productFormFilter">
<input type="hidden" name="cat" value="" id="cat_id" />
<input type="hidden" name="cats" value="" id="cats_id" />
<input type="hidden" name="is_hot" value="<?php if(isset($is_hot))echo $is_hot;?>" id="is_hot" />
	
<div class="container">
    <div class="row">
        
        <div class="col-md-9 pull-right-mobile">
            <div class="section-product product-list">
                <div class="sort">
                    <span>Xếp theo:</span>
                    <ul class="pro-sort">
                        <li>
							<input type="radio" id="sortid-desc" name="sort" value="orders-desc" checked="checked">
                            <a href="javascript:;" class="sortCheck checked" data-type="sort" data-value="orders-desc"><span>Mới nhất</span></a>
                        </li>
                        <li>
							<input type="radio" id="sortprice-asc" name="sort" value="price-asc">
                            <a href="javascript:;" class="sortCheck" data-type="sort" data-value="price-asc"><span>Giá tăng dần</span></a>
                        </li>
                        <li>
							<input type="radio" id="sortprice-desc" name="sort" value="price-desc">
                            <a href="javascript:;" class="sortCheck" data-type="sort" data-value="price-desc"><span>Giá giảm dần</span></a>
                        </li>
                    </ul>
                    
                    

                </div>
                <div class="list-product list_page">


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
										<img src="<?php echo thumb($item->image,'400x300',1);?>" alt="<?php echo $item->name;?>">
									
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

                    <?php if(isset($pagination_link) and $pagination_link != ""){?>
                    <div class="load-more text-center">
                        <input type="hidden" name="page" value="1" id="current_page" />
                        <a href="javascript:;" onclick="show_more_product(2)">Xem thêm<i class="fas fa-sort-down"></i></a>
                    </div>
                    <?php } ?>


                </div>

                
            </div>
        </div>
		
		<div class="col-md-3 sidebar-col">
            <div class="sidebar-product">
                <?php
					echo $this->load->widget('product_cat_box');
				?>
                
				<div class="column_left">

                    <!-- bộ lọc
                    <div class="filter_box ">
                        <span class="filter_title">THƯƠNG HIỆU </span>
                        <ul class="filter_list">
                            <?php if(isset($brands))foreach($brands as $item){?>
                            <li>
								<input type="checkbox" id="brand<?php echo $item->id;?>" name="brand[]" value="<?php echo $item->id;?>" <?php if(isset($brand) and $brand->id == $item->id)echo 'checked="checked"';?>>
                                <a class="filterCheck <?php if(isset($brand) and $brand->id == $item->id)echo 'checked';?>" data-type="brand" data-value="<?php echo $item->id;?>" href="javascript:;"> <?php echo $item->name;?></a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>


                    <!-- bộ lọc -->

                    <?php if(isset($properties))foreach($properties as $item){?>
                    <div class="filter_box">
                        <span class="filter_title"><?php echo $item->properties_name;?></span>
                        <ul class="filter_list str_replace">
                            <?php
                                $listValue = $this->MCommon->getValueByProperties($item->properties_id);
                                if($listValue)foreach($listValue as $value){
                                    $rand = rand(1000,9999999).time();
                            ?>
                            <li class="filter_list_item">
								<input type="checkbox" id="filter<?php echo $rand;?>" name="filter[]" value="<?php echo $value->product_properties_id;?>-<?php echo $value->product_properties_value;?>">
                                <a class="filterCheck" data-type="filter" data-value="<?php echo $rand;?>" href="javascript:;"><?php echo $value->product_properties_value;?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php } ?>
                     
                </div>
				<hr>
				<div class="left_q" style="display: none;">
					<?php if(isset($ads_left))foreach($ads_left as $item){?>
					<div class="left_q_item">
						<?php echo $item->content;?>
					</div>
					<?php } ?>
				</div>
				
				<div class="product_hot">
					<div class="p-title">
						<h3>Bán chạy</h3>
					</div>
					<div class="p-body">
						<?php if(isset($product_hot))foreach($product_hot as $item){?>
						<div class="p-item">
							<div class="p-image"><a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" title="<?php echo $item->name;?>"><img alt="<?php echo $item->name;?>" src="<?php echo thumb($item->image,'100x100',2);?>" class="img-fluid" /></a></div>
							<div class="p-detail">
								<div class="p-name"><a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" title="<?php echo $item->name;?>"><?php echo $item->name;?></a></div>
								<div class="p-price"><div><?php echo number_format($item->price);?> VNĐ</div><?php if($item->price_old > 0){?><div class="old-price"><?php echo number_format($item->price_old);?> VNĐ</div><?php } ?></div>
							</div>
							
						</div>
						<?php } ?>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

</form>