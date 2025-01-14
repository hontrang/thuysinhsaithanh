<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/21/17 11:23 PM
 * Date: 8/21/17 11:25 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/21/17 3:27 PM
 * Date: 8/21/17 10:11 PM
 *
 */

/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 8/21/17 2:48 PM
 * Date: 8/21/17 3:27 PM
 *
 */

$this->load->helper('form');
    $this->load->library('form_validation');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Phân quyền</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<?php if($this->input->get("act") == "edit" and (int)$this->input->get("id") != 0)
{
    ?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox-content">
                <form method="POST" action="" class="form-horizontal">

                    <div class="form-group"><label class="col-sm-1 control-label">Tên nhóm</label>

                        <div class="col-sm-11">
                            <input type="text" name="name" value="<?php if(isset($info)) echo $info->name;?>" class="form-control">
                            <?php echo form_error('name', '<div class="error">', '</div>'); ?>
                        </div>
                    </div>
                    <div class="form-group "><label class="col-sm-1 control-label">Nhóm quyền</label>
                        <div class="col-sm-11 col-sm-offset-1">
                            <select id='list-permission' name="list_permission[]" multiple='multiple'>
                                <?php foreach ($list_permission as $permission) {
                                    $select = "";

                                    if(false !== array_search($permission->id,$current_per_list))
                                        $select = "selected";
                                    ?>
                                        <option value='<?php echo $permission->id;?>' <?php echo $select;?>><?php echo $permission->name;?></option>
                                    <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-1 col-sm-offset-1">
                            <button class="btn btn-primary" value="submit" name="submit" type="submit">Sửa</button>
                        </div>
                    </div>
                </form>

        </div>

        </div>
    </div>
</div>
<?php } ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox-content animated fadeInRight">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên nhóm</th>
                        <th>Ghi chú</th>
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
                                <td><?php echo $item->name;?></td>
                                <td><?php echo $item->note;?></td>
                                <td><a href="?act=edit&id=<?php echo $item->id;?>"><button class="btn btn-warning " type="button"><i class="fa fa-edit"></i>&nbsp;Phân quền</button></a>
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

