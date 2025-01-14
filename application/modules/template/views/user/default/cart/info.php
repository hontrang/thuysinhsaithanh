<?php if(count($this->cart->contents()) > 0){ ?>
<div id="cart">
    <ul class="nav nav-responsive">
        <li class="dropdown">
            <a class="btn btn-sm tb_no_text tb_no_caret tbStickyOnly" href="/gio-hang.html"><i class="ico-mdi-basket"></i></a>
            <h3 class="heading">
                <a href="/gio-hang.html">
                    <i class="tb_icon ico-mdi-basket"></i>
                    <span class="tb_label">Giỏ hàng</span>
                    <span class="tb_items"><?php echo $this->cart->total_items();?></span>
                    <span class="tb_total border"><?php echo number_format($this->cart->total());?> <span class="tb_currency tb_after">đ</span></span>
                </a>
            </h3>
            <div class="dropdown-menu">
                <div class="content">
                    <h3>Giỏ hàng</h3>
                    <div class="mini-cart-info cart-info">
                        <table class="table table-striped">
                            <?php foreach ($this->cart->contents() as $items){?>
                            <tr>
                                <td class="image">
                                    <a href="<?php echo site_url('san-pham/'.create_slug($items['name'].'-'.$items['id']));?>">
                                        <img src="<?php echo base_url('public/userfiles/'.$items['image']);?>" alt="<?php echo $items['name'];?>" title="<?php echo $items['name'];?>" class="img-thumbnail" />
                                    </a>
                                </td>
                                <td class="name"><a href="<?php echo site_url('san-pham/'.create_slug($items['name'].'-'.$items['id']));?>"><?php echo $items['name'];?></a>
                                </td>
                                <td class="quantity">x<?php echo ($items['qty']);?></td>
                                <td class="total"><?php echo number_format($items['subtotal']);?> đ</td>
                                <td class="remove"><button type="button" onclick="cart.remove('<?php echo ($items['rowid']);?>');" title="Loại bỏ" class="btn btn-default btn-sm"><i class="fa fa-times"></i></button></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="mini-cart-total cart-total">
                        <table>
                            <tr>
                                <td class="right"><strong>Thành tiền:</strong></td>
                                <td class="right"><?php echo number_format($this->cart->total());?> đ</td>
                            </tr>
                            <tr>
                                <td class="right"><strong>Tổng cộng :</strong></td>
                                <td class="right"><?php echo number_format($this->cart->total());?> đ</td>
                            </tr>
                        </table>
                    </div>
                    <div class="checkout buttons">
                        <a class="btn btn-sm" href="/gio-hang.html">Xem chi tiết giỏ hàng</a>
                        <a class="btn btn-sm" href="/gio-hang/thanh-toan.html">Thanh toán</a>
                    </div>
                    <script>
                        tbUtils.removeClass(tbRootWindow.document.querySelector('.tb_wt_header_cart_menu_system .table-striped'), 'table-striped');
                        Array.prototype.forEach.call(tbRootWindow.document.querySelectorAll('.tb_wt_header_cart_menu_system td .btn'), function(el) {
                            tbUtils.removeClass(el, 'btn-danger btn-xs');
                            tbUtils.addClass(el, 'btn-default btn-sm tb_no_text');
                        });
                    </script>
                </div>
            </div>
        </li>
    </ul>
</div>
<?php }else{ ?>

    <div id="cart">
        <ul class="nav nav-responsive">
            <li class="dropdown">
                <a class="btn btn-sm tb_no_text tb_no_caret tbStickyOnly" href="/gio-hang.html"><i class="ico-mdi-basket"></i></a>
                <h3 class="heading"><a href="/gio-hang.html"> <i class="tb_icon ico-mdi-basket"></i> <span class="tb_label">Giỏ hàng</span> <span class="tb_items">0</span> <span class="tb_total border">0 <span class="tb_currency tb_after">đ</span></span> </a></h3>
                <div class="dropdown-menu">
                    <div class="content"><h3>Giỏ hàng</h3>
                        <div class="empty">Không có sản phẩm trong giỏ hàng!</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
<?php } ?>
