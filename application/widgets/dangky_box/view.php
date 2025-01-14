<div class="featured-box featured-box-primary align-left mt-xlg margin-top-0">
    <div class="box-content">
        <h4 class="heading-primary text-uppercase mb-md"><?php echo $this->lang->line("dang_ky_thanh_vien_vca");?></h4>
        <form action="/" id="frmSignUp" method="post">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label><?php echo $this->lang->line("full_name");?> <span class="required">*</span></label>
                        <input type="text" id="fullname_left" name="fullname" value="" class="form-control input-lg" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label><?php echo $this->lang->line("username");?> <span class="required">*</span></label>
                        <input type="text" id="username_left" name="username" value="" class="form-control input-lg" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label><?php echo $this->lang->line("password");?> <span class="required">*</span></label>
                        <input type="password" id="password_left" name="password" value="" class="form-control input-lg" required>
                    </div>
                    <div class="col-md-6">
                        <label><?php echo $this->lang->line("repassword");?> <span class="required">*</span></label>
                        <input type="password" id="repassword_left" name="repassword" value="" class="form-control input-lg" required>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <input type="button" value="<?php echo $this->lang->line("reg_now");?>" class="btn btn-primary pull-right mb-xl btnRegister" data-loading-text="Loading...">
                </div>
            </div>
        </form>
    </div>
</div>