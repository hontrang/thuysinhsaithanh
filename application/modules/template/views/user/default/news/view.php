
<?php

echo $this->load->widget('breadcrumb');
?>
<style>
	.content-post ul{
		list-style-type: disc;
		padding-left: 15px;
	}
	.news-content img{
	width: 100% !important;
	height: auto !important;
}

</style>
<div class="container">
  <div class="content-tab-pro blog-list">
      <div class="row">
          
			 <div class="col-lg-9 news-content">
					<h1><?php echo $title;?></h1>
					<hr>
				<?php echo $info->detail;?>
				<div class="share-social1">
				<div class="zalo-share-button btzalo" data-href="<?php echo current_url();?>" data-oaid="579745863508352884" data-layout="3" data-color="blue" data-customize="false"></div>
				<div class="addthis_inline_share_toolbox btn-share"></div>
				</div>
			</div>
		  <div class="col-lg-3">
			<div class="title-cat-news"><h3> <i class="fa fa-list"></i> DANH MỤC BÀI VIẾT</h3></div>
              <div class="sidebar-left">
                
                <ul class="ulcatemenu">
                    <?php if(isset($news_cat))foreach ($news_cat as $item){?>
                        <li>
                            <a href="/tin-tuc/<?php echo $item->slug;?>.html"><i class="fas fa-angle-right"></i> <?php echo $item->name;?></a>
                        </li>
                    <?php } ?>

                </ul>
			
                <?php
					echo $this->load->widget('product_cat_box');
				?>
              </div>
            
          </div>
      </div>
    
  </div>
</div>
