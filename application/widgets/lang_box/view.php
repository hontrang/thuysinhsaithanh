<div class="wrapper wrapper-content" style="padding-bottom: 0;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-2" style="width: 150px">
                        Chọn ngôn ngữ:
                    </div>
                    <?php if(isset($langs))foreach ($langs as $item){ ?>
                        <div class="col-md-2" style="width: 150px">
                            <a class="btn btn-success" href="?langchange=<?php echo $item->lang;?>"><img src="<?php echo $item->flag;?>"> <?php echo $item->name;?></a>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>