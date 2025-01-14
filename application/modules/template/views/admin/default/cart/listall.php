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

<?php if(isset($download) and $download != ""){?>
<script>
	window.open('<?php echo $download;?>','_blank');
</script>

<?php }?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo $title;?></h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<!--<div class="row">
	<form method="POST" action="">
        <div class="col-lg-3">
			 <div class="form-group">
				<div class='input-group date datetime'>
					<input type='text' autocomplete="off" placeholder="Ngày bắt đầu" value="<?php echo set_value('datefrom');?>" name="datefrom" class="form-control" />
					<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
				</div>
			</div>
		</div>
		
		<div class="col-lg-3">
			 <div class="form-group">
				<div class='input-group date datetime'>
					<input type='text' autocomplete="off" placeholder="Ngày kết thúc" value="<?php echo set_value('dateto');?>" name="dateto" class="form-control" />
					<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<button type="submit" name="btnExcel" value="excel" class="btn btn-primary"><i class="fa fa-calendar"></i> Xuất file Excel</button>
			</div>
		</div>
		
	</form>
	</div>-->
	
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Giá</th>
                        <th>Ngày lập</th>
                        <th>Ghi chú</th>
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
                                <td><?php echo $item->id;?></td>
                                <td><?php echo $item->name;?></td>
                                <td><?php echo $item->phone;?></td>
                                <td><?php echo $item->address;?></td>
                                <td><?php echo number_format($item->price);?></td>
                                <td><?php echo date("H:i d/m/Y",strtotime($item->create_date));?></td>
                                <td><?php echo $item->note;?></td>
                                <td>
                                    <div style="margin-bottom: 3px"><a  href="/admin/<?php echo $current_module;?>/view/<?php echo $item->id;?>" class="btn btn-primary btn-sm" ><i class="fa fa-eye"></i>&nbsp;Xem</a> </div>
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
