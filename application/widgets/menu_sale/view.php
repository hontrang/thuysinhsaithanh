<!-- Main navbar -->
<?php
$this->load->library('form_validation');
?>
<div class="navbar navbar-inverse bg-indigo">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="/public/templates/admin/default/assets/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">

        <ul class="nav navbar-nav navbar-right">
            <li>
                <select class="form-control select" name="location_id">
                    <?php if(isset($location_menu))foreach ($location_menu as $l){
                        $select = false;
                        if($l->id == $this->session->userdata("location_id"))
                            $select = true;
                        ?>
                        <option value="<?php echo $l->id;?>" <?php echo set_select("location_id", $l->id,$select);?>><?php echo $l->name;?></option>
                    <?php } ?>
                </select>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bubbles4"></i>
                    <span class="visible-xs-inline-block position-right">Hộp thư</span>
                    <span class="badge bg-warning-400">0</span>
                </a>

            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="/public/templates/admin/default/assets/images/placeholder.jpg" alt="">
                    <span>Admin</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-cog5"></i> Thông tin tài khoản</a></li>
                    <li><a href="/admin/logout"><i class="icon-switch2"></i> Thoát</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav navbar-nav-material">
            <li><a href="/admin"><i class="icon-display4 position-left"></i> Tồng quan</a></li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cube position-left"></i> Hàng hóa <span class="caret"></span></a>

                <ul class="dropdown-menu width-200">
                    <li><a href="/admin/product/listcat"><i class="icon-list"></i> Danh mục</a></li>
                    <li><a href="/admin/product/listall"><i class="icon-price-tags"></i> Sản phẩm</a></li>
                    <li><a href="/admin/product/addcode"><i class="icon-barcode2"></i> Mã vạch</a></li>
                    <li><a href="/admin/product/price"><i class="icon-coins"></i> Thiết lập giá</a></li>
                    <li><a href="/admin/store"><i class="fa fa-check-square-o"></i> Kiểm kho</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-exchange position-left"></i> Giao dịch <span class="caret"></span></a>

                <ul class="dropdown-menu width-200">
                    <li><a href="/admin/trade/invoice"><i class="fa fa-file"></i> Hóa đơn</a></li>
                    <li><a href="/admin/trade/purchaselist"><i class="fa fa-sign-in"></i> Nhập hàng</a></li>
                    <li><a href="/admin/trade/return"><i class="icon-flip-vertical3"></i> Trả hàng</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-puzzle4 position-left"></i> Đối tác <span class="caret"></span></a>

                <ul class="dropdown-menu width-200">
                    <li><a href="/admin/product"><i class="icon-align-center-horizontal"></i> Khách hàng</a></li>
                    <li><a href="/admin/price"><i class="icon-flip-vertical3"></i> Đối tác</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /second navbar -->