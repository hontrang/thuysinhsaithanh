<div class="similar-product">
    <div class="right-bestsell">
        <h2><a href="/san-pham.html" title="Sản phẩm mới ra mắt">Xem nhiều nhất</a></h2>
        <div class="list-bestsell">
                <?php if(isset($news_hots))foreach ($news_hots as $item){ ?>
                    <div class="list-bestsell-item">
                        <div class="thumbnail-container clearfix">
                            <div class="product-image">
                                <a href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html">
                                    <img class="img-responsive" src="/public/templates/user/default/images/loader.svg" data-lazyload="<?php echo base_url('public/small/'.$item->image);?>" alt="<?php echo $item->name;?>" />
                                </a>
                            </div>
                            <div class="product-meta">
                                <h3><a href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" title="<?php echo $item->name;?>"><?php echo $item->name;?></a></h3>
                            </div>
                        </div>
                    </div>
                <?php } ?>
        </div>
    </div>
</div>