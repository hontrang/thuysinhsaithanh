<?php

$lang = 'vi';
if($this->session->userdata("lang") != "")
    $lang = $this->session->userdata("lang");

?>

<style>
	footer {
		margin-top: 0px;
		padding-top: 15px;
		background-color: #fff;
		border-top: 5px solid #b40000;
	}
</style>
<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                   <h3 class="title">SÂM HÀN QUỐC LONG HỢP BIÊN HÒA</h3>
				<h4> Công ty Cổ Phần Long Hợp | Mã số thuế: 3602192953 </h4>
				<p><i class="fas fa-map-marker-alt" aria-hidden="true"></i><strong> Địa chỉ:</strong> <?php echo $site_config['address_vi'];?></p>	                
                <p><i class="fa fa-phone-square" aria-hidden="true"></i><strong> Điện thoại:</strong> <strong><a href="tel:<?php echo $this->lang->line('phone_muahang');?>"><?php echo $this->lang->line('phone_muahang');?></a> </strong></p>
                       
                <p><i class="fa fa-envelope" aria-hidden="true"></i><strong> Email:</strong> <a href="mailto:<?php echo $site_config['email'];?>"><?php echo $site_config['email'];?> </a></p>  
				<p><i class="fas fa-globe"></i><strong> Website:</strong> <a href="https://samlonghop.vn/"> www.samlonghop.vn</a></p>  
				
                </div>
           
                <div class="col-md-3">
                    <?php echo $site_config['footer_info_3'];?>
                </div>
                <div class="col-md-3">
                    <h3 class="title">THỐNG KÊ TRUY CẬP</h3>
					
					<?php
						echo $this->load->widget('statistics_box');
						?>
                </div>
            </div>
				<div class="footer-bottom">
                <div class="container">
                    <p> Website đang chạy thử nghiệm chờ giấy phép của Bộ TT & TT</p>
                </div>
            </div>
		</div>
    </footer>
