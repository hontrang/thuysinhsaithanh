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
                    <div class="content-item row">
                        <div class="col-md-12 content-text">
                            <div class="bold">
                                <?php echo $info->des;?>
                            </div>

                           <?php echo $info->content;?>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-lg-4 sidebar">
                <div class="cr_title_green_main">
                    <div style="padding-top: 7px;">
                        <div class="cr_title_green cr_title_green_main_text"><h2><?php echo $this->lang->line('csvc');?></h2></div>
                        <div class="cr_title_triangle"></div>
                    </div>
                </div>
                <div class="list-item row">
                    <?php if(isset($list))foreach ($list as $item){ ?>
                        <div class="col-sm-12 hvr-forward">
                            <a href="<?php echo site_url('co-so-vat-chat/'.$item->slug);?>" title="<?php echo $item->name;?>"> <img class="menu-icon" src="/public/userfiles/logo-icon.png" /> <span><?php echo $item->name;?></span> </a>
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
    </div>

    <div class="container">

        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7835.790629560667!2d106.8625074!3d10.89556!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174df09b0c11a13%3A0x9a4584805ec15951!2zQuG7h25oIFZp4buHbiDEkOG6oWkgaOG7jWMgWSBExrDhu6NjIFNoaW5nbWFyayDEkOG7k25nIE5haQ!5e0!3m2!1svi!2s!4v1515607066288" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>

    </div>
</section>