<div class="featured-box featured-box-primary align-left margin-top-0">
    <div class="box-content padding-15 bds-noibat">
        <h4 class="heading-primary text-uppercase mb-md">Nổi bật</h4>
        <ul class="simple-post-list">
            <?php if(isset($supervip))foreach ($supervip as $item){ ?>
            <li>
                <div class="post-image">
                    <div class="img-thumbnail">
                        <a href="/dat-nen/<?php echo create_slug($item->title);?>-<?php echo $item->id;?>.html">
                            <img class="img-responsive" src="<?php echo base_url('public/userfiles/'.$item->default_image);?>" alt="<?php echo $item->title;?>">
                        </a>
                    </div>
                </div>
                <div class="post-info">
                    <a href="/dat-nen/<?php echo create_slug($item->title);?>-<?php echo $item->id;?>.html"><?php echo max_len($item->title,65);?></a>
                    
                </div>
            </li>
            <?php } ?>

        </ul>
    </div>
</div>