<div class="breadcrumb container fz14">
        <ul itemscope="" itemtype="http://schema.org/BreadcrumbList" >
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a href="<?php echo site_url();?>" itemprop="item"><span itemprop="name">Trang chủ</span></a>
           <meta itemprop="position" content="1" />    
        </li>
           <!---->
        <?php if(!empty($breadcrumb)) {
            $i= 2;
            foreach ($breadcrumb as $title_br => $link_br) {
            if($link_br != ""){
                ?>            
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <a href="<?php echo site_url($link_br);?>" itemprop="item"><span itemprop="name"><?php echo $title_br;?></span></a>
                    <meta itemprop="position" content="<?php echo $i;?>" />    
                </li>
        <?php }else{ ?>
        
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>" itemprop="item"><span itemprop="name"><?php echo $title_br;?></span></a>
           <meta itemprop="position" content="<?php echo $i;?>" />    
        </li>
        <?php } } } ?>
        </ul>
</div>

