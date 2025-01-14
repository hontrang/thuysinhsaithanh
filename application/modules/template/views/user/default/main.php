<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow" />
	<link rel="canonical" href="<?php echo site_url(uri_string());?>" />
    <meta name="keywords" content="<?php if(isset($keyword) and $keyword != "")echo $keyword;else echo $site_config['keyword'];?>" />
    <meta name="description" content="<?php if(isset($description))echo max_len($description,250);else echo max_len($site_config['description_'.$lang],250);?>" />
    <meta name="viewport" content="width=device-width" />
	<meta name="geo.region" content="VN" />
	<meta name="geo.placename" content="Sâm Hàn Quốc Long Hợp Biên Hòa" />
	<meta name="geo.position" content="10.957149564989832; 106.86072329902746" />
	<meta name="ICBM" content="10.957149564989832, 106.86072329902746" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php if(isset($title) and $title != "")echo $title;else echo $site_config['title_'.$lang];?>" />
    <meta property="og:image" content="<?php if(isset($image_share))echo $image_share;else echo base_url('public/userfiles/share-img2.jpg');?>" />
    <meta property="og:url" content="<?php echo site_url(uri_string());?>" />
    <meta property="og:site_name" content="Sâm Hàn Quốc Long Hợp Biên Hòa" />
    <meta property="og:description" content="<?php if(isset($description))echo max_len($description,250);else echo max_len($site_config['description_'.$lang],250);?>" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="628" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta name="p:domain_verify" content="010538164db9806fc0e5e70759ee4f11"/>
	<meta name="msvalidate.01" content="66BC76AF3B130626B6824B7D9C628EE4" />
    <title><?php if(isset($title) and $title != "")echo $title;else echo $site_config['title_'.$lang];?></title>
	<link rel="stylesheet" href="/public/templates/user/default/template/dienmaynguoiviet/script/animate.css">
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/assets/owl.carousel.min.css'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/assets/owl.theme.default.min.css'>
    <link rel="stylesheet" href="/public/templates/user/default/template/dienmaynguoiviet/script/styles.css?v=1.4">
    <link rel="stylesheet" href="/public/templates/user/default/template/dienmaynguoiviet/script/customs.css?v=1.4">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&subset=vietnamese" rel="stylesheet">
	

    <link rel="stylesheet" href="/public/templates/user/default/template/dienmaynguoiviet/script/jquery.fancybox.css">

    <script src="/public/templates/user/default/javascript/dist/jquery.min.js"> </script>
   <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.0/owl.carousel.min.js'></script>
    
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "<?php echo site_url();?>",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "/tim-kiem?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
	<?php echo $site_config['google-analytic'];?>
</head>
<?php 
    $bg = "bg-fff";
    if($module == "home")
        $bg = "bg-gray";

?>

<body class="<?php echo $bg;?>">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KNHZKK9H"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- DOS -->
	<?php 
		$last = array('Pham','Dang','Vu','Hoang','Huu','Le','Do','Hoang','Lâm','Cao');
		$first = array('Linh','Dat', 'Tuan','Hoang','Ly','Loan','Yen','Trang','Tram','Ngoc','Thao','Tinh','Hang','Lan','Lau','Dung','Nhung','Loc','Tri','Khanh','Phu','Hieu');
	?>
	<script type="application/ld+json">
	{
	  "@context": "https://schema.org/", 
	  "@type": "Product", 
	  "name": "<?php if(isset($title) and $title != "")echo $title;else echo $site_config['title_'.$lang];?>",
	  "image": "<?php if(isset($image_share))echo $image_share;else echo base_url('public/userfiles/share-df.jpg');?>",
	  "aggregateRating": {
		"@type": "AggregateRating",
		"ratingValue": "5",
		"bestRating": "5",
		"worstRating": "",
		"ratingCount": "<?php echo rand(100,500);?>",
		"reviewCount": "<?php echo rand(100,500);?>"
	  },
	  "review": [{
		"@type": "Review",
		"name": "Name",
		"reviewBody": "Sản phẩm tuyệt vời",
		"reviewRating": {
		  "@type": "Rating",
		  "ratingValue": "5",
		  "bestRating": "5",
		  "worstRating": ""
		},
		"datePublished": "2023-11-30",
		"author": {"@type": "Person", "name": "<?php echo $first[rand(0,count($first)-1)];?>  <?php echo $last[rand(0,count($last)-1)];?>"}
	  },
	  {
		"@type": "Review",
		"name": "Name",
		"reviewBody": "Sản phẩm chính hãng, uy tín, tuyệt vời",
		"reviewRating": {
		  "@type": "Rating",
		  "ratingValue": "5",
		  "bestRating": "5",
		  "worstRating": ""
		},
		"datePublished": "2023-11-30",
		"author": {"@type": "Person", "name": "<?php echo $first[rand(0,count($first)-1)];?>  <?php echo $last[rand(0,count($last)-1)];?>"}
	  },
	  {
		"@type": "Review",
		"name": "Name",
		"reviewBody": "Sâm rất tuyệt vời",
		"reviewRating": {
		  "@type": "Rating",
		  "ratingValue": "5",
		  "bestRating": "5",
		  "worstRating": ""
		},
		"datePublished": "2023-11-30",
		"author": {"@type": "Person", "name": "<?php echo $first[rand(0,count($first)-1)];?>  <?php echo $last[rand(0,count($last)-1)];?>"}
	  },
	  {
		"@type": "Review",
		"name": "Name",
		"reviewBody": "tuyệt vời",
		"reviewRating": {
		  "@type": "Rating",
		  "ratingValue": "5",
		  "bestRating": "5",
		  "worstRating": ""
		},
		"datePublished": "2023-11-30",
		"author": {"@type": "Person", "name": "<?php echo $first[rand(0,count($first)-1)];?>  <?php echo $last[rand(0,count($last)-1)];?>"}
	  },
	  {
		"@type": "Review",
		"name": "Name",
		"reviewBody": "Giao hàng nhanh, sản phẩm OK",
		"reviewRating": {
		  "@type": "Rating",
		  "ratingValue": "5",
		  "bestRating": "5",
		  "worstRating": ""
		},
		"datePublished": "2023-11-30",
		"author": {"@type": "Person", "name": "<?php echo $first[rand(0,count($first)-1)];?>  <?php echo $last[rand(0,count($last)-1)];?>"}
	  }
	  ,{
		"@type": "Review",
		"name": "Name",
		"reviewBody": "Cao sâm hàn quốc đúng Chất lượng",
		"reviewRating": {
		  "@type": "Rating",
		  "ratingValue": "4",
		  "bestRating": "5",
		  "worstRating": ""
		},
		"datePublished": "2023-11-30",
		"author": {"@type": "Person", "name": "<?php echo $first[rand(0,count($first)-1)];?>  <?php echo $last[rand(0,count($last)-1)];?>"}
	  },
	  {
		"@type": "Review",
		"name": "Name",
		"reviewBody": "Cửa hàng Sâm Biên Hòa uy tín",
		"reviewRating": {
		  "@type": "Rating",
		  "ratingValue": "4",
		  "bestRating": "5",
		  "worstRating": ""
		},
		"datePublished": "2023-11-30",
		"author": {"@type": "Person", "name": "<?php echo $first[rand(0,count($first)-1)];?>  <?php echo $last[rand(0,count($last)-1)];?>"}
	  }]
	}
	</script>

    <?php
    echo $this->load->widget('menu_top');
    ?>

    <!-- begin main -->
    <main>
    <?php
        echo $this->load->view('user/'.$current_template.'/'.$module.'/'.$method);
        ?>

    </main>
    <!-- end main -->


    <div id="category-fixed" class="animated slideInLeft">

        <?php if(isset($product_cats))foreach($product_cats as $cat){?>
        <a href="javascript:void(0);" id="cat-<?php echo $cat->slug;?>">
            <i class="icons icon-cat-main icon-cat-1" style="background-image:url('<?php echo thumb($cat->image,"45x45");?>')"></i>
            <span class="title"><?php echo $cat->name;?></span>
        </a>
        <?php } ?>
    </div>
    <!--<hr>-->
    <!-- begin footer -->
    <?php
    echo $this->load->widget('footer');
    ?>
    <button class="hidden-xs" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-angle-up"></i></button>
    <!-- end footer -->
    
    <style>
    .itemFixed.hotLine {
        height: 42px;
		width: 156px;
		background: #ac0202;
		left: 0;
		bottom: 42px;
		border-radius: 0px 5px 5px 0px;
		position: fixed;
		z-index: 1;
    }
    .itemFixed.hotLine label {
        display: block;
        position: relative;
    }
    .itemFixed.hotLine label a > span {
        display: inline-block;
        vertical-align: middle;
        position: absolute;
        right: -25px;
        width: 40px;
        height: 40px;
        /*background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAGXRFWâ€¦UnOVF88WwlvPvJvDTgi2fmgMLhu3jWS3TBe/HsPy2cvxNgACS8FV7gX0CGAAAAAElFTkSuQmCC) contain no-repeat;*/
    }
    .itemFixed.hotLine label p {
        display: inline-block;
		vertical-align: middle;
		color: #fff;
		font-size: 14px;
		margin: 0;
		font-weight: normal;
		padding-left: 37px;
		line-height: 17px;
		padding-top: 5px;
    }
    .itemFixed.hotLine label i {
        z-index: 1;
        position: absolute;
        top: 8px;
        left: 6px;
        display: inline-block;
        width: 21px;
        height: 21px;
        /* background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWâ€¦ehh8UVm8Rp8A2Ex9GT+/V0A3if0o1i+aLLYC4r/gv4KcAAhgo0rNDuwmQAAAAASUVORK5CYII=) no-repeat; */
        cursor: pointer;
        color: #FFF;
    }  

	.viber{position: fixed;
    right: 19px;
    z-index: 99;
    bottom: 190px;}
	.viber .viber-icon{height:44px;width:44px;line-height:1;padding:10px;float:left;text-align:center;border-radius:50%;font-weight:500;font-size:26px;background:#4267b2;color:#fff;box-shadow:0 0 0 0 #4267b2;}
	.widget-zalo {
		position: fixed;
		right: 19px;
		z-index: 99;
		bottom: 75px;
	}
	.widget-zalo .widget-circle {
		background: rgba(61,157,215,1);
		background: -moz-linear-gradient(top,rgba(61,157,215,1) 0,rgba(32,124,229,1) 100%);
		background: -webkit-gradient(left top,left bottom,color-stop(0,rgba(61,157,215,1)),color-stop(100%,rgba(32,124,229,1)));
		background: -webkit-linear-gradient(top,rgba(61,157,215,1) 0,rgba(32,124,229,1) 100%);
		background: -o-linear-gradient(top,rgba(61,157,215,1) 0,rgba(32,124,229,1) 100%);
		background: linear-gradient(to bottom,rgba(61,157,215,1) 0,rgba(32,124,229,1) 100%);
	}

	.widget-zalo .widget-circle {
		position: relative;
		display: inline-block;
		width: 50px;
		height: 50px;
		background-color: #003469;
		-webkit-border-radius: 50%;
		border-radius: 50%;
	}
	.widget-zalo .widget-circle .fa-icon {
		background-image: url(/public/userfiles/icon-zalo.png);
	}
	.widget-zalo .widget-circle .fa-icon {
		position: absolute;
		left: 10px;
		top: 10px;
		width: 30px;
		height: 30px;
		background-size: 30px;
		background-repeat: no-repeat;
	}
	@media (max-width: 768px){
		.itemFixed.hotLine{
			width: 150px;
			bottom: 0;
			border-radius: 0px 5px 0 0px;
		}
	}

    </style>
	
	
<!-- suport mobile-->
		<style>
		@media (max-width: 900px){
		.bottom-contact1 {
			display: block;
			position: fixed;
			bottom: 0;
			background: white;
			width: 100%;
			z-index: 99;
			box-shadow: 2px 1px 9px #dedede;
			border-top: 1px solid #eaeaea;
		}
		.bottom-contact1 ul li {
			border-right: 1px solid #f3efef;
			width: 25%;
			float: left;
			list-style: none;
			text-align: center;
			font-size: 13.5px;
		}

		.bottom-contact1 ul li img {
			width: 35px;
			margin-top: 10px;
			margin-bottom: 0px;
		}
		.bottom-contact1 ul li span {
			color: #000;
			font-size: 12px;
		}
		a {
		text-decoration: none;
		}
		}
		@media(max-width: 900px){
		.hidden-xs{
			display: none;
		}
		}
</style>
<div class="bottom-contact1 hidden-lg hidden-md">
			<ul style="padding: 0;">
				
				<li>
					<a id="goidien" href="tel:<?php echo str_replace(" ","",$site_config['phone']);?>">
						<img src="/public/userfiles/icon-mobile/icon-phone-mobile.png">
						<br>
						<span>Gọi điện</span>
					</a>
				</li>
				
				<li>
					<a id="chatzalo" href="https://zalo.me/<?php echo str_replace(" ","",$site_config['phone']);?>">
						<img src="/public/userfiles/icon-mobile/icon-zalo-mobile.png">
						<br>
						<span>Chat zalo</span>
					</a>
				</li>
				<li>
					<a id="chat-mes" href="https://m.me/samhanquoclonghop">
						<img src="/public/userfiles/icon-mobile/icon-mesenger-mobile.png">
						<br>
						<span>Messenger</span>
					</a>
				</li>
				<li>
					<a id="maps" href="">
						<img src="/public/userfiles/icon-mobile/map.png">
						<br>
						<span>Chỉ đường</span>
					</a>
				</li>
				
				
			</ul>
		</div>
		<!-- End suport mobile-->
    <div class="itemFixed hotLine trans hidden-xs">
        <label>
            <a href="tel:<?php echo $site_config['phone'];?>" title="Hotline">
                <span></span>
                <p>Hotline <br> <?php echo $this->lang->line('phone_muahang');?><?php if($this->lang->line('phone_muahang2') != ""){?><span class="hidden-xs"> - <?php echo $this->lang->line('phone_muahang2');?><span><?php } ?></p>
            </a>
            <i><i class="fa fa-phone"></i></i>
        </label>
    </div>
	
	<a class="widget-zalo hidden-xs" href="https://zalo.me/<?php echo str_replace(" ","",$site_config['phone']);?>" title="Chat trên Zalo" target="_blank"><span class="widget-circle"><i class="fa-icon">&nbsp;</i></span></a>


    <!-- <script src="/public/templates/user/default/javascript/dist/hurastore.js"> </script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha512-oBTprMeNEKCnqfuqKd6sbvFzmFQtlXS3e0C/RGFV0hD6QzhHV+ODfaQbAlmY6/q0ubbwlAM/nCJjkrgA3waLzg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/public/templates/user/default/template/dienmaynguoiviet/script/main.js"></script>
    
	
	<?php
		if(isset($scripts))
			foreach ($scripts as $script)
				echo $script;
		?>
	
    <script type="text/javascript"> 
	$(document).on('click','.toggle-menu',function(){$(this).closest('.nav-menu').find('.navbar-collapse').slideToggle();return false;});
	if($(window).width() < 980){
		$(".content-text img").each(function(){$(this).removeAttr( "height" ).removeAttr( "width" ).removeAttr( "style" ).addClass("img-fluid");});
		
	}
	$(".left_q_item img").each(function(){$(this).removeAttr( "height" ).removeAttr( "width" ).removeAttr( "style" ).addClass("img-fluid");});
  $(document).ready(function() {
      var owl1 = $("#owl1");
      var owl2 = $("#owl2");
      var carousel= owl1.owlCarousel({
        items : 1,
          singleItem : true,
          autoPlay:4000,
          slideSpeed : 1000,
          lazyLoad : true,
          navigation: false,
          pagination:false,
          afterAction : syncPosition,
          responsiveRefreshRate : 200,
      });
      $('.prev_slide').click(function(){
        carousel.trigger('owl.next');
      });
      $('.next_slide').click(function(){
        carousel.trigger('owl.prev');
      });
      owl2.owlCarousel({
          items : 3,
          pagination:false,
          responsiveRefreshRate : 100,
          afterInit : function(el){
              el.find(".owl-item").eq(0).addClass("synced");
          }
      });
  
      function syncPosition(el){
          var current = this.currentItem;
          $("#owl2")
              .find(".owl-item")
              .removeClass("synced")
              .eq(current)
              .addClass("synced")
          if($("#owl2").data("owlCarousel") !== undefined){
              center(current)
          }
      }
  
      $("#owl2").on("click", ".owl-item", function(e){
          e.preventDefault();
          var number = $(this).data("owlItem");
          owl1.trigger("owl.goTo",number);
      });
  
      function center(number){
          var owl2visible = owl2.data("owlCarousel").owl.visibleItems;
          var num = number;
          var found = false;
          for(var i in owl2visible){
              if(num === owl2visible[i]){
                  var found = true;
              }
          }
          if(found===false){
              if(num>owl2visible[owl2visible.length-1]){
                  owl2.trigger("owl.goTo", num - owl2visible.length+2)
              }else{
                  if(num - 1 === -1){
                      num = 0;
                  }
                  owl2.trigger("owl.goTo", num);
              }
          } else if(num === owl2visible[owl2visible.length-1]){
              owl2.trigger("owl.goTo", owl2visible[1])
          } else if(num === owl2visible[0]){
              owl2.trigger("owl.goTo", num-1)
          }
      }
});
</script>
    <script>
       
            
        $(document).ajaxStop(function() {
            
            
            $('#viewtop').owlCarousel({
                loop: true,
                items: 8,
                margin: 10,
                nav: false,
                dots: false,
                responsive: {
                    0: {
                        items: 2
                    },
                    768: {
                        items: 4
                    },
                    992: {
                        items: 6
                    },
                    1200: {
                        items: 8
                    }
                }
            });
        });
        
    </script>
    <!---//script hien thi tat ca cac trang-->
    <script>
        if (window.innerWidth > 1500) {
            $("#b_scroll_left,#b_scroll_right").show();
        }


        function show_search() {
            $('.show-search').on('click', function() {
                $(this).siblings('form').toggleClass('active');
            });
            window.addEventListener('keyup', function(e) {
                if (e.keyCode === 27) {
                    $('.search form').removeClass('active');
                }
            });
        }
    </script>



    <script type="text/javascript">
        function formatCurrency(a) {
            var b = parseFloat(a).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString();
            var len = b.length;
            b = b.substring(0, len - 3);
            return b;
        }


        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
        $(document).ready(function() {
            var curr_text = "";
            var count_select = 0;
            var curr_element = "";
            $("#text_search").keyup(function(b) {
                htmlResult = "";
                if (b.keyCode != 38 && b.keyCode != 40) {
                    inputString = $(this).val();
                    $("#keySearchResult").html(inputString);
                    if (inputString.trim() != '') {
                        urlSearch = '/tim-kiem?view=json&q=' + encodeURIComponent(inputString);
                        $.getJSON(urlSearch, function(result) {
                            var data = result;
                            Object.keys(data).forEach(function(key, keyIndex) {
                                var name = data[keyIndex].productName;
                                var url = data[keyIndex].productUrl;
                                var image = data[keyIndex].productImage.medium;
                                var price = formatCurrency(data[keyIndex].price);
                                if (price != 0)
                                    price = price + 'vnđ‘';
                                else
                                    price = "Liên hệ"

                                htmlResult += "<div class=\"autocomplete-suggestion\" onclick=\"window.location='" + url + "'\">";
                                htmlResult += "<table><tbody><tr>";
                                htmlResult += "<td style=\"vertical-align:top\"><a href='" + url + "'><img src='" + image + "' width='50' style='margin-right:10px;'/></a></td>";
                                htmlResult += "<td style='vertical-align:top; color:red; line-height:18px;'><a class='suggest_link' href='" + url + "'>" + name + "</a><br/>Giá:" + price + "</td>";
                                htmlResult += "</tr></tbody></table></div>";
                            });
                            $(".autocomplete-suggestions").html(htmlResult);
                            $(".autocomplete-suggestions").show();
                        });

                    } else {
                        $(".autocomplete-suggestions").hide();
                    }
                }
            });
            $('body').click(function() {
                $(".autocomplete-suggestions").hide();
            });
        });
    </script>
    <!---//script hien thi homepage-->
    <script>
        $(document).ready(function() {
            var sync1 = $("#sync1");
            var sync2 = $("#sync2");
            var carousel = sync1.owlCarousel({
                items: 1,
                singleItem: true,
                autoPlay: 4000,
                slideSpeed: 1000,
                lazyLoad: true,
                navigation: false,
                pagination: false,
                afterAction: syncPosition,
                responsiveRefreshRate: 200,
            });
            $('.prev_slide').click(function() {
                carousel.trigger('owl.next');
            });
            $('.next_slide').click(function() {
                carousel.trigger('owl.prev');
            });
            sync2.owlCarousel({
                items: 5,
                pagination: false,
                responsiveRefreshRate: 100,
                afterInit: function(el) {
                    el.find(".owl-item").eq(0).addClass("synced");
                }
            });

            function syncPosition(el) {
                var current = this.currentItem;
                $("#sync2")
                    .find(".owl-item")
                    .removeClass("synced")
                    .eq(current)
                    .addClass("synced")
                if ($("#sync2").data("owlCarousel") !== undefined) {
                    center(current)
                }
            }

            $("#sync2").on("click", ".owl-item", function(e) {
                e.preventDefault();
                var number = $(this).data("owlItem");
                sync1.trigger("owl.goTo", number);
            });

            function center(number) {
                var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
                var num = number;
                var found = false;
                for (var i in sync2visible) {
                    if (num === sync2visible[i]) {
                        var found = true;
                    }
                }
                if (found === false) {
                    if (num > sync2visible[sync2visible.length - 1]) {
                        sync2.trigger("owl.goTo", num - sync2visible.length + 2)
                    } else {
                        if (num - 1 === -1) {
                            num = 0;
                        }
                        sync2.trigger("owl.goTo", num);
                    }
                } else if (num === sync2visible[sync2visible.length - 1]) {
                    sync2.trigger("owl.goTo", sync2visible[1])
                } else if (num === sync2visible[0]) {
                    sync2.trigger("owl.goTo", num - 1)
                }
            }
        });
        $('[data-video-start]').on('click', function(event) {
            event.preventDefault();
            $videoList.eq(0).trigger('click');
        });
    </script>

    <script>
        $(document).ready(function() {
            $(function() {
                //Fixed category:
                var topfix = 300;
                $(window).on("load", function() {
                    $("#category-fixed").css("top", ($(window).height() - $("#category-fixed").height()) /
                        2)
                });
                $(window).scroll(function() {
                    if ($(window).scrollTop() > topfix) $("#category-fixed").addClass("slideInLeft")
                        .fadeIn();
                    else $("#category-fixed").removeClass("slideInLeft").fadeOut();

                });
            });
            $(window).scroll(function() {
                $(".section-product").each(function() {
                    var top = $(this).offset().top;
                    if ($(window).scrollTop() > top - 200) {
                        var id = $(this).attr("data-cat");
                        //console.log();
                        $("#category-fixed a").removeClass("active");
                        $("#" + id).addClass("active");
                    }
                });
            });
            $("#category-fixed a").click(function() {
                var id = $(this).attr("id");
                var top = $(".section-product[data-cat='" + id + "']").offset().top;
                $('html,body').animate({
                    scrollTop: top
                }, 800);
            });
			$('input[name="vat"]').click(function(){
				if($('input[name="vat"]:checked').length > 0){
					$("#thongtinxuathoadon").show();
				}
				else{
					$("#thongtinxuathoadon").hide();
				}
			});
			
        });

    </script>
<style>
	.fb_dialog_content iframe:first-child{
		bottom: 78px !important;

		margin: 0 !important;
		right: 12px !important;
	}
	.fb_dialog_content iframe:first-child svg{
		height: 44px;
		width: 44px;
	}
</style>
<?php echo $site_config['chat'];?> 
</body>
</html>