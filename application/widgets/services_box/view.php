
<?php if(isset($services_list))foreach ($services_list as $item){ ?>
    <div class="service-item service-item-two">
        <div class="item-top">
            <span class="img">
                <img src="/public/templates/user/default/images/loader.svg" data-lazyload="<?php echo base_url('public/small/'.$item->image);?>" alt="<?php echo $item->name;?>" />
            </span>
            <span class="title">
                <?php echo $item->name;?>
            </span>
        </div>
        <p class="caption">
            <?php echo $item->des;?>
        </p>
    </div>
<?php } ?>