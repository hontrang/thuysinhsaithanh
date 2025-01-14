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
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div style="margin-bottom: 15px">
                <a href="/admin/<?php echo $module;?>/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <div class="ibox-content">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(isset($list))
                        foreach($list as $item)
                        {
                            ?>
                            <tr>
                                <td><?php echo $item->orders;?>
                                    <a href="?order=up&id=<?php echo $item->id;?>">
                                        <i class="fa fa-chevron-up"> </i>
                                    </a>

                                    <a href="?order=down&id=<?php echo $item->id;?>">
                                        <i class="fa fa-chevron-down"> </i>
                                    </a>
                                </td>
                                <td><?php echo $item->name;?></td>
                                <td>
                                   <div style="margin-bottom: 3px"><a href="<?php echo base_url('admin/'.$current_module.'/edit/'.$item->id);?>"><button class="btn btn-warning btn-sm " type="button"><i class="fa fa-edit"></i>&nbsp;Edit</button></a>
                                       <button  onclick="remove('/admin/<?php echo $current_module;?>/del/<?php echo $item->id;?>');" class="btn btn-danger btn-danger btn-sm" type="button"><i class="fa fa-trash"></i>&nbsp;Delete</button> </div>
                                </td>
                            </tr>
                            <?php if(isset($item->sub))foreach ($item->sub as $sub){?>
                                <tr style="background-color: #eaeaea">
                                    <td style="padding-left: 25px"><?php echo $sub->orders;?>
                                        <a href="?order=up&id=<?php echo $sub->id;?>&parent_id=<?php echo $item->id;?>">
                                            <i class="fa fa-chevron-up"> </i>
                                        </a>

                                        <a href="?order=down&id=<?php echo $sub->id;?>&parent_id=<?php echo $item->id;?>">
                                            <i class="fa fa-chevron-down"> </i>
                                        </a>
                                    </td>
                                    <td><?php echo $sub->name;?></td>
                                    <td>
                                        <div style="margin-bottom: 3px"><a href="<?php echo base_url('admin/'.$current_module.'/edit/'.$sub->id);?>"><button class="btn btn-warning btn-sm " type="button"><i class="fa fa-edit"></i>&nbsp;Edit</button></a>
                                            <button  onclick="remove('/admin/<?php echo $current_module;?>/del/<?php echo $sub->id;?>');" class="btn btn-danger btn-danger btn-sm" type="button"><i class="fa fa-trash"></i>&nbsp;Delete</button> </div>
                                    </td>
                                </tr>

                            <?php } ?>

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
