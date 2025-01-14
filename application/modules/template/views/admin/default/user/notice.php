<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/28/17 10:47 AM
 * Date: 8/28/17 2:26 PM
 *
 */

$this->load->helper('form');
    $this->load->library('form_validation');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Gửi thông báo</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox-content animated fadeInRight">
                <?php echo validation_errors(); ?>
                <form class="form-horizontal" role="form" action="" method="POST">
                <div class="" style="max-width: 1000px; margin: auto;">

                        <div class="form-group">
                            <label class="control-label col-sm-3" >Tiêu đề (<span class="required">*</span>):</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control input-sm" id="post_title" name="title" placeholder="" value="<?php echo set_value('title')?>">
                                <?php echo form_error('username');?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-3" >Nội dung thông báo (<span class="required">*</span>):</label>
                            <div class="col-sm-9">
                                <textarea id="notice" name="detail" class="form-control"><?php echo set_value('title')?></textarea>
                                <?php echo form_error('detail');?>
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="control-label col-sm-3" >Hình thức (<span class="required">*</span>):</label>
                            <div class="col-sm-9">
                                <select name="type" id="post_groupid" class="form-control input-sm">
                                    <option value="1" <?php echo  set_select('type',1); ?>>Gửi qua website</option>
                                    <option value="3" <?php echo  set_select('type',3); ?>>Gửi qua email</option>
                                    <option value="2" <?php echo  set_select('type',2); ?>>Tạo thông báo nhưng không gửi</option>
                                </select>
                                <?php echo form_error('type');?>
                            </div>

                        </div>


                        <div class="form-group">
                            <div class="col-md-12" align="center">
                                <input type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" value="Gửi" />
                            </div>
                        </div>


                </div>
                </form>
            </div>



        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="ibox-content animated fadeInRight">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tiêu đề</th>
                        <th>Người tạo</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if($list)
                        foreach($list as $item)
                        {
                            ?>
                            <tr>
                                <td><?php echo $item->id;?></td>
                                <td><?php echo $item->title;?></td>
                                <td><?php echo $item->username;?></td>
                                <td><?php echo $item->create_date;?></td>
                                <td><a href="/admin/user/notice/<?php echo $item->id;?>"><button class="btn btn-warning " type="button"><i class="fa fa-edit"></i>&nbsp;Xem</button></a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>
</div>

