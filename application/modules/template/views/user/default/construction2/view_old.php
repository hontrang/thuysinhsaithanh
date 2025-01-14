<section class="page-header">
    <div>
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url();?>">Home</a></li>
                    <?php if(!empty($breadcrumb)) {
                        foreach ($breadcrumb as $title_br => $link_br) {
                            if($link_br != ""){
                                ?>
                                <li><a href="<?php echo site_url($link_br);?>"><?php echo $title_br;?></a></li>
                            <?php }else{ ?>
                                <li class="active"><?php echo $title_br;?></li>
                            <?php } } } ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container tour-info">
    <div class="row tour-backgroud">

    </div>
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <div class="row">
                <div class="col-md-6 margin-bottom-10">

                    <div id="product_images" class="royalSlider rsDefault">
                        <a class="rsImg bugaga" data-rsBigImg="<?php echo base_url('public/userfiles/'.$info->image);?>" href="<?php echo base_url('public/userfiles/'.$info->image);?>"><img width="96" height="72" class="rsTmb" src="<?php echo base_url('public/userfiles/'.$info->image);?>" /></a>
                        <?php if(isset($images))foreach ($images as $image){ ?>
                            <a class="rsImg bugaga" data-rsBigImg="<?php echo base_url('public/userfiles/'.$image->image);?>" href="<?php echo base_url('public/userfiles/'.$image->image);?>"><img width="96" height="72" class="rsTmb" src="<?php echo base_url('public/userfiles/'.$image->image);?>" /></a>
                        <?php }?>
                    </div>

                </div>
                <div class="col-md-6">
                    <h1 class="title-view"><?php echo $info->name;?></h1>
                    <?php if($info->price_discount >= $info->price){ ?>
                    <div><span class="product-view-label">Price:</span> <span class="price">$<?php echo number_format($info->price_discount);?></span></div>
                    <?php }else{
                        $price_save = $info->price - $info->price_discount;
                        $price_save_per = round($price_save/($info->price/100));
                        ?>
                        <div class="margin-bottom-10"><span class="product-view-label">Price:</span> <span class="price_old">$<?php echo number_format($info->price);?></span> <span class="price product-view-price">$<?php echo number_format($info->price_discount);?></span></div>
                        <div class="margin-bottom-10"><span class="product-view-label">Save:</span> $<?php echo number_format($price_save);?> (<?php echo $price_save_per;?>%)</div>

                    <?php } ?>
                    <hr>
                    <div class="margin-bottom-10">
                        <a class="button-cart" title="Add to Cart" href="/cart/<?php echo $info->slug;?>-<?php echo $info->id;?>"><i class="fa fa-cart-plus"></i> Add to Cart</a>
                    </div>

                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-xs-12">
                    <h2 class="title-detail"><span>Detail</span></h2>
                    <div class="info-detail">
                        <?php echo $info->detail;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="heading heading-border heading-bottom-border info-box">
                <h2 class="title-detail"><span>Related Products</span></h2>
                <?php if(isset($cat_relevant))foreach ($cat_relevant as $cat_relevant_item){ ?>
                    <div class="col-xs-6 col-md-12 relevant-item">
                        <div><a href="/product/<?php echo $cat_relevant_item->slug;?>-<?php echo $cat_relevant_item->id;?>.html"><img alt="<?php echo $cat_relevant_item->name;?>" src="<?php echo base_url('public/userfiles/'.$cat_relevant_item->image);?>" class="img-responsive"></a></div>
                        <div><a class="bold text-black" href="/product/<?php echo $cat_relevant_item->slug;?>-<?php echo $cat_relevant_item->id;?>.html"><?php echo max_len($cat_relevant_item->name,80);?></a></div>
                    </div>
                <?php }else{ ?>
                    <div>Updating...</div>
                <?php } ?>
            </div>

        </div>
    </div>


</div>


