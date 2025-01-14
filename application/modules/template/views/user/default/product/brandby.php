<?php

echo $this->load->widget('breadcrumb');
?>


<div class="banner-product container">
    <div class="row">

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-product product-list">
            <!--    
                <div class="sort">
                    <span>Xếp theo:</span>
                    <ul class="pro-sort">
                        <li>
                            <a href="javascript:;" class="sortCheck" data-type="sort" data-value="id-desc"><span>Mới nhất</span></a>
                        </li>
                        <li>
                            <a href="javascript:;" class="sortCheck" data-type="sort" data-value="price-asc"><span>Giá tăng dần</span></a>
                        </li>
                        <li>
                            <a href="javascript:;" class="sortCheck" data-type="sort" data-value="price-desc"><span>Giá giảm dần</span></a>
                        </li>
                    </ul>
                    
                    

                </div>
                -->
                <div class="list-product list_page">


                <?php
                        if(isset($list))foreach($list as $item){
                            $product_promotion = $this->MCommon->getTotalRow('product_promotion',['product_id'=>$item->id]);
                            if($product_promotion > 0) $product_promotion_text = "Có $product_promotion khuyến mãi.";
                            else $product_promotion_text = "";
							
							$price = $item->price;
							if($discount_cat[$item->cat_id] > 0){
								$giam = $item->price_old*$discount_cat[$item->cat_id]/100;
								$price = $item->price_old-$giam;
							}
                    ?>
                    
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
							
                            <a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-img">
                                <img src="<?php echo thumb($item->image);?>" alt="<?php echo $item->name;?>">
                                </a>
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

                    
                    <div class="load-more text-center">
                    <?php if(isset($pagination_link)) echo $pagination_link;?>
                    </div>
                   


                </div>

                
            </div>
        </div>
    </div>
</div>