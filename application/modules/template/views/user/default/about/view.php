<?php

echo $this->load->widget('breadcrumb');
?>
<div class="title-product-list center container">
  <h1><?php echo $title;?></h1>
</div>

<style>
	.content-post ul{
		list-style-type: disc;
		padding-left: 15px;
	}
		
</style>
<div class="container" id="us">
  <div class="row">
	<div class="col-md-12 content-post">
		<?php echo $info->content;?>
	</div>
    
  </div>
</div>