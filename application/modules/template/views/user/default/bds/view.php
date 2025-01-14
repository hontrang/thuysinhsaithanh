<?php
echo $this->load->widget('breadcrumb_box');
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 sidebar">
                <aside class="sidebar">

                    <?php
                    echo $this->load->widget('news_cat_box');
                    ?>



                    <div class="tabs">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#related" data-toggle="tab"> Bài liên quan</a></li>
                            <li><a href="#hot" data-toggle="tab">Xem nhiều</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="related">
                                <ul class="simple-post-list">
                                    <?php if(isset($related))foreach ($related as $item){?>
                                        <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail">
                                                    <a title="<?php echo $item->name;?>" href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html">
                                                        <img src="<?php echo base_url('public/small/'.$item->image);?>" alt="<?php echo $item->name;?>">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a title="<?php echo $item->name;?>" href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><?php echo $item->name;?></a>
                                                <div class="post-meta">
                                                    <?php echo date("d/m/Y",strtotime($item->create_time));?>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                            <div class="tab-pane" id="hot">
                                <ul class="simple-post-list">
                                    <?php if(isset($hot))foreach ($hot as $item){?>
                                        <li>
                                            <div class="post-image">
                                                <div class="img-thumbnail">
                                                    <a title="<?php echo $item->name;?>" href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html">
                                                        <img src="<?php echo base_url('public/small/'.$item->image);?>" alt="<?php echo $item->name;?>">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a title="<?php echo $item->name;?>" href="/tin-tuc/<?php echo $item->slug;?>-<?php echo $item->id;?>.html"><?php echo $item->name;?></a>
                                                <div class="post-meta">
                                                    <?php echo date("d/m/Y",strtotime($item->create_time));?>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>




                </aside>

            </div>

            <div class="col-lg-9">

                <div class="content">
                    <div class="content-item row">
                        <div class="col-md-12 content-text">
                           <?php echo $info->detail;?>
                        </div>
						<div class="col-md-12">
							<div class="share-box">
								<div class="addthis_inline_share_toolbox"></div> <div class="zalo-share-button" data-href="" data-oaid="1438295244875428913" data-layout="4" data-color="blue" data-customize=false></div>
						   </div>
						</div>
						
                    </div>


                </div>
            </div>

        </div>
    </div>
    </div>

</section>