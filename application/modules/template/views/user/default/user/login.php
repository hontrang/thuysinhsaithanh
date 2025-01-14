<?php
$this->load->helper('form');
?>
<div class="modal fade in" id="regform" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true" style="display: block; position: relative; z-index: 1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 align="center" class="modal-title" id="formModalLabel">Đăng nhập</h4>
            </div>
            <div class="modal-body">
                <form id="demo-form" class="form-horizontal mb-lg" action="dang-nhap.html" method="post">
                    <div class="form-group mt-lg">
                        <div class="col-sm-12">
                            <input type="text" name="email" class="form-control " placeholder="SĐT hoặc Email đăng nhập" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <p><?php echo validation_errors();?></p>
                            <p class="error_prefix"><?php echo $this->session->flashdata("msg");?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button style="width: 100%" type="submit" name="btnSubmit" value="Login" class="btn btn-3d btn-danger btn-lg">Đăng nhập</button>
                        </div>
                    </div>
                </form>
                <div style="text-align: right"><a href=/quen-mat-khau.html">Quên mật khẩu?</a></div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <div class="col-sm-12">
                        <a href="/dang-ky.html"><button style="width: 100%" class="btn btn-3d btn-success btn-lg">Đăng ký mới</button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>