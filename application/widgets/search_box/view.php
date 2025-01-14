<div class="search-box-righ">
    <div class="main-sidebar" id="searchArea">
        <h1 class="title">Tìm kiếm</h1>
        <div id="search-div">
            <form class="form_search" role="search" action="<?php echo base_url('bds/tim-kiem');?>">
                <div class="form-group">
                    <select name="scat" id="scat" class="form-control input-sm">
                        <option value="0">Tất cả loại nhà đất</option>
                        <?php
                        if(isset($listcat))
                            foreach($listcat as $cat)
                        {
                            ?>
                            <option value="<?php echo $cat->id;?>"><?php echo $cat->name;?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="sprovince" id="sprovince" class="form-control input-sm">
                                <option value="0" >Tất cả Tỉnh/TP</option>
                                <?php
                                if(isset($listtinhthanh))
                                foreach($listtinhthanh as $tinhthanh)
                                {
                                    ?>
                                    <option value="<?php echo $tinhthanh->id;?>"><?php echo $tinhthanh->name;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="sdistrict" name="sdistrict" class="form-control input-sm">
                                <option value="0">Tất cả Quận/Huyện</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-group smore more-item">
                    <div class="row">
                        <div class="col-md-6">
                            <select id="sward" name="sward" class="form-control input-sm">
                                <option value="0" >Tất cả Phường/Xã</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="sstreet" name="sstreet" class="form-control input-sm">
                                <option value="0">Tất cả đường</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="divMucGia" class="comboboxs advance-select-box">
                                <span class="select-text">
                                    <span class="select-text-content">Mọi mức giá</span>
                                </span>
                                <input type="hidden" id="sMucGia" name="sMucGia" />
                                <div id="divMucGiaOptions" class="advance-select-options advance-area-options advance-options">
                                    <table class="header-options options">
                                        <tr class="advance-options">
                                            <td class="advance-options">
                                                <input type="text" id="txtMucGiaMinValue" name="MucGiamin" value="" placeholder="từ" class="min-value advance-options" maxlength="6" numbersonly="true" decimal="false" autocomplete="off" />
                                            </td>
                                            <td class="advance-options">
                                                <span class="advance-options">- </span>
                                            </td>
                                            <td class="advance-options">
                                                <input type="text" id="txtMucGiaMaxValue" name="MucGiamax" value="" placeholder="đến" class="max-value advance-options" maxlength="6" numbersonly="true" decimal="false" autocomplete="off" />
                                            </td>
                                            <td class="advance-options">
                                                <span class="advance-options"></span>
                                            </td>
                                        </tr>
                                    </table>
                                    <ul class="advance-options">
                                        <li vl="0" class="advance-options">Chọn mức giá</li>
                                        <li vl="1" class="advance-options">Thỏa thuận</li>
                                        <li vl="2" class="advance-options">&lt; 500 triệu</li>
                                        <li vl="3" class="advance-options">500 - 800 triệu</li>
                                        <li vl="4" class="advance-options">800 triệu - 1 tỷ</li>
                                        <li vl="5" class="advance-options">1 - 2 tỷ</li>
                                        <li vl="6" class="advance-options">>2 tỷ</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="divDienTich" class="comboboxs advance-select-box">
                                <span class="select-text">
                                    <span class="select-text-content">Mọi diện tích</span>
                                </span>
                                <input type="hidden" id="sDienTich" name="sDienTich" />
                                <div id="divDienTichOptions" class="advance-select-options advance-area-options advance-options">
                                    <table class="header-options options">
                                        <tr class="advance-options">
                                            <td class="advance-options">
                                                <input type="text" id="txtDienTichMinValue" name="DienTichmin" value="" placeholder="từ" class="min-value advance-options" maxlength="6" numbersonly="true" decimal="false" autocomplete="off" />
                                            </td>
                                            <td class="advance-options">
                                                <span class="advance-options">- </span>
                                            </td>
                                            <td class="advance-options">
                                                <input type="text" id="txtDienTichMaxValue" name="DienTichmax" value="" placeholder="đến" class="max-value advance-options" maxlength="6" numbersonly="true" decimal="false" autocomplete="off" />
                                            </td>
                                            <td class="advance-options">
                                                <span class="advance-options">m2</span>
                                            </td>
                                        </tr>
                                    </table>
                                    <ul class="advance-options">
                                        <li vl="0" class="advance-options">Chọn diện tích</li>
                                        <li vl="1" class="advance-options">0 - 50 m2</li>
                                        <li vl="2" class="advance-options">50 - 100 m2</li>
                                        <li vl="3" class="advance-options">100 - 150 m2</li>
                                        <li vl="4" class="advance-options">150 - 250 m2</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="search-more">
                    <a href="javascript:;">Tìm kiếm nâng cao</a>
                </div>

                <div class="form-group text-center">
                    <button name="btn-search" value="1" type="submit" class="btn btn-success"><i class="glyphicon glyphicon-search"></i> Tìm kiếm</button>
                </div>
            </form>
        </div>

    </div>
</div>