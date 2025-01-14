<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/22/17 3:57 PM
 * Date: 9/22/17 11:28 PM
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
            <div class="ibox-content">
                <form method="POST" action="" class="form-horizontal">
                    <input type="hidden" value="" name="act">
                    <h3>Mã đơn hàng : <font color="red"><strong>#<?php echo ($order->id);?></strong></font></h3>
                    <h3>Thông tin người tạo:</h3>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Họ tên:</label>
                        <div class="col-md-4" style="padding-top: 7px;"><?php echo $order->name;?></div>

                        <label class="col-md-2 control-label">Phone:</label>
                        <div class="col-md-4" style="padding-top: 7px;"><?php echo $order->phone;?></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Email:</label>
                        <div class="col-md-4" style="padding-top: 7px;"><?php echo $order->email;?></div>

                        <label class="col-md-2 control-label">Địa chỉ:</label>
                        <div class="col-md-4" style="padding-top: 7px;"><?php echo $order->address;?></div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-2 control-label">Ghi chú:</label>
                        <div class="col-md-10" style="padding-top: 7px;"><?php echo $order->note;?></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <h3>Phương thức thanh toán: <span style="font-weight: 700; color: green"><?php echo $order->payment;?></span></h3>
                    <h3>Xuất hoá đơn: <span style="font-weight: 700; color: red"><?php echo ($order->vat ==1)?"Có":"Không";?></span></h3>
                    <div class="hr-line-dashed"></div>
					
					<h3>Thông tin xuất hoá đơn:</h3>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tên Công ty:</label>
                        <div class="col-md-4" style="padding-top: 7px;"><?php echo $order->company_name;?></div>

                        <label class="col-md-2 control-label">MST:</label>
                        <div class="col-md-4" style="padding-top: 7px;"><?php echo $order->company_mst;?></div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Địa chỉ:</label>
                        <div class="col-md-4" style="padding-top: 7px;"><?php echo $order->company_address;?></div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <h3>Chi tiết đơn hàng:</h3>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $content = json_decode($order->content);
                        foreach($content as $item){
                        ?>
                        <tr>
                            <td><?php echo $item->id;?></td>
                            <td><?php echo $item->name;?></td>
                            <td><?php echo $item->qty;?></td>
                            <td><?php echo number_format($item->price);?>đ</td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>Tổng</strong></td>
                            <td><?php echo number_format($order->price);?>đ</td>
                        </tr>
                        
                        
                        </tbody>
                    </table>
                    <div class="hr-line-dashed"></div>


                    <h4 align="center" style="color: red"><?php echo $this->session->flashdata('order_msg');?></h4>
                </form>

                <div class="hr-line-dashed"></div>
                <a href="/admin/cart/listall" class="btn btn-primary" ><i class="fa fa-arrow-left"></i> Quay lại</a>
            </div>

        </div>
    </div>
</div>