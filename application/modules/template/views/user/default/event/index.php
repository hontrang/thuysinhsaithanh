<?php
echo $this->load->widget('breadcrumb_box');
?>
<div class="container">

    <div class="row">
        <div class="col-md-8">
            <div class="blog-posts">
                <?php if(isset($list_item))foreach ($list_item as $item){ ?>
                <article class="post post-medium">
                    <div class="row">

                        <div class="col-md-5">
                            <div class="post-image">
                                <div class="owl-carousel owl-theme" data-plugin-options="{'items':1}">
                                    <div>
                                        <div class="img-thumbnail">
                                            <img class="img-responsive" src="<?php echo base_url('public/small/'.$item->image);?>" alt="<?php echo $item->name;?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">

                            <div class="post-content">

                                <h4><a href="/con-nguoi-su-kien/<?php echo $item->slug;?>.html"><?php echo $item->name;?></a></h4>
                                <p><?php echo max_len($item->des,400);?></p>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="post-meta">
                                <span><i class="fa fa-calendar"></i> <?php echo date("d/m/Y",strtotime($item->create_time));?> </span>
                                <span><i class="fa fa-user"></i> By <a href="#">admin</a> </span>
                                <span><i class="fa fa-tag"></i> <a href="/con-nguoi-su-kien.html"><?php echo $this->lang->line("event");?></a></span>
                                <span><i class="fa fa-comments"></i> <a href="#">0 Bình luận</a></span>
                                <a href="/con-nguoi-su-kien/<?php echo $item->slug;?>.html" class="btn btn-xs btn-primary pull-right">Xem thêm...</a>
                            </div>
                        </div>
                    </div>

                </article>

                <?php } ?>
                <div class="pages">
                    <?php if(isset($pagination_link))echo $pagination_link;?>
                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-ms-12">
                    <?php
                        echo $this->load->widget('dangky_box');
                    ?>

                </div>

            </div>
            <div class="row">
                <div class="col-ms-12">
                    <?php
                    echo $this->load->widget('laban_box');
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>