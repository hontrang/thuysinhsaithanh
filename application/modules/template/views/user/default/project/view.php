<?php
echo $this->load->widget('breadcrumb_box');
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 sidebar">
                <aside class="sidebar" data-plugin-sticky data-plugin-options="{'minWidth': 991, 'containerSelector': '.container', 'padding': {'top': 130}}">

                    <?php
                    echo $this->load->widget('project_navi_box');
                    ?>
                </aside>

            </div>

            <div class="col-lg-9">

                <div class="content">
                    <div class="content-item row">
                        <div class="col-md-12 content-text" id="tongquan">
                            <div class="heading heading-primary heading-border heading-bottom-border">
                                <h3>Tổng quan</h3>
                            </div>

                           <?php echo $info->detail;?>
						   <div class="share-box">
							<div class="addthis_inline_share_toolbox"></div> <div class="zalo-share-button" data-href="" data-oaid="1438295244875428913" data-layout="4" data-color="blue" data-customize=false></div>
						   </div>
                        </div>

                        <div class="col-md-12 content-text" id="vitri">
                            <div class="heading heading-primary heading-border heading-bottom-border">
                                <h3>Vị trí</h3>
                            </div>
                            <?php echo $info->vitri;?>
                        </div>

                        <div class="col-md-12 content-text" id="matbang">
                            <div class="heading heading-primary heading-border heading-bottom-border">
                                <h3>Mặt bằng</h3>
                            </div>
                            <?php echo $info->matbang;?>
                        </div>

                        <div class="col-md-12 content-text" id="tienich">
                            <div class="heading heading-primary heading-border heading-bottom-border">
                                <h3>Tiện ích</h3>
                            </div>
                            <?php echo $info->tienich;?>
                        </div>
						<div class="col-md-12 content-text" id="phuongthucthanhtoan">
                            <div class="heading heading-primary heading-border heading-bottom-border">
                                <h3>Phương thức thanh toán</h3>
                            </div>
                            <?php echo $info->phuongthucthanhtoan;?>
                        </div>

                        <div class="col-md-12 content-text" id="lienhe">
                            <div class="heading heading-primary heading-border heading-bottom-border">
                                <h3>Liên hệ</h3>
                            </div>
                            <form id="formContact" action="/lien-he.html" method="POST">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label><?php echo $this->lang->line("full_name");?> (<span class="required">*</span>)</label>
                                            <input type="text" value="" placeholder="" maxlength="300" class="form-control" name="name" id="name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Email (<span class="required">*</span>)</label>
                                            <input type="email" value="" placeholder=""  maxlength="200" class="form-control" name="email" id="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label><?php echo $this->lang->line("phone");?> (<span class="required">*</span>)</label>
                                            <input type="text" value="" placeholder="" maxlength="500" class="form-control" name="phone" id="phone" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label><?php echo $this->lang->line("title");?> (<span class="required">*</span>)</label>
                                            <input type="text" value="" placeholder="" maxlength="500" class="form-control" name="title" id="title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label><?php echo $this->lang->line("content");?> (<span class="required">*</span>)</label>
                                            <textarea maxlength="5000" placeholder="" rows="10" class="form-control" name="content" id="content" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 15px; margin-bottom: 15px; text-align: center;">
                                        <input type="submit" value="<?php echo $this->lang->line("send_contact");?>" class="btn btn-primary " id="btnContact" name="btnSubmit">
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-12 content-text" id="lienhe">
                            <div class="heading heading-primary heading-border heading-bottom-border">
                                <h3>Các dự án khác</h3>
                            </div>
                            <div class="row">
                                <?php if(isset($related))foreach ($related as $item){?>
                                    <div class="col-md-4">
                                        <a href="/du-an/<?php echo $item->slug;?>-<?php echo $item->id;?>.html" title="<?php echo $item->name;?>">
                                        <span class="thumb-info thumb-info-hide-wrapper-bg">
                                            <span class="thumb-info-wrapper">
                                                <div class="img-box-dich-vu">
                                                    <img src="<?php echo base_url('public/small/'.$item->image);?>" class="img-responsive fixsize" alt="<?php echo $item->name;?>">
                                                </div>
                                            </span>
                                            <span class="thumb-info-caption">
                                                <span class="thumb-info-caption-text">
                                                    <h4 class="title"><?php echo $item->name;?></h4>
                                                    <div class="sub_title"><?php echo $item->sub_name;?></div>
                                                </span>

                                            </span>
                                        </span>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

</section>