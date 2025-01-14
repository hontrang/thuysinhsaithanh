
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

			
<form id="productFormFilter">
<div class="container">
    <div class="row">
        
        <div class="col-md-12">
			
            <div class="section-product product-list">
                <div class="sort">
                    <span>Xếp theo:</span>
                    <ul class="pro-sort">
                        <li>
							<input type="radio" id="sortid-desc" name="sort" value="id-desc" checked="checked">
                            <a href="javascript:;" class="sortCheck checked" data-type="sort" data-value="id-desc"><span>Mới nhất</span></a>
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
				<style>
				.title1{
					background-color: #fb0303;
					color: #fff;
					padding-left: 10px;
				}
				</style>
				<div class="title1">
					<h1><?php echo $cat->name; ?></h1>
				</div>
				
                <div class="list-product list_page">
					

                <?php
                        if(isset($list))foreach($list as $item){
                            $product_promotion = $this->MCommon->getTotalRow('product_promotion',['product_id'=>$item->id]);
                            if($product_promotion > 0) $product_promotion_text = "Có $product_promotion khuyến mãi.";
                            else $product_promotion_text = "";
                    ?>
                    
                        <div class="p-item">
                            <?php if($item->tragop != ""){?>
                            <span class="icon_tragop">Trả góp 
                                <i><?php echo $item->tragop;?>%</i>
                            </span>
                            <?php } ?>
                            <a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-img">
                                <img src="<?php echo thumb($item->image,'400x300',1);?>" alt="<?php echo $item->name;?>">
                                </a>
                                <a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-name"><?php echo $item->name;?></a>
                                <div class="p-price">
                                    <div class="p-price"><?php if((int)$item->price_old > 0){?><?php echo number_format($item->price); ?> <sup>₫</sup> <?php }else{?>Liên hệ<?php } ?></div>
                                    <div class="p-price-old"><?php if((int)$item->price_old > 0){?><?php echo number_format($item->price_old);?> <sup>₫</sup> <?php } ?></div>
                                </div>
                                
                                <div class="khuyenmai" style="display: none;">
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
    </div>
</div>

</form>
