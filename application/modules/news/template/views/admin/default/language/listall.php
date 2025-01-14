<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 10:02 AM
 * Date: 9/15/17 4:02 PM
 *
 */



$this->load->helper('form');
$this->load->library('form_validation');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title;?></h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>

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
                            <a class="btn btn-success" href="/admin/language/listall/<?php echo $item->lang;?>"><img src="<?php echo $item->flag;?>"> <?php echo $item->name;?></a>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div style="margin-bottom: 15px">
                <a href="/admin/<?php echo $module;?>/add" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới</a>
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Module</th>
                        <th>Đề xuất</th>
                        <th>Ngôn ngữ</th>
                        <th>Text</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(isset($list))
                        foreach($list as $item)
                        {
                            ?>
                            <tr>
                                <td><?php echo $item->set;?></td>
                                <td><?php echo $item->sample;?></td>
                                <td><?php echo $item->language;?></td>
                                <td><input class="form-control" id="id-<?php echo $item->id;?>" value="<?php echo $item->text;?>" /> </td>
                                <td>
                                    <div><button class="btn btn-warning btn-sm btn-save" data-id="<?php echo $item->id;?>" type="button"><i class="fa fa-edit"></i>&nbsp;Lưu</button></div>
                                </td>
                            </tr>

                            <?php
                        }
                    ?>
                    </tbody>
                </table>
                <div align="center">
                    <?php if(!empty($pagination_link)) echo $pagination_link;?>
                </div>

            </div>

        </div>
    </div>
</div>
