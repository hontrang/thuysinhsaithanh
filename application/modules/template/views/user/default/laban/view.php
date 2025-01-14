<?php
echo $this->load->widget('breadcrumb_box');
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                <div class="content">
                    <div class="content-item row">
                        <div class="col-md-12 content-text">
                           <?php echo $info->content;?>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-lg-4 sidebar">
                <aside class="sidebar">
                    <?php
                        echo $this->load->widget('dangky_box');
                    ?>

                    <div class="tabs">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#related" data-toggle="tab"><i class="fa fa-star"></i> Bài liên quan</a></li>
                            <li><a href="#hot" data-toggle="tab">Xem nhiều</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="related">
                                <ul class="simple-post-list">
                                    <?php if(isset($related))foreach ($related as $item){?>
                                    <li>
                                        <div class="post-image">
                                            <div class="img-thumbnail">
                                                <a title="<?php echo $item->name;?>" href="/la-ban-thanh-cong/<?php echo $item->slug;?>">
                                                    <img src="<?php echo base_url('public/small/'.$item->image);?>" alt="<?php echo $item->name;?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-info">
                                            <a title="<?php echo $item->name;?>" href="/la-ban-thanh-cong/<?php echo $item->slug;?>"><?php echo $item->name;?></a>
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
                                                    <a title="<?php echo $item->name;?>" href="/la-ban-thanh-cong/<?php echo $item->slug;?>">
                                                        <img src="<?php echo base_url('public/small/'.$item->image);?>" alt="<?php echo $item->name;?>">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="post-info">
                                                <a title="<?php echo $item->name;?>" href="/la-ban-thanh-cong/<?php echo $item->slug;?>"><?php echo $item->name;?></a>
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


                    <div class="col-ms-12">
                        <?php
                        echo $this->load->widget('laban_box');
                        ?>
                    </div>


                </aside>

            </div>
        </div>
    </div>
    </div>

</section>