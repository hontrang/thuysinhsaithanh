<?php
echo $this->load->widget('breadcrumb_box');
?>
<div class="container">

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-ms-12">
                    <?php
                    echo $this->load->widget('noibo_cat_box');
                    ?>
                </div>
            </div>


        </div>

        <div class="col-md-9">
            <div class="blog-posts ">
                <?php if(isset($list_item))foreach ($list_item as $item){ ?>
                <div class="post post-medium item-tinnoibo">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="post-content">
                                <h4 class="title"><a href="/tin-noi-bo/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><?php echo $item->name;?></a></h4>
								<div class="date"><i class="fa fa-calendar"></i> <?php echo date("d/m/Y",strtotime($item->create_time));?> </div>
                                <div class="des"><?php echo max_len($item->des,400);?></div>

                            </div>
                        </div>

                    </div>
					
					<div class="download"><a title="Tải file" target="_blank" href="/tin-noi-bo/download/<?php echo $item->id;?>" ><i class="fa fa-download"></i></a></div>
					
                </div>

                <?php } ?>
                <div class="pages">
                    <?php if(isset($pagination_link))echo $pagination_link;?>
                </div>

            </div>
        </div>


    </div>

</div>