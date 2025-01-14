<?php
    $this->load->helper('form');
?>
<div class="modal fade in" id="regform" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" style="display: block; position: relative; z-index: 1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 align="center" class="modal-title" id="formModalLabel">Đăng ký</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mb-lg" action="dang-ky.html" method="post">
                    <div class="form-group mt-lg">
                        <div class="col-sm-6">
                            <label class="bold">Họ (<span class="required">*</span>)</label>
                            <input value="<?php echo set_value("ho");?>" type="text" name="ho" class="form-control" placeholder="Nhập họ của bạn" required/>
                            <?php echo form_error("ho");?>
                        </div>
                        <div class="col-sm-6">
                            <label class="bold">Tên (<span class="required">*</span>)</label>
                            <input value="<?php echo set_value("name");?>" type="text" name="name" class="form-control " placeholder="Nhập tên của bạn" required/>
                            <?php echo form_error("name");?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="bold">Email đăng nhập</label>
                            <input value="<?php echo set_value("email");?>" type="email" name="email" class="form-control" placeholder="Nhập Email (Có thể bỏ trống nếu bạn không sử dụng email)" />
                            <?php echo form_error("email");?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label class="bold">Mật khẩu (<span class="required">*</span>)</label>
                            <input type="password" name="password" class="form-control" placeholder="Nhập nật khẩu" required/>
                            <?php echo form_error('password');?>
                        </div>
                        <div class="col-sm-6">
                            <label class="bold">Xác nhận mật khẩu (<span class="required">*</span>)</label>
                            <input type="password" name="repassword" class="form-control" placeholder="Nhận lại chính xác mật khẩu" required/>
                            <?php echo form_error("repassword");?>
                        </div>
                    </div>
					

                    <div class="form-group mt-lg">
                        <div class="col-sm-6">
                            <label class="bold">Ngày Sinh (<span class="required">*</span>)</label>
							<div class="row">
								<div class="col-md-12">
									<div class="birthday">
										<input type="text" maxlength="2" name="birthday_day" value="<?php echo set_value("birthday_day");?>" class="form-control" placeholder="Ngày" required/>
									</div>
									<div class="birthday">
										<input type="text" maxlength="2" name="birthday_month" value="<?php echo set_value("birthday_month");?>" class="form-control" placeholder="Tháng" required/>
									</div>
									<div class="birthday">
										<select name="birthday_year" class="form-control" required>
												<option value="">Năm</option>
											<?php for($i=1948;$i<2018;$i++){?>
												<option value="<?php echo $i;?>" <?php echo set_select("birthday_year", $i);?>><?php echo $i;?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							
							
                            <?php echo form_error("birthday_day");?>
                            <?php echo form_error("birthday_month");?>
                            <?php echo form_error("birthday_year");?>
                        </div>
                        <div class="col-sm-6">
                            <label class="bold">Giới tính (<span class="required">*</span>)</label>
                            <select class="form-control" name="sex">
                                <option value="">Chọn giới tính</option>
                                <option value="1" <?php echo set_select("sex", 1);?>">Nam</option>
                                <option value="2" <?php echo set_select("sex", 2);?>>Nữ</option>
                            </select>
                            <?php echo form_error("sex");?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="bold">Số điện thoại (<span class="required">*</span>)</label>
                            <input value="<?php echo set_value("phone");?>"  type="number" name="phone" class="form-control" placeholder="Nhập số điện thoại" required/>
                            <?php echo form_error("phone");?>
                        </div>
                    </div>

                    <fieldset>
                        <legend>Thông tin bổ sung</legend>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="bold">Email người giới thiệu</label>
                                <input value="<?php echo set_value("ref_email");?>"  type="email" name="ref_email" class="form-control" placeholder="Nhập địa chỉ"/>
                                <?php echo form_error("ref_email");?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="bold">Địa chỉ</label>
                                <input value="<?php echo set_value("address");?>"  type="text" name="address" class="form-control" placeholder="Nhập địa chỉ"/>
                                <?php echo form_error("address");?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="bold">Nghề nghiệp</label>
                                <input value="<?php echo set_value("career");?>"  type="text" name="career" class="form-control" placeholder="Nghề nghiệp của bạn là gì?"/>
                                <?php echo form_error("career");?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="bold">Nơi công tác</label>
                                <input value="<?php echo set_value("place_works");?>"  type="text" name="place_works" class="form-control" placeholder="Nơi công tác"/>
                                <?php echo form_error("place_works");?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="bold">Vì sao bạn muốn học tiếng Hàn?</label>
                                <textarea name="note" class="form-control" rows="3"><?php echo set_value("note");?></textarea>
                                <?php echo form_error("note");?>
                            </div>
                        </div>
						(<span class="required">*</span>): là những thông tin bắt buộc phải nhập.<br />
                    </fieldset>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button style="width: 100%" type="submit" value="Login" name="btnSubmit" class="btn btn-3d btn-danger btn-lg ">Đăng ký</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button style="width: 100%" class="btn btn-3d btn-success btn-lg btnLogin">Đăng nhập</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>