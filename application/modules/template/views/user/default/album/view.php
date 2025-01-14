
<?php
echo $this->load->widget('breadcrumb_box');
?>

<div class="container">

    <div class="row margin-bottom-50">
        <div class="col-md-xs-12 col-md-12">
			<div class="row margin-bottom-50">
				<div class="col-md-12">
					<?php echo $info->detail;?>
				</div>
			</div>
		
            <div class="row">
                <?php if(isset($list_item)) foreach ($list_item as $item) {?>
                    <div class="col-sm-4 col-md-4 col-xs-12 item-album album-view">
                        <a href="<?php echo base_url('public/userfiles/'.$item->image);?>" data-fancybox="group" data-caption="<?php echo $info->name;?>">
                            <div class="img-box">
                                <img alt="<?php echo $item->name;?>" class="img-responsive fixsize" alt="<?php echo $info->name;?>" src="<?php echo base_url('public/small/'.$item->image);?>">
                            </div>
                            
                        </a>
                    </div>
                <?php }?>
            </div>

        </div>
    </div>
    
</div>