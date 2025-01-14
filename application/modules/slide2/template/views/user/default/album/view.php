

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
                    <div class="news-item row">
                        <?php if(isset($list_item)) foreach ($list_item as $item) {?>
                            <div class="col-sm-4 col-xs-6 ">
                                <a href="<?php echo base_url('public/userfiles/'.$item->image);?>" data-fancybox="group" data-caption="<?php echo $info->name;?>">
                                    <div class="col-md-12 img-box">
                                        <img class="scale" alt="<?php echo $info->name;?>" src="<?php echo base_url('public/small/'.$item->image);?>">
                                    </div>
                                </a>
                            </div>
                        <?php }?>
                    </div>


                </div>
            </div>
            <div class="col-lg-4 sidebar">
                <div class="cr_title_green_main">
                    <div style="padding-top: 7px;">
                        <div class="cr_title_green cr_title_green_main_text"><h2><?php echo $this->lang->line('album');?></h2></div>
                        <div class="cr_title_triangle"></div>
                    </div>
                </div>
                <div class="list-item row">
                    <?php if(isset($list))foreach ($list as $item){ ?>
                        <div class="col-sm-12 hvr-forward">
                            <a href="<?php echo site_url('album/'.$item->slug.'-'.$item->id);?>" title="<?php echo $item->name;?>"> <img class="menu-icon" src="/public/userfiles/logo-icon.png" /> <span><?php echo $item->name;?></span> </a>
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