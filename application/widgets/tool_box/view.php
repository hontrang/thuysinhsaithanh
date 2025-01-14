<?php
$lang = 'vi';
if($this->session->userdata("lang") != "")
    $lang = $this->session->userdata("lang");
?>

<div class="cr_title_green_main">
    <div class="padding-top-7">
        <div class="cr_title_green cr_title_green_main_text"><h2><?php echo $this->lang->line("tool");?></h2></div>
        <div class="cr_title_triangle"></div>
    </div>
</div>
<div class="sidebar-item row">
    <?php if(isset($tools))foreach ($tools as $tool){?>
    <div class="col-sm-12 col-xs-12">
        <a href="<?php echo $tool->url;?>" style="background-image:url('<?php echo base_url('public/userfiles/'.$tool->image);?>');" title="<?php echo $tool->name;?>"> <span><?php echo $tool->name;?></span> </a>
    </div>
    <?php }?>
</div>