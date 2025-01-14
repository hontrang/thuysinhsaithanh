<?php if(isset($product_news)){?>
<div class="similar-product">
    <div class="right-bestsell">
        <h2><a href="/san-pham.html" title="Sản phẩm mới ra mắt">Sản phẩm mới ra mắt</a></h2>
        <div class="list-bestsell">
            <?php foreach($product_news as $item){?>
            <div class="list-bestsell-item">
                <div class="thumbnail-container clearfix">
                    <div class="product-image">
                        <a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html">
                            <img class="img-responsive" src="/public/templates/user/default/images/loader.svg" data-lazyload="<?php echo base_url('public/small/'.$item->image);?>" alt="<?php echo $item->name;?>" />
                        </a>
                    </div>
                    <div class="product-meta">
                        <h3><a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" title="<?php echo $item->name;?>"><?php echo $item->name;?></a></h3>
                        <div class="bizweb-product-reviews-badge" data-id="<?php echo $item->id;?>"></div>
                        <div class="product-price-and-shipping">
                            <span class="price"><?php if($item->price > 0){echo number_format($item->price)." đ";}else{echo "Liên hệ";}?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>