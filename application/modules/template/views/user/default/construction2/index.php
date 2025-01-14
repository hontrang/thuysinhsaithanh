<?php
echo $this->load->widget('breadcrumb_box');
?>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-xs-12 col-md-9">
                    <h2 class="title-index"><span><?php echo $title;?></span></h2>
                    <div class="main-border">
                        <div class="row row-item row-grid">
                            <?php if(isset($list))foreach ($list as $item){ ?>
                                <div class="grid-item col-item col-xs-12 col-sm-6 col-md-4">
                                    <?php if($item->is_hot == 1){?>
                                        <div class="ribbon"><span>Bán chạy</span></div>
                                    <?php } ?>
                                    <?php if($item->is_new == 1){?>
                                        <div class="new-product-icon"><img width="45px" src="/public/templates/user/default/images/new.png" /> </div>
                                    <?php } ?>
                                    <div class="product-grid">
                                        <div class="loop-img">
                                            <a title="<?php echo $item->name;?>" href="/cong-trinh/<?php echo $item->slug;?>-<?php echo $item->id;?>.html">
											<div class="loop-img">
												<img class="scale" src="<?php echo base_url('public/small/'.$item->image);?>" alt="<?php echo $item->name;?>" />
												</div>
											</a>								<div class="view_buy">
                                                <a class="button-cart" title="<?php echo $item->name;?>"  href="/cong-trinh/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><i class="fa fa-eye"></i> Chi tiết</a>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <h3 class="title-item"><a title="<?php echo $item->name;?>" href="/cong-trinh/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><?php echo $item->name;?></a></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="col-md-12">Đang cập nhật...</div>
                            <?php }?>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-3">
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
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php if(isset($pagination_link))echo $pagination_link;?>
                </div>

            </div>
        </div>

    </div>

</div>