<?php
echo $this->load->widget('breadcrumb_box');
?>
<div class="container">
	<?php if(isset($project_hot)){?>
	<div class="row duan-hot">
        <div class="col-md-4 info">
			<div class="title"><a href="/du-an/<?php echo $project_hot->slug;?>-<?php echo $project_hot->id;?>.html" title="<?php echo $project_hot->name;?>"><?php echo $project_hot->name;?></a></div>
			<div class="des"><?php echo max_len($project_hot->des,150);?></div>
			<a class="more" href="/du-an/<?php echo $project_hot->slug;?>-<?php echo $project_hot->id;?>.html" target="_self" title="<?php echo $project_hot->name;?>">Xem thêm <i class="fa fa-arrow-right"></i></a>
		</div>
        <div class="col-md-8 img">
			<img src="<?php echo base_url('public/userfiles/'.$project_hot->image);?>" alt="<?php echo $project_hot->name;?>" class="img-responsive" />
		</div>
	</div>
	<?php } ?>
    <div class="row">

        <div class="col-md-12">
            <div class="blog-posts row">
                <?php if(isset($list_item))foreach ($list_item as $item){ ?>
                    <div class="col-md-4">
                        <a href="/du-an/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" title="<?php echo $item->name;?>">
                        <span class="thumb-info thumb-info-hide-wrapper-bg">
                            <span class="thumb-info-wrapper">
                                <div class="img-box-dich-vu">
                                    <img src="<?php echo base_url('public/small/'.$item->image);?>" class="img-responsive fixsize" alt="<?php echo $item->name;?>">
                                </div>
                            </span>
                            <span class="thumb-info-caption">
                                <span class="thumb-info-caption-text">
                                    <h4 class="title"><?php echo $item->name;?></h4>
                                    <div class="sub_title"><?php echo $item->sub_name;?></div>
                                </span>

                            </span>
                        </span>
                        </a>
                    </div>

                <?php } ?>
                <div class="pages">
                    <?php if(isset($pagination_link))echo $pagination_link;?>
                </div>

            </div>
        </div>


    </div>

</div>