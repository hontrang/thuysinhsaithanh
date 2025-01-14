
<?php

echo $this->load->widget('breadcrumb');
?>
<div class="container">
  <div class="content-tab-pro blog-list">
      <div class="row">
         
          <div class="col-lg-9">
                <h1><?php echo $title;?></h1>
                <hr>
                <?php if(isset($list))foreach ($list as $item){?>
                <div class="row news-item">
                    <div class="col-lg-3">
                        <a class="thumbnail" href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html">
                            <img class="" src="<?php echo base_url('public/userfiles/'.$item->image);?>" />
                        </a>
                    </div>
                    <div class="col-lg-9">
                        <h2><a href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><?php echo $item->name;?></a></h2>
                        <div class="tb_meta">
                            <p class="tb_date"><i class="fa fa-calendar"></i> <?php echo date("d/m/Y",strtotime($item->create_time));?></p>
                        </div>
                        
                        <div class="tb_description tb_text_wrap"><?php echo $item->des;?></div>
                    </div>
                </div>
                <?php } ?>
                
                    



                </div>
				 <div class="col-lg-3">
				 <div class="title-cat-news"> <h3> <i class="fa fa-list"></i> DANH MỤC BÀI VIẾT</h3></div>
              <div class="sidebar-left">
                <ul class="ulcatemenu">
                    <?php if(isset($news_cat))foreach ($news_cat as $item){?>
                        <li>
                            <a href="/tin-tuc/<?php echo $item->slug;?>.html"><?php echo $item->name;?></a>
                        </li>
                    <?php } ?>

                </ul>

              </div>
				<!--<div class="title-cat-news"><h3>DỊCH VỤ </h3></div>
					<?php
					//echo $this->load->widget('services_box');
					?>-->
					<?php
					echo $this->load->widget('product_cat_box');
				?>
              </div>
			  </div>
            
          </div>
                <div class="pagination-box">
                    <?php if(isset($pagination_link))echo $pagination_link;?>
                </div>

          </div>
      </div>
    
  </div>
</div>

