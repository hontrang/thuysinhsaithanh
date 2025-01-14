<?php
echo $this->load->widget('breadcrumb_box');
?>

<div class="container">

    <div class="row margin-bottom-50">
        <div class="col-md-xs-12 col-md-12">
           
			
			<ul class="nav nav-pills sort-source cat_album" data-sort-id="portfolio" data-option-key="filter" data-plugin-options="{'layoutMode': 'fitRows', 'filter': '*'}">
				<li data-option-value="*" class="active"><a href="#">Tất cả</a></li>
				<?php if(isset($cats))foreach($cats as $cat){?>
				<li data-option-value=".cat-<?php echo $cat->id;?>"><a href="#"><?php echo $cat->name;?></a></li>
				<?php } ?>
				
			</ul>

			
             <div class="row">
				<div class="sort-destination-loader sort-destination-loader-showing">
					<ul class="portfolio-list sort-destination" data-sort-id="portfolio">
					<?php if(isset($list))foreach ($list as $item){ ?>
						<li class="col-md-4 isotope-item cat-<?php echo $item->cat_id;?> item-album">
							<div class="portfolio-item">
								<a href="/du-an/<?php echo $item->slug;?>-<?php echo $item->id;?>.html">
									<span class="thumb-info thumb-info-lighten">
										<span class="thumb-info-wrapper">
											<div class="img-box">
												<img src="<?php echo base_url('public/small/'.$item->image);?>" class="img-responsive fixsize" alt="<?php echo $item->name;?>">
											</div>
											<span class="thumb-info-title">
												<span class="thumb-info-inner"><?php echo $item->name;?></span>
											</span>
											<span class="thumb-info-action">
												<span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
											</span>
										</span>
									</span>
								</a>
							</div>
						</li>

					<?php }?>
					</ul>
				</div>
                    
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <?php if(isset($pagination_link))echo $pagination_link;?>
        </div>

    </div>
</div>








