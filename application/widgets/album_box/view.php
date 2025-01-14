<div class="cr_title_green_main">
    <div style="padding-top: 7px;">
        <div class="cr_title_green cr_title_green_main_text"><h2><?php echo $this->lang->line('album');?></h2></div>
        <div class="cr_title_triangle"></div>
    </div>
</div>
<div class="home-album news-item">
    <?php if(isset($albums))foreach ($albums as $album){ ?>
        <div class="col-sm-6 col-xs-6 text-center hvr-bounce-in album-item">
            <a href="<?php echo site_url('album/'.$album->slug.'-'.$album->id);?>">
                <div class="col-md-12 img-box">
                    <img class="scale" alt="<?php echo $album->name;?>" src="<?php echo base_url('public/small/'.$album->image);?>">
                </div>
            </a>
            <div class="col-md-12">
                <a href="<?php echo site_url('album/'.$album->slug.'-'.$album->id);?>"><h5><?php echo $album->name;?></h5></a>
                 
            </div>
        </div>
    <?php } ?>

</div>