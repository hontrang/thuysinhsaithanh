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

                <div class="list-product list_page thuonghieu">


                <?php
                        if(isset($list))foreach($list as $item){
                           
                    ?>
                        <div class="p-item">
                            
                            <a href="/thuong-hieu/<?php echo $item->slug;?>.html" class="p-img">
                                <img src="<?php echo thumb($item->image);?>" alt="<?php echo $item->name;?>">
                                </a>
                            <a href="/thuong-hieu/<?php echo $item->slug;?>.html" class="p-name"><?php echo $item->name;?></a>
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