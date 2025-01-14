<?php if(isset($ads_tops)) foreach ($ads_tops as $ads_top){?>
    <section class="awe-section-<?php echo $ads_top->id;?>">
        <div class="container">
            <?php echo $ads_top->content;?>
        </div>
    </section>
<?php } ?>
