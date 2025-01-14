<?php

echo $this->load->widget('breadcrumb');
?>

<style>
    .money{
        font-size: 15px;
    }
</style>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'  media='all'  />



<div class="container">
  <div class="content-tab-pro blog-list">
      <div class="row">
          <div class="col-lg-12">
                
                <div class="row ajaxcart" id="AjaxifyCart">


                    <div class="col-md-12">
                        <?php if(count($this->cart->contents()) > 0){ ?>
							<div class="row">
                            <div class="boxCart leftCart col-md-12 col-sm-12 col-xs-12 ">
                                <div class="cart_header_labels hidden-xs clearfix">
                                    <div class="label_item col-xs-12 col-sm-2 col-md-2">
                                        <div class="cart_product first_item">
                                            Sản phẩm
                                        </div>
                                    </div>
                                    <div class="label_item col-xs-12 col-sm-3 col-md-3">
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
                                    <div class="list_product_cart clearfix" data-id="1015162250">
                                        <div class="cpro_item image col-xs-3 col-sm-2 col-md-2">


                                            <div class="cpro_item_inner">
                                                <a href="<?php echo site_url('san-pham/'.create_slug($items['name'].'-'.$items['id']));?>" class="cart__image">
                                                    <img class="img-responsive" src="<?php echo thumb($items['image']);?>" alt="<?php echo $items['name'];?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="cpro_item text-left title col-xs-9 col-sm-3 col-md-3">
                                            <div class="cpro_item_inner">
                                                <a href="<?php echo site_url('san-pham/'.create_slug($items['name'].'-'.$items['id']));?>" class="product_name">
                                                    <?php echo $items['name'];?>
                                                </a>

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
													<div style="    display: inline-block; margin-left: 10px; vertical-align: middle;">
														<div class="plus">
															<i style="color: #7bc102;" class="fa fa-plus-circle "></i> 
														</div>
														<div class="minus"> 
															<i style="color: #7bc102;" class="fa fa-minus-circle "></i>
														</div>
													</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cpro_item line-price col-xs-12 col-sm-2 col-md-2 hidden-xs">
                                            <div class="cpro_item_inner">
                                                <span class="price product-price money_line"><span class="money"><?php echo number_format($items['subtotal']);?>₫</span></span>
                                                <input type="hidden" value="<?php echo ($items['subtotal']);?>" data-id="1015162250" class="line_money_temp">
                                            </div>
                                        </div>
                                        <div class="cpro_item remove col-xs-2 col-sm-1 col-md-1">
                                            <div class="cpro_item_inner">
                                                <a href="<?php echo site_url('gio-hang/update/'.$items['rowid']);?>" class="cart__remove ajaxcart__remove" data-id="1015162250">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>

                                    <div class="row" style="margin-bottom: 20px">
                                        <div class="col-md-10" style="text-align: right; font-size: 18px; font-weight: bold">
                                            Tổng tiền
                                        </div>
                                        <div class="col-md-2" style="text-align: right; font-size: 18px; font-weight: bold">
                                            <?php echo number_format($this->cart->total());?> đ
                                        </div>
                                    </div>
                                </div>
                            </div>




							<div class="col-md-12" style="margin-bottom: 25px;clear: both;">
                                <div class="actions-checkout">
                                    <a href="<?php echo site_url('san-pham');?>" style="display: inline-block;"><button class="btn btn-primary"><i class="fa fa-angle-left ml-xs"></i> Tiếp tục mua sắm</button></a>

                                    <a href="<?php echo site_url('gio-hang/check-out');?>"><button class="btn pull-right btn-success">Thanh toán <i class="fa fa-angle-right ml-xs"></i></button></a>
                                </div>
                            </div>
							</div>
                        <?php }else{ ?>
                        <h2 align="center">Bạn chưa chọn mua sản phẩm nào</h2>
                        <?php } ?>
                    </div>
                </div>

          </div>
      </div>
    
  </div>
</div>
<script>
$('.qty').on('change',function () {
		var id = $(this).data("id");
		var qty = $(this).val();

		$.ajax({
			type: "POST",
			url: '/gio-hang/updateQty',
			data: {id: id, qty: qty},
			success: function(data)
			{
				location.reload();

			}
		});
	});
	
$('.plus').click(function(){
	let qty = parseInt($(this).parent().parent().find('.ajaxcart__qty-num').val()) + 1;
	$(this).parent().parent().find('.ajaxcart__qty-num').val(qty).change();
	
});

$('.minus').click(function(){
	let qty = parseInt($(this).parent().parent().find('.ajaxcart__qty-num').val())-1;
	if(qty > 0)
		$(this).parent().parent().find('.ajaxcart__qty-num').val(qty).change();
});
</script>



