<?php
echo $this->load->widget('breadcrumb_box');
?>
<div class="container">
    <div class="row bds-view  sidebar_outner">
        <div class="col-md-9">
            
            <?php if(!empty($bds)){?>
            <div class="row sidebar_outner">
                <div class="col-md-12">
                    <div class="row margin-bottom-10">
                        <div class="col-md-12 margin-bottom-15">
                            <h4 class="green bottom-line margin-top-20"><i class="fa fa-list" aria-hidden="true"></i> Mô tả</h4>
                            <p class="bds-detail"><?php echo $bds->detail;?></p>

                        </div>

                    </div>

                    <div class="row margin-bottom-12">
                        <div class="col-md-12">
                            <ul class="myTab">
                                <li class="active"><a data-target="#album" data-toggle="tab" onclick="show_tab('album');" aria-expanded="true"><i class="fa fa-picture-o" aria-hidden="true"></i> Hình ảnh</a></li>
                                <li class=""><a data-target="#bando" data-toggle="tab" onclick="show_tab('bando');" aria-expanded="false"><i class="fa fa-map" aria-hidden="true"></i> Bản đồ</a></li>
                            </ul>
                            <div id="album" class="tab-sub">
                                <div id="hinhanh" class="royalSlider rsDefault">
                                    <?php if(!empty($images))foreach ($images as $image){ ?>
                                        <a class="rsImg bugaga" data-rsBigImg="<?php echo base_url('public/userfiles/'.$image->path);?>" href="<?php echo base_url('public/userfiles/'.$image->path);?>"><img width="96" height="72" class="rsTmb" src="<?php echo base_url('public/userfiles/'.$image->path);?>" /></a>
                                    <?php }?>
                                </div>
                            </div>

                            <div id="bando" class="tab-sub">
                                <div id="map"></div>
                            </div>
                        </div>
                        

                    </div>
					
					<div class="row margin-bottom-10">
						<div class="col-md-8 margin-bottom-15">
							<table class="table-bordered table-responsive bds-info">
                                <h4 class="margin-top-15"><i class="fa fa-info-circle" aria-hidden="true"></i> Thông tin BĐS</h4>
                                <tbody>
                                <tr>
                                    <th>Giá</th>
                                    <td colspan="3"><?php echo price_format($bds->price);?></td>
                                </tr>
                                <tr>
                                    <th>Diện tích</th>
                                    <td colspan="3"><?php if($bds->area > 0){echo number_format($bds->area);}else{echo "Không xác định";}?> m<sup>2</sup></td>
                                </tr>
								<?php if($bds->landlong != "" and $bds->landlong != 0){?>
                                <tr>
                                    <th>Kích thước</th>
                                    <td colspan="3"><?php if($bds->landlong != "" and $bds->landlong != 0){echo $bds->landlong;}else{echo "-";}?> x <?php if($bds->landwidth != "" and $bds->landwidth != 0){echo $bds->landwidth;}else{echo "-";}?> m</td>
                                </tr>
								<?php } ?>
                                <tr>
                                    <th>Tình trạng pháp lý</th>
                                    <td colspan="3"><?php echo getPhapLy($bds->juridical);?></td>
                                </tr>
								<?php if($bds->street_width != "" and $bds->street_width != 0){?>
                                <tr>
                                    <th>Đường trước nhà</th>
                                    <td colspan="3"><?php if($bds->street_width != "" and $bds->street_width != 0){echo $bds->street_width;}else{echo "---";}?> m</td>
                                </tr>
								<?php } ?>
                                <tr>
                                    <th>Hướng</th>
                                    <td><?php echo getHuong($bds->direction);?></td>
                                </tr>
								<?php if($bds->facade != "" and $bds->facade != 0){?>
								<tr>
                                    <th>Mặt tiền</th>
                                    <td><?php if($bds->facade != "" and $bds->facade != 0){echo $bds->facade;}else{echo "---";}?> m</td>
                                </tr>
								<?php } ?>
								<?php if($bds->floor != "" and $bds->floor != 0){?>
                                <tr>
                                    <th>Số tầng</th>
                                    <td colspan="3"><?php if($bds->floor != "" and $bds->floor != 0){echo $bds->floor;}else{echo "---";}?></td>
                                </tr>
								<?php } ?>
								<?php if($bds->toilet != "" and $bds->toilet != 0){?>
                                <tr>
                                    <th>Phòng tắm</th>
                                    <td><?php if($bds->toilet != "" and $bds->toilet != 0){echo $bds->toilet;}else{echo "---";}?></td>
                                </tr>
								<?php } ?>
								<?php if($bds->bedroom != "" and $bds->bedroom != 0){?>
								<tr>
                                    <th>Phòng ngủ</th>
                                    <td><?php if($bds->bedroom != "" and $bds->bedroom != 0){echo $bds->bedroom;}else{echo "---";}?></td>
                                </tr>
								<?php } ?>
								
                                </tbody>
                            </table>
						</div>
						<div class="col-md-4 margin-bottom-15">
							<div class="contact-info margin-top-15">
								<h4 class=""><i class="fa fa-list" aria-hidden="true"></i> Liên hệ</h4>
								<form method="POST" id="form-contact-bds">
									<div class="row">
										<div class="col-md-12">
											<div class="user_name"><i class="fa fa-user"></i> <?php echo $user_post->fullname;?></div>
											<div class="user_phone"><i class="fa fa-phone"></i> <?php echo $user_post->phone;?></div>
											<div class="user_phone"><i class="fa fa-envelope-o"></i> <?php echo $user_post->email;?></div>
										</div>
										
									</div>
								</form>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="share-box">
								<div class="addthis_inline_share_toolbox"></div> <div class="zalo-share-button" data-href="" data-oaid="1438295244875428913" data-layout="4" data-color="blue" data-customize=false></div>
						   </div>
						</div>
						
                    </div>
					
                   
                </div>

            </div>


            <?php }else{ ?>

                <h3 align="center">Không tìm thất nội dung tin này</h3>
            <?php } ?>



        </div>
		<div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo $this->load->widget('bds_cat_box');
                    ?>
                </div>
                <div class="col-md-12">
                    <?php
                    echo $this->load->widget('supervip_box');
                    ?>
                </div>

            </div>
		</div>

    </div>

</div>



