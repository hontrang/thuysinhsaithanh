<?php
echo $this->load->widget('breadcrumb_box');
?>

<section>
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

            <div class="col-lg-9">

                <div class="content chitiettinnoibo">
                    <div class="content-item row">
                        <div class="col-md-12 content-text">
							<div class="download"><a title="Tải file" target="_blank" href="/tin-noi-bo/download/<?php echo $info->id;?>" ><i class="fa fa-download"></i> Tải file đính kèm</a></div>
                           <div><?php echo $info->des;?></div>
                           <div><?php echo $info->detail;?></div>
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