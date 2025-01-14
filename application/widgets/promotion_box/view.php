<div id="Separator_D8llLaVW" class="tb_wt tb_wt_separator tb_mb_5 display-block text-left">
    <div class="tb_separator"><span class="tb_title"> Khuyến mãi hôm nay <span class="tb_position_left border" style="margin-top: -0px;border-bottom-width: 0px;"></span> <span class="tb_position_right border" style="margin-top: -0px;border-bottom-width: 0px;"></span> </span></div>
</div>
<div id="FeaturedProducts_TRX96yRd" class="tb_wt tb_wt_featured_products display-block no_title has_slider tb_side_nav">
    <div class="panel-body">
        <div class="tb_products tb_listing tb_grid_view tb_style_bordered tb_product_p_20 tb_exclude_thumb tb_buttons_1 tb_buttons_config">
            <?php if(isset($promos))foreach ($promos as $item){?>
            <div class="product-layout"><input class="product-id_<?php echo $item->id;?>" type="hidden" value=""/>
                <div class="product-thumb">
                    <div class="image"><a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><span style="max-width: 250px;"><span style="padding-top: 100%"><img  src="<?php echo base_url('public/userfiles/'.$item->image);?>" width="250" height="250" alt="<?php echo $item->name;?>" style="margin-top: -100%"/></span></span></a></div>
                    <div>
                        <div class="caption"><h4><a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><?php echo $item->name;?></a></h4>
                            <p class="price">
                                <?php if($item->price_old != 0){?><span class="price-old"><?php echo number_format($item->price_old);?><span class="tb_currency tb_after">đ</span></span> <?php } ?>
                                <?php if($item->price != 0){?><span class="price-new"><?php echo number_format($item->price);?> <span class="tb_currency tb_after">đ</span></span><?php } ?>
                                <?php if($item->price == 0){?><span class="price-new">Liên hệ</span><?php } ?>
                            </p>

                            <div class="rating">
                                <div class="tb_bar"><span class="tb_percent" style="width: <?php echo rand(90,100);?>%;"></span> <span class="tb_base"></span></div>
                                <span class="tb_average">5/5</span>
                            </div>
                        </div>
                    </div>
                    <!--<p class="tb_label_special">-14%</p>-->
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
</div>
