<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Home</h2>
        <ol class="breadcrumb">
            <li class="active">
                <a href="/">Home</a>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>




<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <h2>Đơn hàng </h2>
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
                                    <div style="margin-bottom: 3px"><a  href="/admin/cart/view/<?php echo $item->id;?>" class="btn btn-primary btn-sm" ><i class="fa fa-eye"></i>&nbsp;Xem</a> </div>
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
	
	<div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <h2>Liên hệ mới</h2>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Tiêu đề</th>
                        <th>Thời gian</th>
                        <th>Trang thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(isset($listcontact))
                        foreach($listcontact as $item)
                        {
                            ?>
                            <tr>
                                <td><?php echo $item->id;?></td>
                                <td><?php echo $item->name;?></td>
                                <td><?php echo $item->phone;?></td>
                                <td><?php echo $item->email;?></td>
                                <td><?php echo $item->title;?></td>
                                <td><?php echo date("d/m/Y H:i:s", strtotime($item->create_date));?></td>
                                <td><?php if($item->view == 0)echo "Chưa xem";else echo "Đã xem";?></td>
                                <td>
                                    <div style="margin-bottom: 3px"><a href="<?php echo base_url('admin/customer/contactview/'.$item->id);?>"><button class="btn btn-warning btn-sm " type="button"><i class="fa fa-eye"></i>&nbsp;Xem</button></a>
                                        <button  onclick="remove('/admin/customer/contactdel/<?php echo $item->id;?>');" class="btn btn-danger btn-danger btn-sm" type="button"><i class="fa fa-trash"></i>&nbsp;Xóa</button> </div>
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

