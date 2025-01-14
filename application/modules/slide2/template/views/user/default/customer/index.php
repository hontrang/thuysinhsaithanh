
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <img class="img-responsive" src="<?php echo base_url('public/userfiles/'.$bannerimage);?>" title="<?php echo $title;?>" alt="<?php echo $title;?>" />
        </div>
    </div>
</div>



<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                echo $this->load->widget('breadcrumb_box');
                ?>
                <div class="content">
                    <div class="cr_title_green_main">
                        <div style="padding-top: 7px;">
                            <div class="cr_title_green cr_title_green_main_text"><h2><?php echo $title;?></h2></div>
                            <div class="cr_title_triangle"></div>
                        </div>
                    </div>
                    <div class="customer-item row">
                        <?php if(isset($list_item)) foreach ($list_item as $item) {?>
                            <div class="col-sm-12 col-xs-12">
                                <a href="<?php echo site_url('khach-hang/'.$item->slug.'-'.$item->id);?>">
                                    <div class="col-md-3 img-box">
                                        <img class="scale" alt="<?php echo $item->name;?>" src="<?php echo base_url('public/small/'.$item->image);?>">
                                    </div>
                                </a>
                                <div class="col-md-9">
                                    <a href="<?php echo site_url('khach-hang/'.$item->slug.'-'.$item->id);?>"><h5><?php echo $item->name;?></h5></a>
                                    <p style="text-align:justify;"><?php echo $item->des;?>
                                         </p>
                                </div>
                            </div>
                        <?php }?>
                    </div>


                </div>
            </div>
            <div class="col-lg-4 sidebar">
                <div class="cr_title_green_main">
                    <div style="padding-top: 7px;">
                        <div class="cr_title_green cr_title_green_main_text"><h2><?php echo $this->lang->line('customer');?></h2></div>
                        <div class="cr_title_triangle"></div>
                    </div>
                </div>
                <div class="list-item row">
                    <?php if(isset($menu_cats))foreach ($menu_cats as $item){ ?>
                        <div class="col-sm-12 hvr-forward">
                            <a href="<?php echo site_url('khach-hang/'.$item->slug);?>" title="<?php echo $item->name;?>"><img class="menu-icon" src="/public/userfiles/logo-icon.png" /> <span><?php echo $item->name;?></span> </a>
                        </div>
                    <?php } ?>
                </div>



                <?php
                echo $this->load->widget('tool_box');
                ?>

                <?php
                echo $this->load->widget('video_box');
                ?>

                <?php
                echo $this->load->widget('album_box');
                ?>


            </div>
        </div>
    </div>

</section>