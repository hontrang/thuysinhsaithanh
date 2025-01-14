<?php
echo $this->load->widget('breadcrumb_box');
?>
<div class="container">

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo $this->load->widget('bds_cat_box');
                    ?>
                </div>
                <div class="col-md-12">
                    <?php
                    echo $this->load->widget('supervip_box');
                    ?>
                </div>

            </div>


        </div>

        <div class="col-md-9">
            <div class="blog-posts">
                <?php if(isset($list))foreach ($list as $item){ 
					$vip_icon = "";
					$vip_color = "";
					if($item->vip_type == 3){
						$vip_icon = '<span class="label-svip"></span>';
						$vip_color = "super-vip";
					}
					if($item->vip_type == 2){
						$vip_icon = '<span class="label-vip"></span>';
						$vip_color = "vip";
					}
				?>
                <article class="post post-medium item-bds">
                    <div class="row">

                        <div class="col-md-5">
                            <div class="img-thumbnail">
									<img class="img-responsive fixsize" src="<?php echo base_url('public/small/'.$item->default_image);?>" alt="<?php echo $item->title;?>">
						
								</div>
                        </div>
                        <div class="col-md-7">
			
                            <div class="post-content">
                                <h4><a class="<?php echo $vip_color;?>" href="/bds/<?php echo create_slug($item->title);?>-<?php echo $item->id;?>.html"><?php echo $vip_icon;?> <?php echo $item->title;?></a></h4>
                                <div class="des"><?php echo max_len($item->detail,200);?></div>
                                <div class="detail">
									<div class="price">
										<strong>Giá:</strong> <span> <?php echo number_format($item->price); ?> VNĐ</span>
									</div>
									<div class="size">
										<strong>Diện tích:</strong> <span> <?php echo number_format($item->area); ?> m<sup>2</sup></span>
									</div>
									<div class="address">
										<strong>Vị trí:</strong> <span> <?php echo $item->ward_type;?> <?php echo $item->ward_name;?>, <?php echo $item->district_name;?>, <?php echo $item->province_name;?> </span>
									</div>
								</div>

                            </div>
                        </div>

                    </div>
                   

                </article>

                <?php } ?>
                <div class="pages">
                    <?php if(isset($pagination_link))echo $pagination_link;?>
                </div>

            </div>
        </div>


    </div>

</div>