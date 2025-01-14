<?php

$lang = 'vi';
if($this->session->userdata("lang") != "")
    $lang = $this->session->userdata("lang");

?>

<iframe src="<?php echo $site_config['map'];?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

<div class="container">

    <div class="row">
        <div class="col-md-6">

            <div class="center bold" style="color: red"><?php echo $this->session->flashdata("contact_msg"); ?></div>
            <h2 class="mb-sm mt-sm"><strong><?php echo $this->lang->line("contact_title");?></strong></h2>
            <form id="contactForm" action="" method="POST">
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
                            <label><?php echo $this->lang->line("phone");?></label>
                            <input type="text" value="" placeholder="" maxlength="500" class="form-control" name="phone" id="phone">
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
                        <input type="submit" value="<?php echo $this->lang->line("send_contact");?>" class="btn btn-primary " name="btnSubmit">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">

            <h4 class="heading-primary"><strong><?php echo $site_config['title_'.$lang];?></strong></h4>
            <ul class="list list-icons list-icons-style-3 mt-xlg">
                <li><i class="fa fa-map-marker"></i> <strong><?php echo $this->lang->line("address");?>:</strong> <?php echo $site_config['address_'.$lang];?></li>
                <li><i class="fa fa-phone"></i> <strong><?php echo $this->lang->line("phone");?>:</strong> <?php echo $site_config['phone'];?></li>
                <li><i class="fa fa-fax"></i> <strong>Fax:</strong> <?php echo $site_config['fax'];?></li>
                <li><i class="fa fa-envelope"></i> <strong><?php echo $this->lang->line("email");?>:</strong> <a href="mailto:<?php echo $site_config['email'];?>"><?php echo $site_config['email'];?></a></li>
            </ul>

            <hr>

            <h4 class="heading-primary"><?php echo $this->lang->line("business_time");?></strong></h4>

                <?php if($site_config['gio-lam-viec-1_'.$lang] != ""){?><?php echo $site_config['gio-lam-viec-1_'.$lang];?><?php } ?>
                <?php if($site_config['gio-lam-viec-2'] != ""){?><li><i class="fa fa-clock-o"></i> <?php echo $site_config['gio-lam-viec-2'];?></li><?php } ?>
                <?php if($site_config['gio-lam-viec-3'] != ""){?><li><i class="fa fa-clock-o"></i> <?php echo $site_config['gio-lam-viec-3'];?></li><?php } ?>


        </div>

    </div>

</div>







