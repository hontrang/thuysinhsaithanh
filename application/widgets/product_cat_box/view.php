
<div class="sidebar">
	<div class="col-inner">
		<div class="title btn-cat">
			<h3><i class="fa fa-list"></i> DANH MỤC</h3>
		</div>
		<ul class="sidebar-wrapper ul-reset hidden-xs">

			<li id="nav_menu-4" class="widget widget_nav_menu">
				<div class="menu-danh-muc-container">
					<ul class="menu">
						<?php if(isset($product_cats))foreach ($product_cats as $item){
							$sub1s = $this->MCommon->getAllRowByWhere_lang($lang,'product_cat',['parent_id'=>$item->id],null,"orders ASC");	
						?>
						<li id="menu-item-<?php echo $item->id;?>" class="<?php if($current_slug == $item->slug and $sub1s)echo 'active';?> menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-<?php echo $item->id;?> has-child" aria-expanded="false">
							<button class="toggle" name="angle-right" aria-label="angle-right"><i class="fas fa-angle-right"></i></button>
							
							<a href="/san-pham/<?php echo $item->slug;?>.html" class="<?php if($current_slug == $item->slug)echo 'active';?>">
								
								<span><?php echo $item->name;?></span>
							</a>
							<?php
								if($sub1s){
							?>
							<ul class="sub-menu">
								<?php foreach ($sub1s as $sub1){
										
								?>
								<li id="menu-item-<?php echo $sub1->id;?>" class="menu-item-sub menu-item-<?php echo $sub1->id;?>">
									<a href="/san-pham/<?php echo $sub1->slug;?>.html" class="<?php if($current_slug == $sub1->slug)echo 'active';?>"><i class="fas fa-caret-right"></i> <?php echo $sub1->name;?></a>
								</li>
								<?php } ?>

							</ul>
							<?php } ?>
						</li>
						<?php } ?>

					</ul>
				</div>
			</li>
		</ul>
		
	
	</div>
</div>