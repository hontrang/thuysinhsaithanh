<?php
$this->load->helper('form');
?>
<?php

echo $this->load->widget('breadcrumb');
?>


<style>
.product-subtotal .price{
	font-size: 22px;
	color: red;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #eceeef;
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #eceeef;
}

.table tbody + tbody {
    border-top: 2px solid #eceeef;
}

.table .table {
    background-color: #fff;
}

.table-sm th,
.table-sm td {
    padding: 0.3rem;
}

.table-bordered {
    border: 1px solid #eceeef;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #eceeef;
}

.table-bordered thead th,
.table-bordered thead td {
    border-bottom-width: 2px;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}

.table-active,
.table-active > th,
.table-active > td {
    background-color: rgba(0, 0, 0, 0.075);
}

.table-hover .table-active:hover {
    background-color: rgba(0, 0, 0, 0.075);
}

.table-hover .table-active:hover > td,
.table-hover .table-active:hover > th {
    background-color: rgba(0, 0, 0, 0.075);
}

.table-success,
.table-success > th,
.table-success > td {
    background-color: #dff0d8;
}

.table-hover .table-success:hover {
    background-color: #d0e9c6;
}

.table-hover .table-success:hover > td,
.table-hover .table-success:hover > th {
    background-color: #d0e9c6;
}

.table-info,
.table-info > th,
.table-info > td {
    background-color: #d9edf7;
}

.table-hover .table-info:hover {
    background-color: #c4e3f3;
}

.table-hover .table-info:hover > td,
.table-hover .table-info:hover > th {
    background-color: #c4e3f3;
}

.table-warning,
.table-warning > th,
.table-warning > td {
    background-color: #fcf8e3;
}

.table-hover .table-warning:hover {
    background-color: #faf2cc;
}

.table-hover .table-warning:hover > td,
.table-hover .table-warning:hover > th {
    background-color: #faf2cc;
}

.table-danger,
.table-danger > th,
.table-danger > td {
    background-color: #f2dede;
}

.table-hover .table-danger:hover {
    background-color: #ebcccc;
}

.table-hover .table-danger:hover > td,
.table-hover .table-danger:hover > th {
    background-color: #ebcccc;
}

.thead-inverse th {
    color: #fff;
    background-color: #292b2c;
}

.thead-default th {
    color: #464a4c;
    background-color: #eceeef;
}

.table-inverse {
    color: #fff;
    background-color: #292b2c;
}

.table-inverse th,
.table-inverse td,
.table-inverse thead th {
    border-color: #fff;
}

.table-inverse.table-bordered {
    border: 0;
}

.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}

.table-responsive.table-bordered {
    border: 0;
}

    .money{
        font-size: 15px;
    }
	#accordion .form-group{
		margin-bottom: 10px;
		
	}
	#accordion  .form-group input{
		margin-bottom: 10px;
		
	}
</style>
<form class="form-horizontal cart-form" action="" method="POST">
<div class="container">
  <div class="content-tab-pro blog-list">
      <div class="row">
          <div class="col-lg-12">
              <div class="row ajaxcart margin-top-20">
					<div class="col-md-12 margin-bottom-40">
						<div class="row">
							<div class="col col-xs-12 col-md-7">

								<div class="" id="accordion">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true">
													Thông tin vận chuyển
												</a>
											</h4>
										</div>
										<div id="collapseOne" class="accordion-body" aria-expanded="true" style="">
											<div class="panel-body">
												<div class="row">
													<div class="col col-xs-12 col-md-12">

															<div class="form-group margin-bottom-15">
																<label class="control-label col-xs-12 col-sm-2 " for="phone">SĐT (*):</label>
																<div class=" col-xs-12 col-sm-10">
																	<input required class="form-control" value="<?php set_value('phone');?>" id="phone" placeholder="Số điện thoại" name="phone">
																	<div class="help-block text-red">* Vui lòng nhập chính xác SĐT</div>
																</div>
															</div>

															<div class="form-group margin-bottom-15">
																<label class="control-label col-xs-12 col-sm-2" for="name">Họ tên (*):</label>
																<div class="col-xs-12 col-sm-10">
																	<input type="text" required class="form-control" value="<?php set_value('name');?>" id="name" placeholder="Họ tên người nhận" name="name">
																	<?php echo form_error('name');?>
																</div>
															</div>


															<div class="form-group margin-bottom-15">
																<label class="control-label col-xs-12 col-sm-2" for="address">Địa chỉ (*):</label>
																<div class="col-xs-12 col-sm-10">
																	<input type="text" required class="form-control" value="<?php set_value('address');?>" id="address" placeholder="Địa chỉ người nhận" name="address">
																	<div class="help-block">* Vui lòng nhập chính xác địa chỉ</div>
																	<?php echo form_error('address');?>
																</div>
															</div>



															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2" for="note">Ghi chú:</label>
																<div class="col-xs-12 col-sm-10">
																	<textarea rows="3" class="form-control" id="note" placeholder="Ghi chú đơn hàng. VD: Giao hàng buổi tối sau 18h" name="note"><?php set_value('note');?></textarea>
																</div>
															</div>
															<div class="form-group">
																<label class="control-label col-xs-12 col-sm-2" for=""> </label>
																<div class="col-xs-12 col-sm-10">
																	<button type="submit" name="btnSubmit" value="submit" class="btn btn-success click_ajax click_ajax2 btn_orange" style="background-color: #990000 !important;
																		color: #fff;
																		padding: 8px 25px;
																		border-radius: 0;
																		margin-top: 15px;
																		width: 100%;">Đặt hàng</button>
																</div>
															</div>

														
													</div>

												</div>
											</div>
										</div>
									</div>


								</div>

							</div>
							<div class="col col-xs-12 col-md-5">





								<aside class="sidebar">
									<h4 class="heading-primary">Thông tin thanh toán</h4>
									<?php if(count($this->cart->contents()) > 0){ ?>
										<div class="featured-boxes">
											<div class="row">
												<div class="col col-md-12">
													<table class="table table-striped">
														<thead>
														<tr>
															<th class="product-name">
																Tên SP
															</th>
															<th class="product-quantity">
																SL
															</th>
															<th class="product-subtotal">
																Giá
															</th>
														</tr>
														</thead>
														<tbody>
														<?php foreach ($this->cart->contents() as $items){?>
															<tr class="cart_table_item">
																<td class="product-name">
																	<a href="<?php echo site_url('product/'.create_slug($items['name'].'-'.$items['id']));?>"><?php echo $items['name'];?></a>
																</td>
																<td class="product-quantity">
																	<span class="amount"><?php echo number_format($items['qty']);?></span>
																</td>
																<td class="product-price summary">
																	<div class=""><?php echo number_format($items['price']);?> </div>

																</td>
															</tr>

														<?php } ?>
														<?php
														$ship = 0;
														if($this->cart->total_items()>=3)
															$ship = 0;
														?>
														<tr>
															<td colspan="2" class="product-quantity" style="text-align: right; font-size: 16px; font-weight: bold">
																Phí ship
															</td>
															<td class="product-subtotal">
																<strong><span class="price-ship"><?php echo number_format($ship);?></span></strong>
															</td>
														</tr>
														<tr>
															<td colspan="2" class="product-quantity" style="text-align: right; font-size: 16px; font-weight: bold; color: green">
																Khuyến mãi
															</td>
															<td class="product-subtotal">
																<strong><span class="price-ship" style="color: green"><?php echo number_format($discount_price);?></span>   <?php if($discount_price > 0){?>  <?php }?></strong>
															</td>
														</tr>
														<tr>
															<td colspan="2" class="product-quantity" style="text-align: right; font-size: 16px; font-weight: bold">
																Tổng
															</td>
															<td class="product-subtotal">
																<strong><span class="price"><?php echo number_format(($this->cart->total()+$ship)- $discount_price);?> đ</span></strong>
															</td>
														</tr>


														</tbody>
													</table>

												</div>
											</div>
										</div>
									<?php }?>
								</aside>
							</div>

							
						</div>
					</div>

				</div>
				
            
          </div>
      </div>
    
  </div>
</div>
</form>






