<?php
    if(isset($info->banner) and $info->banner != "")
        $banner = base_url('public/userfiles/'.$info->banner);
    else
        $banner = "/public/userfiles/1.jpg"
?>


<div class="row_LO3Jw row-wrap tb_mb_40">
    <div class="row tb_gut_xs_30 tb_gut_sm_30 tb_gut_md_40 tb_gut_lg_40">
        <div class="col_K0IY0 col col-xs-12 col-sm-12 col-md-12 col-lg-12 col-align-default col-valign-top tb_pt_0 tb_pr_0 tb_pb_0 tb_pl_0">
            <div id="BreadcrumbsSystem_W529tMG3" class="tb_wt tb_wt_breadcrumbs_system display-block tb_system_breadcrumbs">
                <ul class="breadcrumb fz14">
                    <li><a href="<?php echo site_url();?>"><?php echo $this->lang->line('home');?></a></li>
                    <?php if(!empty($breadcrumb)) {
                        foreach ($breadcrumb as $title_br => $link_br) {
                            if($link_br != ""){
                                ?>
                                <li><a href="<?php echo site_url($link_br);?>" title="<?php echo $title_br;?>"><?php echo $title_br;?></a></li>
                            <?php }else{ ?>

                            <?php } } } ?>
                </ul>
            </div>
            <div id="PageTitleSystem_R06Mg5pa" class="tb_wt tb_wt_page_title_system display-block tb_system_page_title"><h1><?php echo $title;?></h1></div>
        </div>
    </div>
</div>
