
<?php

echo $this->load->widget('breadcrumb');
?>
<div class="container">
  <div class="content-tab-pro blog-list">
      <div class="row">
          <div class="col-lg-12">
                <h1><?php echo $title;?></h1>
                <hr>
                <?php if(isset($list))foreach ($list as $item){?>
                <div class="row news-item">

                    <div class="col-lg-12">
                        <h2><a href="/dich-vu/<?php echo $item->slug;?>.html"><?php echo $item->name;?></a></h2>
                        <div class="tb_description tb_text_wrap"><?php echo $item->des;?></div>
                    </div>
					
                </div>
				<hr>
                <?php } ?>
                   

                </div>
                <div class="pagination-box">
                    <?php if(isset($pagination_link))echo $pagination_link;?>
                </div>

          </div>
      </div>
    
  </div>
</div>

