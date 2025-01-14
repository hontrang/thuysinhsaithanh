<?php
$this->load->helper('form');
?>
<div class="container cart shop margin-top-20 bg-white">
	<div class="row ajaxcart">
		<form action="" method="post" class="form-horizontal">
			<div class="col-md-12">
			<div class="form-group">
					<label class="control-label col-sm-2" for="phone">Chọn sản phẩm:</label>
					<div class="col-sm-4">
						<select name="product_id" class="form-control select2" required >
							<option value="">Chọn sản phẩm</option>
							<?php if(isset($products))foreach($products as $item){?>
								<option value="<?php echo $item->id;?>"><?php echo $item->name;?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-sm-2">
						<select name="size" class="form-control" required >
							<option value="XS">XS</option>
							<option value="S">S</option>
							<option value="M">M</option>
							<option value="L">L</option>
							<option value="XL">XL</option>
							<option value="XXL">XXL</option>
						</select>
					</div>
					<div class="col-sm-2">
						<input type="number" name="qty" class="form-control" placeholder="Số lượng" value="1" required />
					</div>
					<div class="col-sm-2">
						<input type="submit" name="btnaddproduct" class="btn btn-primary" value="add" />
					</div>
					
				</div>
			</div>
				
            <div class="col-md-12 margin-bottom-40">
                <?php if(count($this->cart->contents()) > 0){ ?>

                <div class="boxCart leftCart col-md-12 col-sm-12 col-xs-12 ">
                    <div class="cart_header_labels hidden-xs clearfix">
                        <div class="label_item col-xs-12 col-sm-1 col-md-1">
                            <div class="cart_product first_item">
                                Sản phẩm
                            </div>
                        </div>
                        <div class="label_item col-xs-12 col-sm-4 col-md-4">
                            <div class="cart_description item">
                                Mô Tả
                            </div>
                        </div>
                        <div class="label_item col-xs-12 col-sm-2 col-md-2">
                            <div class="cart_price item">
                                Giá
                            </div>
                        </div>
                        <div class="label_item col-xs-12 col-sm-2 col-md-2">
                            <div class="cart_quantity item">
                                Số Lượng
                            </div>
                        </div>
                        <div class="label_item col-xs-12 col-sm-2 col-md-2">
                            <div class="cart_total item">
                                Tổng
                            </div>
                        </div>
                        <div class="label_item col-xs-12 col-sm-1 col-md-1">
                            <div class="cart_delete last_item">
                                Xóa
                            </div>
                        </div>
                    </div>
                    <div class="ajax_content_cart">
                        <?php foreach ($this->cart->contents() as $items){?>
                            <div class="list_product_cart clearfix" data-id="<?php echo $items['id'];?>">
                                <div class="cpro_item image col-xs-3 col-sm-1 col-md-1">


                                    <div class="cpro_item_inner">
                                        <a href="<?php echo site_url('san-pham/'.create_slug($items['name'].'-'.$items['id']));?>" class="cart__image">
                                            <img class="img-responsive" src="<?php echo base_url('public/userfiles/'.$items['image']);?>" alt="<?php echo $items['name'];?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="cpro_item text-left title col-xs-9 col-sm-4 col-md-4">
                                    <div class="cpro_item_inner">
                                        <a href="<?php echo site_url('san-pham/'.create_slug($items['name'].'-'.$items['product_id']));?>" class="product_name">
                                            <?php echo $items['name'];?>
                                        </a>
										<div>
											Size:  <?php echo $items['size'];?>
										</div>
										<div>
											Code:  <?php echo $items['product_code'];?>
										</div>

                                    </div>
                                </div>
                                <div class="cpro_item price col-xs-9 col-sm-2 col-md-2">
                                    <div class="cpro_item_inner">
                                        <span class="price product-price"><span class="money"><?php echo number_format($items['price']);?>₫</span></span>
                                    </div>
                                </div>
                                <div class="cpro_item qty text-center col-xs-6 col-sm-2 col-md-2">
                                    <div class="cpro_item_inner">
                                        <div class="ajaxcart__qty">
                                            <input type="number" class="ajaxcart__qty-num qty" min="1" value="<?php echo ($items['qty']);?>" data-id="<?php echo ($items['rowid']);?>" aria-label="quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="cpro_item line-price col-xs-12 col-sm-2 col-md-2 hidden-xs">
                                    <div class="cpro_item_inner">
                                        <span class="price product-price money_line"><span class="money"><?php echo number_format($items['subtotal']);?>₫</span></span>
                                        <input type="hidden" value="<?php echo ($items['subtotal']);?>" data-id="<?php echo $items['id'];?>" class="line_money_temp">
                                    </div>
                                </div>
                                <div class="cpro_item remove col-xs-2 col-sm-1 col-md-1">
                                    <div class="cpro_item_inner">
                                        <a href="<?php echo site_url('tao-hoa-don/delete/'.$items['rowid']);?>" class="cart__remove ajaxcart__remove" data-id="1015162250">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
						

                        <div class="row margin-bottom-20 margin-top-20">
                            <div class="col-xs-6 col-md-4 label_item" style="text-align: right; font-size: 15px; font-weight: bold;color: #000; margin-top:10px">
                                Tổng tiền
                            </div>
                            <div class="col-xs-6 col-md-3" style="text-align: right; font-size: 15px; font-weight: bold; color: #d2322d; margin-top:10px">
                                <?php echo number_format($this->cart->total());?> đ
                            </div>
                        </div>
                    </div>
                </div>
				
				
                <?php }else{ ?>
                    <div class="col-md-12">
                        <h4 align="center" class="text-pink">Chưa có sản phẩm</h4>
                    </div>

                <?php } ?>
            </div>
			</form>
		</div>
		
    <div class="row">
            <form class="form-horizontal" action="" method="POST">
				<div class="form-group">
					<label class="control-label col-sm-2" for="phone">Ship (*):</label>
					<div class="col-sm-6">
						<input type="number" id="shipprice" name="ship" class="form-control" placeholder="Nhập giá ship" value="20000" required />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="phone">Giảm giá (*):</label>
					<div class="col-sm-6">
						<input type="number" id="giamgia" name="discount" class="form-control" placeholder="Giám giá" value="0" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="phone">Chọn khách hàng (*):</label>
					<div class="col-sm-6">
						<select name="idface" class="form-control khachhang" required >
							<option value="">Chọn khách hàng</option>
							<?php if(isset($listkhachhang))foreach($listkhachhang as $khachhang){?>
								<option value="<?php echo $khachhang->idface;?>"><?php echo $khachhang->name;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="phone">Tên Khách (*):</label>
					<div class="col-sm-3">
						<input type="text" id="c_realname" name="realname" class="form-control" placeholder="Tên khách hàng" required />
					</div>
					<div class="col-sm-3">
						<input type="text" id="c_phone" name="phone" class="form-control" placeholder="Số điện thoại khách" required />
					</div>
				</div>
			
				<div class="form-group">
					<label class="control-label col-sm-2" for="phone">Địa chỉ (*):</label>
					<div class="col-sm-6">
						<input type="text" id="c_address" name="address" class="form-control" placeholder="Địa chỉ" required />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="phone">Thành phố (*):</label>
					<div class="col-sm-3">
						<input type="text" id="c_city" name="city" class="form-control" placeholder="Quận / Huyện" required />
					</div>
					<div class="col-sm-3">
						<input type="text" id="c_state" name="state" class="form-control" placeholder="Tỉnh/Thành phố" required />
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-sm-2" for="phone">Ghi chú:</label>
					<div class="col-sm-6">
						<input type="text" name="note" class="form-control" placeholder="Ghi chú cho đơn hàng" />
					</div>
				</div>
				
				<div class="row margin-bottom-20 margin-top-20">
                            <div class="col-xs-6 col-md-5 label_item" style="text-align: right; font-size: 15px; font-weight: bold;color: #000; margin-top:10px">
                                Tổng tiền thanh toán
                            </div>
                            <div class="col-xs-6 col-md-3" style="text-align: right; font-size: 19px; font-weight: bold; color: #d2322d; margin-top:10px;     margin-bottom: 30px;">
                                <span id="tongtt"><?php echo number_format($this->cart->total()+20000);?></span> đ
                            </div>
                        </div>
						
				<div class="form-group">
				
					<div class="col-sm-12 pull-center" style="text-align: center">
						<input type="submit" name="btnsend" class="btn btn-danger" value="Gửi hóa đơn" />
					</div>
					<div style="text-align: center; color: red; font-weight: bold;">
						<?php echo $this->session->flashdata("msg"); ?>
					</div>
				</div>
			</form>



    </div>
	
	<div>
		<?php //echo $repopost; ?>
	</div>
</div>