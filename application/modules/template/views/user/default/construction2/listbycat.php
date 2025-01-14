<?php
echo $this->load->widget('breadcrumb_box');
?>
<style>
div.wrap-div-topSpacer {
		width: 0px;
		height: 60px;
		float: left;
	}
	div.wrap-div {
		float: left;
		clear: both;
		margin: 0px 10px 0 0;
		height: 80px;
		width: 25%;
		text-align: center;
		background: #0088cc;
		color: #FFF;
	}
	div.wrap-div-right {
		float: right;
		width: 50%;
	}
</style>
<div class="container">
	
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-xs-12 col-md-9">
                    <h2 class="title-index"><span><?php echo $title;?></span></h2>
					<?php if($cat->description != '' and $cat->description != null){ ?>
					<div class="row news-box-view">
						<div class="col-md-12 news-box-view margin-bottom-10">
							<div class="col-md-12">
								<div class="row box">
									<div class="col-md-5">
										<img src="<?php echo base_url('public/small/'.$cat->image);?>" class="img-responsive" alt="<?php echo $cat->name;?>" />
									</div>
								
									<div class="col-md-7 text-justify">
										<a href="tel:<?php echo $site_config['phone'];?>">
											<div class="box-hotline">
												<div class="icon-phone">
													<img data-wow-duration="1.5s" data-wow-iteration="infinite" class="wow tada" src="data:image/png;base64,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">
												</div>
												<div class="hotline-text">Hỗ trợ đặt hàng, tư vấn</div>
												<div class="hotline-phone"><?php echo $site_config['phone'];?></div>
											</div>
										</a>
										<?php echo $cat->description;?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
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
                                                <a class="button-cart" title="<?php echo $item->name;?>"  href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><i class="fa fa-eye"></i> Chi tiết</a>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <h3 class="title-item"><a title="<?php echo $item->name;?>" href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><?php echo $item->name;?></a></h3>
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
                                <a title="Bàn ghế" href="/san-pham/<?php echo $cat->slug;?>.html"><?php echo $cat->name;?></a>
                                <ul class="sub">
                                    <?php if(isset($cat->sub))foreach ($cat->sub as $sub){ ?>
                                        <li class="<?php if($current_slug == $sub->slug)echo "active";?>">
                                            <a title="Bàn sofa" href="/san-pham/<?php echo $sub->slug;?>.html"><?php echo $sub->name;?></a>
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