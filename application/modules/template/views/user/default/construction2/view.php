<?php
echo $this->load->widget('breadcrumb_box');
?>

<div class="container tour-info">
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <div class="row">
                <h2 class="title-index"><span><?php echo $title;?></span></h2>
                <div class="col-md-12 margin-bottom-10">

                    <div id="product_images" class="royalSlider rsDefault">
                        <a class="rsImg bugaga" data-rsBigImg="<?php echo base_url('public/userfiles/'.$info->image);?>" href="<?php echo base_url('public/userfiles/'.$info->image);?>"><img width="96" height="72" class="rsTmb" src="<?php echo base_url('public/small/'.$info->image);?>" /></a>
                        <?php if(isset($images))foreach ($images as $image){ ?>
                            <a class="rsImg bugaga" data-rsBigImg="<?php echo base_url('public/userfiles/'.$image->image);?>" href="<?php echo base_url('public/userfiles/'.$image->image);?>"><img width="96" height="72" class="rsTmb" src="<?php echo base_url('public/small/'.$image->image);?>" /></a>
                        <?php }?>
                    </div>

                </div>
            </div>
            <div class="row margin-top-20">
                <div class="col-xs-12 col-md-12">
                    <h2 class="title-detail"><span><?php echo $this->lang->line('detail');?></span></h2>
                    <div class="info-detail">
                        <?php echo $info->detail;?>
                    </div>
                </div>
            </div>

            

        </div>
        <div class="col-xs-12 col-md-3">
            <div class="heading heading-border heading-bottom-border info-box">
                <h4 class="title-box"><span><?php echo $this->lang->line('cat');?></span></h4>
                <ul class="sub-cat main-sub">
                    <?php if(isset($cats))foreach ($cats as $cat){
                        ?>
                        <li class="<?php if($current_parent_id == $cat->id)echo "active";?>">
                            <a title="Bàn ghế" href="/cong-trinh/<?php echo $cat->slug;?>.html"><?php echo $cat->name;?></a>
                            <ul class="sub">
                                <?php if(isset($cat->sub))foreach ($cat->sub as $sub){ ?>
                                    <li class="<?php if($current_slug == $sub->slug)echo "active";?>">
                                        <a title="Bàn sofa" href="/cong-trinh/<?php echo $sub->slug;?>.html"><?php echo $sub->name;?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>

        </div>
    </div>




</div>


