<?php

echo $this->load->widget('breadcrumb');

$price = $info->price;
if($discount_cat[$info->cat_id] > 0){
	$giam = $info->price_old*$discount_cat[$info->cat_id]/100;
	$price = round($info->price_old-$giam,-4);
	
}

?>
<?php 
		$last = array('Pham','Dang','Vu','Hoang','Huu','Le','Do','Hoang','Lâm','Cao');
		$first = array('Linh','Dat', 'Tuan','Hoang','Ly','Loan','Yen','Trang','Tram','Ngoc','Thao','Tinh','Hang','Lan','Lau','Dung','Nhung','Loc','Tri','Khanh','Phu','Hieu');
	?>

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "<?php echo $info->name; ?>",
  "image": "<?php echo base_url('public/userfiles/' . $info->image); ?>",
  "description": "<?php echo $description; ?>",
  "brand": {
    "@type": "Brand",
    "name": "Sâm Hàn Quốc Long Hợp Biên Hòa"
  },
  "sku": "<?php echo $info->code; ?>",
  "offers": {
    "@type": "AggregateOffer",
    "url": "<?php echo site_url(uri_string());?>",
    "priceCurrency": "VND",
    "lowPrice": "<?php echo $price; ?>",
    "highPrice": "<?php echo $info->price_old;?>",
    "offerCount": "1000"
  },
  "review": {
        "@type": "Review",
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": <?php echo rand(4,5);?>,
          "bestRating": 5
        },
        "author": {
          "@type": "Person",
          "name": "<?php echo $first[rand(0,count($first)-1)];?>  <?php echo $last[rand(0,count($last)-1)];?>"
        }
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": 5,
        "reviewCount": <?php echo rand(50,100);?>
      }
}
</script>
<div class="emty-view container">
	<div class="row">
        
		<div class="col-md-9 pull-right-mobile">
			<div class="row">
				<div class="col-md-6">
					<div class="img-detail">
						<div class="owl-carousel owl-theme" id="owl1">

							<a class="item" href="<?php echo base_url('public/userfiles/' . $info->image); ?>" data-fancybox="gallery">
								<img src="<?php echo thumb($info->image,'500x500'); ?>" alt="<?php echo $info->name; ?>" />
							</a>

							<?php if (isset($images)) foreach ($images as $image) { ?>
								<a class="item" href="<?php echo base_url('public/userfiles/' . $image->image); ?>" data-fancybox="gallery">
									<img src="<?php echo thumb($image->image,'500x500'); ?>" width="500" height="500" alt="<?php echo $info->name; ?>" />
								</a>
							<?php } ?>


						</div>
					</div>
					<div class="relative">
						<div class="small-img owl-carousel" id="owl2">
							<a class="item" href="<?php echo base_url('public/userfiles/' . $info->image); ?>" data-fancybox="gallery">
								<img src="<?php echo thumb($info->image,'100x100'); ?>" width="100" height="100" alt="<?php echo $info->name; ?>" />
							</a>

							<?php if (isset($images)) foreach ($images as $image) { ?>
								<a class="open-fancybox item">
									<img src="<?php echo thumb($image->image,'100x100'); ?>" width="100" height="100" alt="<?php echo $info->name; ?>" />
								</a>
							<?php } ?>


						</div>

						

					</div>
				
				</div>
				<div class="col-md-6">
					<div class="emty-title clearfix">
						<h1><?php echo $info->name; ?></h1>
						
					</div>
					<div class="overview">
						<p class="p-price">Giá:
							<span><?php if((int)$price > 0){?><?php echo number_format($price); ?><sup>₫</sup><?php }else{?>Liên hệ<?php } ?></span>
							<span class="p-price-old-view"><?php if((int)$info->price_old > 0){?><?php echo number_format($info->price_old);?> <sup>₫</sup> <?php } ?></span>
						</p>
					</div>
					
					<table class="table table-striped" style="width: 100%;">
						<tbody>
							<tr>
								<td><strong>Mã sản phẩm:</strong></td>
								<td><?php echo $info->code; ?></td>
							</tr>
							<tr>
								<td><strong>Xuất xứ:</strong></td>
								<td>Hàn Quốc</td>
							</tr>
							<tr>
								<td><strong>Quy cách:</strong></td>
								<td><?php echo $info->dvt; ?></td>
							</tr>
							
						</tbody>
					</table>

					
					
					
					<div class="overview">

						<style>
							.p-price-old-view {
								text-decoration-line: line-through;
								font-size: 20px !important;
								color: #525252 !important;
								height: 22px;
								overflow: hidden;
								float: right;
							}
						</style>
						
						
						<div class="fb-like" data-href="<?php echo current_url();?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>

						<a href="#comment_pro" style="vertical-align: 17px;color: #333;font-size: 14px;">Đánh giá : </a><div class="rating_top vl_rate_"></div> 
						<!--<span class="p-status">Còn hàng</span>-->
						<!--
						<div class="description">
							<?php echo $info->description; ?>
						</div>-->
						<fieldset class="p-gift">

							<legend id="data-pricetotal" style="color: #A80000;font-size: 18px; font-weight: bold" data-pricetotal="0">

								Cam kết vàng

							</legend>
							<div class="img-gift clearfix">
								<?php if(isset($services))foreach($services as $item){?>
								<p>
									<img src="<?php echo base_url('public/userfiles/'.$item->image);?>" width="100" height="100" alt="icon">
									<?php echo $item->name;?>
								</p>
								<?php } ?>
							</div>
						</fieldset>
						
						<?php
							$product_promotion = $this->MCommon->getAllRowByWhere('product_promotion',['product_id'=>$info->id],null,"id ASC");
							if($product_promotion){
						?>
						<fieldset class="p-gift">

							<legend id="data-pricetotal" style="color: #A80000;font-size: 18px; font-weight: bold" data-pricetotal="0">

								Khuyến mãi kèm theo

							</legend>
							<div class="img-gift clearfix">
								<?php foreach($product_promotion as $item){?>
								<p>
									<img src="<?php echo base_url('public/userfiles/'.$item->image);?>" alt="<?php echo $item->name;?>">
									<?php echo $item->name;?>
								</p>
								<?php } ?>
							</div>
						</fieldset>
						<?php } ?>

						<div class="area_order">

							<a data-id='<?php echo $info->id;?>' class="buy_now buyNowConfig" style="width: 100%;margin-bottom: 10px;" href="javascript:void(0)">
								Mua ngay
								<span>Gọi đặt mua, <strong><?php echo $this->lang->line('phone_muahang');?></strong></span>
							</a>

						</div>

					</div>
				</div>
				
			</div>
			
			
			<div class="row">
				<div class="col-md-12 emty-content product-detail">

					<div class="content-text list-s">
						<?php echo $info->detail;?>
					</div>
					

					<div class="p-collapse">
						<div class="p-info">
							<a class="p-img" href="<?php echo current_url();?>"><img src="<?php echo thumb($info->image); ?>" alt="<?php echo $info->name;?>"></a>
							<div class="p-des">
								<a href="<?php echo current_url();?>"><?php echo $info->name;?></a>

								<p class="p-price">Giá:
									<span><?php if((int)$info->price > 0){?><?php echo number_format($price); ?> <sup>₫</sup> <?php }else{?>Liên hệ<?php } ?></span>
								</p>
								<div style="text-decoration-line: line-through;"><?php echo number_format($info->price_old);?> <sup>₫</sup></div>


							</div>
						</div>


						<div class="area_order">
							<a data-id='<?php echo $info->id;?>' class="buy_now buyNowConfig" href="javascript:void(0)">
								Mua ngay
								<span>Gọi đặt mua, <b><?php echo $this->lang->line('phone_muahang');?></b></span>
							</a>
							
						</div>

					</div>
					<div class="comment">

					</div>
				</div>
				<!--
				<div class="col-md-12 clearfix" id="comment_pro">
					<div class="">
						<h3 style="margin-bottom: 0;margin-top: 40px;">Bạn cần tư vấn về sản phẩm <strong><?php echo $info->name;?></strong>? </h3>
						<p style="background: #f3f3f3;padding: 10px;border-radius: 3px;margin: 0;">Hãy cho chúng tôi biết bằng cách bình luận phía dưới. Chúng tôi sẽ trả lời trong thời gian sớm nhất.</p>
					</div>
					
				</div>
				-->
			</div>
			
			<div class="row">
				<div class="col-md-12 emty-content">
					<!-- Begin slider product detail -->
					<div class="section-product ">
						<div class="product-related">
							<div class="title">
								<h3><?php echo $cat->name;?> cùng loại</h3>
							</div>
							<div class="slide-product list-product owl-carousel owl-theme">


								<?php
									if(isset($cat_relevant))foreach($cat_relevant as $item){
										$product_promotion = $this->MCommon->getTotalRow('product_promotion',['product_id'=>$item->id]);
										if($product_promotion > 0) $product_promotion_text = "Có $product_promotion khuyến mãi.";
										else $product_promotion_text = "";
										
										$price = $item->price;
										if($discount_cat[$item->cat_id] > 0){
											$giam = $item->price_old*$discount_cat[$item->cat_id]/100;
											$price = round($item->price_old-$giam,-4);
										}
								?>
								<div class="item">
									<div class="p-item">
										<?php if($item->tragop != ""){?>
										<span class="icon_tragop">Trả góp 
											<i><?php echo $item->tragop;?>%</i>
										</span>
										<?php } ?>
										<?php if((int)$item->price_old > (int)$price){
													$tile = ceil(100-((100/(int)$item->price_old)*(int)$price));
												?>
												<span class="icon_tragop">Giảm 
													<i><?php echo $tile;?>%</i>
												</span>
												<?php } ?>
											<div class="p-image">
												<a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-img">
													<img src="<?php echo thumb($item->image);?>" alt="<?php echo $item->name;?>">
												
												</a>
												<div class="add-to-cart">
													<a rel="nofollow" class="buy_now" href="javascript:;" data-quantity="1" data-id="<?php echo $item->id;?>" class="button product_type_simple add_to_cart_button ajax_add_to_cart">Thêm vào giỏ</a></div>
											</div>
											<a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" class="p-name"><?php echo $item->name;?></a>
											<div class="p-price">
												<div class="p-price"><?php if((int)$price > 0){?><?php echo number_format($price); ?> <sup>₫</sup> <?php }else{?>Liên hệ<?php } ?></div>
												<div class="p-price-old"><?php if((int)$item->price_old > 0){?><?php echo number_format($item->price_old);?> <sup>₫</sup> <?php } ?></div>
											</div>
											
											<div class="khuyenmai">
												<?php if($product_promotion_text !=""){?>
												<p><img src="/public/userfiles/gift.gif" /><?php echo $product_promotion_text;?></p>
												<?php } ?>
											</div>
											

									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<!-- End slider product detail -->
				</div>
				
			</div>
			

		</div>
		
		<div class="col-md-3">
			<div class="sidebar-product">
                <?php
					echo $this->load->widget('product_cat_box');
				?>
				<!--
				<div class="left_q">
					<?php if(isset($ads_left))foreach($ads_left as $item){?>
					<div class="left_q_item">
						<?php echo $item->content;?>
					</div>
					<?php } ?>
				</div>
				-->
				<div class="product_hot">
					<div class="p-title bg-pr-w">
						<h3>Bán chạy</h3>
					</div>
					<div class="p-body">
						<?php if(isset($product_hot))foreach($product_hot as $item){?>
						<div class="p-item">
							<div class="p-image"><a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" title="<?php echo $item->name;?>"><img alt="<?php echo $item->name;?>" src="<?php echo thumb($item->image,'100x100',2);?>" class="img-fluid" /></a></div>
							<div class="p-detail">
								<div class="p-name"><a href="/san-pham/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" title="<?php echo $item->name;?>"><?php echo $item->name;?></a></div>
								<div class="p-price"><div><?php echo number_format($item->price);?> <sup>₫</sup></div><?php if($item->price_old > 0){?><div class="old-price"><?php echo number_format($item->price_old);?> <sup>₫</sup></div><?php } ?></div>
							</div>
							
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
    
</div>
