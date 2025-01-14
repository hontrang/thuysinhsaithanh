<?php
echo $this->load->widget('breadcrumb_box');
?>
<div class="container contact margin-bottom-20">
    <div class="row">
        <div class="col-md-4">
            <div class="widget-item info-contact in-fo-page-content">
                <h1 class="title-head">Thông tin liên hệ</h1>
                <!-- End .widget-title -->

                <h4 class="heading-primary"><strong><?php echo $site_config['title_'.$lang];?></strong></h4>
                <ul class="widget-menu contact-info-page">
                    <li><i class="fa fa-map-marker"></i> <?php echo $site_config['address_'.$lang];?></li>
                    <li><i class="fa fa-phone"></i> <strong><?php echo $this->lang->line("phone");?>: </strong> <?php echo $site_config['phone'];?></li>
                    <li><i class="fa fa-envelope"></i> <strong><?php echo $this->lang->line("email");?>: </strong> <a href="mailto:<?php echo $site_config['email'];?>"><?php echo $site_config['email'];?></a></li>
                </ul>
                <!-- End .widget-menu -->
            </div>
            <div class="box-maps margin-top-10 margin-bottom-10">
                <?php echo $site_config['google-map-embed'];?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="page-login">
                <div id="login">
                    <div class="center bold text-color-red"><?php echo $this->session->flashdata("contact_msg"); ?></div>
                    <h2 class="mb-sm mt-sm"><strong><?php echo $this->lang->line("contact_title");?></strong></h2>
                    <form id="contactForm" action="" method="POST">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Email (<span class="required">*</span>)</label>
                                    <input type="email" value="" placeholder=""  maxlength="200" class="form-control" name="email" id="email" required>
                                    <?php echo form_error('email','<div class="required">* ','</div>');?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="margin-top: 15px; margin-bottom: 15px; text-align: center;">
                                <input type="submit" value="Submit" class="btn btn-primary " name="btnSubmit">

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .box-maps{height: 350px;overflow: hidden;}
    .box-maps iframe{height:350px;width:100%;}
    footer.footer-other{margin-top:0;}
    .search-more{margin-top:0;}
</style>
