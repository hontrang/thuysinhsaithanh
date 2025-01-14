
$('.buy_now').click(function(){
	var id = $(this).data('id');
	var qty = 1;
	$.ajax({
        url : "/gio-hang/add",
        type : "post",
        cache: false,
        data : {
            product_id: id,
            quantity: 1,
        },
        success : function (repo){
            window.location.replace("/gio-hang.html");
        }
    });
});

$(".sidebar button[class=toggle]").click(function(e){
	e.preventDefault();
    if($(this).parent().hasClass('active')){
        $(this).parent().removeClass('active');
    }
    else{
        $(this).parent().addClass('active');
    }


});

function openCat(id){
    $("#menu-item-"+id).addClass('active');
    console.log(id);
}

$('.slide-product').owlCarousel({
    loop: true,
    items: 4,
    margin: 10,
    nav: true,
    navText: ["<span><i class='fas fa-chevron-left'></i></span>", "<span><i class='fas fa-chevron-right'></i></span>"],
    dots: false,
    responsive: {
        320: {
            items: 2
        },
        768: {
            items: 3
        },
        992: {
            items: 4
        },
        1200: {
            items: 4
        }
    }
});

$('.list-product-home-deal').owlCarousel({
    loop: true,
    items: 1,
    margin: 10,
    nav: false,
	autoplay: true,
	autoplaytimeout: 3000,
	autoplayhoverpause: true,
    navText: ["<span><i class='fas fa-chevron-left'></i></span>", "<span><i class='fas fa-chevron-right'></i></span>"],
    dots: true,
    responsive: {
        320: {
            items: 1
        },
        768: {
            items: 1
        },
        992: {
            items: 1
        },
        1200: {
            items: 1
        }
    }
});

/*
$('.list-product-home-popular').owlCarousel({
    loop: true,
    items: 3,
    margin: 10,
    nav: true,
    navText: ["<span><i class='fas fa-chevron-left'></i></span>", "<span><i class='fas fa-chevron-right'></i></span>"],
    dots: false,
    responsive: {
        320: {
            items: 2
        },
        768: {
            items: 3
        },
        992: {
            items: 3
        },
        1200: {
            items: 3
        }
    }
});


$('.list-product-home').owlCarousel({
    loop: true,
    items: 4,
    margin: 10,
    nav: true,
    navText: ["<span><i class='fas fa-chevron-left'></i></span>", "<span><i class='fas fa-chevron-right'></i></span>"],
    dots: false,
    responsive: {
        320: {
            items: 2
        },
        768: {
            items: 3
        },
        992: {
            items: 4
        },
        1200: {
            items: 4
        }
    }
});
*/


$('.owl-detail').owlCarousel({
    loop: true,
    items: 1,
    margin: 10,
    nav: false,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        768: {
            items: 1
        },
        992: {
            items: 1
        },
        1200: {
            items: 1
        }
    }
});

$(".owl-dos").each(function(index, el) {
	var $this = $(this);
	if ($this.hasClass('tab-owl')) {
		var $tab_panel = $this.closest('.tab-panel');
		if ($tab_panel.hasClass('active')) {
			settingCarousel($this);
		}
	} else {
		settingCarousel($this);
	}
});

function settingCarousel($this) {
	var config = $this.data();
	config.navText = ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'];
	if (config.smartspeed != 'undefined') {
		//config.smartSpeed = config.smartspeed;
	}
	console.log(config.allitems);
	if (config.allitems != "undefined") {
		if (config.allitems <= 1) {
			config.loop = false;
		}
	}
	config.lazyLoad = true;
	if ($this.hasClass('owl-style2')) {
		config.animateOut = "fadeOut";
		config.animateIn = "fadeIn";
	}

	config.onInitialized = function(event) {
		var $item_active = $this.find('.owl-item.active');
		$item_active.each(function($i) {
			var $item = jQuery(this);
			var $style = $item.attr("style");
			$style = ($style == undefined) ? '' : $style;
			var delay = $i * 300;
			$item.attr("style", $style + ";-webkit-animation-delay:" + delay + "ms;" + "-moz-animation-delay:" + delay + "ms;" + "-o-animation-delay:" + delay + "ms;" + "animation-delay:" + delay + "ms;").addClass('slideInTop animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$item.removeClass('slideInTop animated');
				if ($style)
					$item.attr("style", $style);
			});
		});
	}
	console.log(config);
	$this.owlCarousel(config);
}



$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
	console.log("tab click");
	var $this = jQuery(this);
	var $container = $this.closest('.container-tab');
	var $href = $this.attr('href');
	var $tab_active = $container.find($href);

	var $item_active = $tab_active.find('.owl-item.active');
	var $carousel_active = $tab_active.find('.owl-carousel');
	if ($carousel_active.length > 0) {
		if (!$carousel_active.hasClass('owl-loaded')) {
			//console.log("chua load");
			settingCarousel($carousel_active);
		} else {
			
			$item_active.each(function($i) {
				
				var $item = jQuery(this);
				var $style = $item.attr("style");
				$style = ($style == undefined) ? '' : $style;
				var delay = $i * 300;
				$item.attr("style", $style + ";-webkit-animation-delay:" + delay + "ms;" + "-moz-animation-delay:" + delay + "ms;" + "-o-animation-delay:" + delay + "ms;" + "animation-delay:" + delay + "ms;").addClass('slideInTop animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
					$item.removeClass('slideInTop animated');
					if ($style)
						$item.attr("style", $style);
				});
			});
		}
	}
	
	//var $lazy = $tab_active.find('.kt-template-loop .owl-lazy');
	//kt_lazy($lazy);
	
});


var Glee = (function () {
    var total_prod;


    function countProduct(set_total) {
        total_prod = $(set_total).children('span:nth-child(2)').text();
        $(set_total).children('span:nth-child(1)').click(function () {
            if (total_prod >= 1) {
                total_prod = (total_prod - 1);
            } else {
                total_prod = 0;
            }
            $(set_total).children('span:nth-child(2)').html(total_prod);
        });
        $(set_total).children('span:nth-child(3)').click(function () {
            total_prod = Number(total_prod) + 1;
            $(set_total).children('span:nth-child(2)').html(total_prod);
        });
    }

    function tabGlee() {
        $('.title-tab-pro span').click(function () {
            var data_tab;
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
            data_tab = $(this).attr('data-tab');
            $('#' + data_tab + '').siblings(':not(.title-tab-pro)').fadeOut(500);
            $('#' + data_tab + '').fadeIn(500);
        });
    }

    function show_search() {
        $('.show-search').on('click', function () {
            $(this).siblings('form').toggleClass('active');
        });
        window.addEventListener('keyup', function (e) {
            if (e.keyCode === 27) {
                $('.search form').removeClass('active');
            }
        });
    }

    function menu_mobile() {
        $('.bar_mobile').on('click', function () {
            $('.menu').toggleClass('active');
        });
        $('.menu_item').on('click', function () {
            $(this).children('.main_sub').toggle(300);
            $(this).siblings().children('.main_sub').hide(300);
        });
    }

    function cat_left() {
        $('.show-cat').click(function () {
            $(this).parent('li').siblings().children('.child-cat').hide(500);
            $(this).siblings('.child-cat').toggle(500);
        });
    }

    function m_footer() {
        $('.title').on('click', function () {
            $(this).siblings('.footer_list-link').toggle(500);
        });
    }

    function accordion(accordion_click, style) {
        var style;
        $(accordion_click).click(function () {
            if (style == "accordion-1") {
                $(this).siblings().toggle("slow");
                $(this).parent().siblings().children('ul').hide("slow");
            } else if (style == "accordion-2") {
                $(this).siblings('.accordion_content').toggle("slow");
            }
        });
    }

    function slide_show_pro(link_ajax, holder_slider, proId) {
        var percent;
  		var width_driver = window.innerWidth;
        $.getJSON('/ajax/get_json.php?action=payinstall&action_type=check-category&category_id=' + proId + '', function (result) {
            percent = result
        });
        $.getJSON(link_ajax, function (result) {
            var html = '';
            var data = result.list;
            Object.keys(data).forEach(function (key, keyIndex) {
                //console.log(data);
                if (key >= 10) {
                    return;
                }
                var title = data[key].productName;;
                var url = data[key].productUrl;
                var price = data[key].price;
                var srcimg = data[key].productImage.original;
                var gift = data[key].specialOfferGroup;
                var gift_ = data[key].specialOffer.all;
                var imgGift = '';
                var html_imgGift = '';
                var count_value = gift_.length;
                var monney_value = 0;
				console.log(title,gift,gift_);
                Object.keys(gift).forEach(function (key, keyIndex) {
                    var promotion = gift[key].promotion;
                    if (gift[key].type == 'all') {
                        count_value = count_value + gift[key].promotion_list.length;
                        Object.keys(promotion).forEach(function (key, keyIndex) {
                            monney_value = monney_value + parseInt(promotion[key].cash_value);
                        });
                    }
                    if (gift[key].type == 'one') {
                        count_value = count_value + 1;
                        Object.keys(promotion).forEach(function (key, keyIndex) {
                            if(keyIndex >= 1){
                                return;
                            }
                            monney_value = monney_value + parseInt(promotion[key].cash_value);
                        });
                    }
                    Object.keys(promotion).forEach(function (key, keyIndex) {
                        imgGift = promotion[key].thumbnail;
                        if (imgGift != '') {
                            html_imgGift += '<img src="/media/marketing/' + imgGift + '">';
                        }
                    });
                });
                Object.keys(gift_).forEach(function (key, keyIndex) {
                    monney_value = monney_value + parseInt(gift_[key].cash_value);
                    imgGift = gift_[key].thumbnail;
                    if (imgGift != '') {
                        html_imgGift += '<img src="/media/marketing/' + imgGift + '">';
                    }
                });
                var htmlPrice = '';
                if (price != 0) {
                    htmlPrice = '<span class="p-price">' + formatCurrency(price) + ' VNĐ</span>';
                }
              	var icon_tragop = '';
              	if(price >= 3000000) icon_tragop = '<span class="icon_tragop">Trả góp <i>0%</i></span>';
              
                var htmlPercent = '<span class="p-percent">Trả góp</span>';
                if (percent === 0) {
                    htmlPercent = '';
                }

                var htmlgift = '';
                if (html_imgGift != '') {
                    htmlgift = '<div class="quatang">' + html_imgGift + '</div>';
                }

                var htmlCountKM = '';
                if (count_value != 0) {
                  if(monney_value > 100) {
                  	htmlCountKM = '<p style="color: #333;font-size: 12px;"> ' + count_value + ' Khuyến mại trị giá <span style="color: #d0021b;font-size: 12px;">'+ formatCurrency(monney_value) +'đ</span> </p>';
                  } else {
                  	htmlCountKM = '<p style="color: #333;font-size: 12px;"> ' + count_value + ' Khuyến mại </p>';
                  }
                    
                }



                
              	if(width_driver >= 768){
                  html += '<div class="item"><div class="p-item">'+icon_tragop+'<a href="' + url + '" class="p-img"><img src="' + srcimg + '" alt="' + title + '"></a><a href="' + url + '" class="p-name">' + title + '</a><span class="p-price">' + htmlPrice + ' </span>'+ htmlCountKM + htmlgift + '</div></div>';
                }else{
                      if(keyIndex % 4 == 0) html += '<div class="item" style="display:flex;flex-wrap: wrap;">';
                       html += '<div class="p-item" style="width: 50%;">'+icon_tragop+'<a href="' + url + '" class="p-img"><img src="' + srcimg + '" alt="' + title + '"></a><a href="' + url + '" class="p-name">' + title + '</a><span class="p-price">' + htmlPrice + ' </span>'+ htmlCountKM + htmlgift + '</div>';
                  if((keyIndex+1)%4==0)html += '</div>';
                }
                $(holder_slider).html(html);
            });
        });
    }

    function tabslide() {
        $('.list-cat-child li').on('click', function () {
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
            link_ajax = $(this).attr('data-get-product');
        });
    }
    return {
        countProduct: countProduct,
        tabGlee: tabGlee,
        show_search: show_search,
        menu_mobile: menu_mobile,
        cat_left: cat_left,
        m_footer: m_footer,
        accordion: accordion,
        tabslide: tabslide,
        slide_show_pro: slide_show_pro,
    }
})();

Glee.countProduct('.set_total');
Glee.tabGlee();
Glee.show_search();
Glee.menu_mobile();
Glee.cat_left();
Glee.m_footer();
Glee.accordion('.click_accordion', 'accordion-2');
Glee.tabslide();



$('.list-cat-child li').click(function () {
    var item_tab = $(this).attr('data-get-product');
    $('#' + item_tab + '').css("display", "block");
    $('#' + item_tab + '').siblings().css("display", "none");
});





$(document).ajaxStop(function () {
    $('#viewed').owlCarousel({
        loop: true,
        items: 6,
        margin: 10,
        navigation: true,
        navigationText: ["<span><i class='fas fa-chevron-left'></i></span>", "<span><i class='fas fa-chevron-right'></i></span>"],
        dots: false,
        responsive: {
            0: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 6
            }
        }
    });
});


$(document).ajaxStop(function () {
    $('.product_slide').owlCarousel({
        loop: true,
        margin: 10,
        navigation: true,
        navigationText: ["<span><i class='fas fa-chevron-left'></i></span>", "<span><i class='fas fa-chevron-right'></i></span>"],
        dots: false,
      	items : 6,
        itemsDesktop : [1199, 6],
        itemsDesktopSmall : [979, 4],
        itemsTablet : [768, 1],
        itemsMobile : [320, 1],
    });
});
$(document).ajaxStop(function () {
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

function setUserOption(key, value, return_url) {
    window.location = "/ajax/user_set_option.php?key=" + key + "&value=" + value + "&return_url=" + encodeURIComponent(return_url);
}

function formatCurrency(a) {
    var b = parseFloat(a).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString();
    var len = b.length;
    b = b.substring(0, len - 3);
    return b;
}
var width_doc = $(document).width();
if (width_doc < 768) {
    $('.show-menu').click(function () {
        $('.nav').toggle(800);
    });
}

$('.filterCheck').click(function(){
	var type = $(this).data('type');
	var value = $(this).data('value');
	
    if($(this).hasClass('checked')){
        $(this).removeClass('checked');
		$("#"+type+value).removeAttr('checked');
        buildFilter()
    }
    else{
        $(this).addClass('checked');
		$("#"+type+value).attr('checked','checked');
        buildFilter()
    }
});

$('.sortCheck').click(function(){
	var type = $(this).data('type');
	var value = $(this).data('value');
	
    $('.sortCheck').removeClass('checked');

    $(this).addClass('checked');
	$("#"+type+value).prop('checked', true);
	buildFilter()
});

function buildFilter(page = 1, append = 0){
    var cat = $('#cat_id').val();
    var cats = $('#cats_id').val();
    var is_host = $('#is_host').val();
    var current_page = $('#current_page').val();
	
	var data = $('#productFormFilter').serialize();
	console.log(data);
	
	if(append == 1){
		current_page = page;
    }
    else{
        current_page = 1;
    }
	
	$.ajax({
        url : "/ajax/product/getProduct",
        type : "post",
        cache: false,
        data : data+'&page='+current_page,
        success : function (repo){
            if(append == 1){
                $('.list_page').append(repo);
            }
            else{
                $('.list_page').html(repo);
            }
                
        }
    });
	
	/*
    $('.filterCheck.checked').each(function(index){
        var type = $(this).data('type');
        var value = $(this).data('value');
		//data[type][i] = Array();
        //data[type][i] = value;
		//i++;
    });

    $('.sortCheck.checked').each(function(index){
        var type = $(this).data('type');
        var value = $(this).data('value');
        data[type] = value;
        
    });

    //console.log(JSON.stringify(data));
    if(append == 1){
		current_page = page;
    }
    else{
        current_page = 1;
    }

    $.ajax({
        url : "/ajax/product/getProduct",
        type : "post",
        cache: false,
        data : {
            data: JSON.stringify(data),
            page: current_page,
            cat: cat,
            cats: cats,
        },
        success : function (repo){
            if(append == 1){
                $('.list_page').append(repo);
            }
            else{
                $('.list_page').html(repo);
            }
                
        }
    });
	
	*/
}
function show_more_product(page){

    console.log(page);
    $('.load-more').remove();
    buildFilter(page,1);
}