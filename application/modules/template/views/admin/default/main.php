

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin CP</title>

    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/multi-select.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/templates/admin/'.$current_template);?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="/public/colorpicker/spectrum.min.css" rel="stylesheet" type="text/css" />
    <link href="/public/fileuploader/css/jquery.fileuploader.css" rel="stylesheet" type="text/css" />
    <link href="/public/fileuploader/css/jquery.fileuploader-theme-thumbnails.css" rel="stylesheet" type="text/css" />


	<style>
		.table > tbody > tr > td{
			vertical-align: middle;
		}
	</style>

</head>
<body class="fixed-sidebar">
    <div id="wrapper">
        <?php
        echo $this->load->widget('menu_admin');
        ?>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary "><i class="fa fa-bars"></i> </a>
        </div>
        </nav>
        </div>


        <?php
        echo $this->load->view('admin/'.$current_template.'/'.$module.'/'.$method);
        ?>




            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">






                    </div>
                </div>
            </div>

		        <div class="footer">
    <div>
        <strong>samlonghop.vn</strong> &copy; 2023
    </div>
</div>
        </div>
    	</div>
	</div>


    <!-- Mainly scripts -->
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/jquery-2.1.1.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/inspinia.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/pace/pace.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/jquery.twbsPagination.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/nestable/jquery.nestable.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/pekeUpload.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/jquery.cookie.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/jquery.multi-select.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/morris/morris.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/jquery.repeater.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/dataTables/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<script src="/public/colorpicker/spectrum.min.js"></script>
	<script src="/public/ckeditor/ckeditor.js"></script>
    <script src="/public/ckeditor/config.js"></script>
    <script type="text/javascript">
        $('select[id!=default_select]').select2();
    </script>
    <?php
    if(isset($scripts))
        foreach ($scripts as $script)
            echo $script;
    ?>
    <script>
	
		$('.td_price').dblclick(function(){
			var td = $(this);
			var type = td.data('type');
			var price = td.data('price');
			var id = td.data('id');
			if(!td.hasClass('added')){
				td.html('<input type="text" class="form-control input_price" data-type="'+type+'" data-id="'+id+'" value="'+price+'" />');
				td.addClass('added');
			}
			
		});
		$('body').on('keyup','.input_price',function(e){
			if (e.keyCode == 13) {
				var input = $(this);	
				var id = input.data('id');
				var value = input.val();
				var type = input.data('type');
				$.ajax({
					url : "/admin/product/updatePrice",
					type : "post",
					cache       : false,
					dataType    : "json",
					data : {
						id: id,
						value: value,
						type: type
					},
					success : function (repo){
						if(repo.error === 0){
							console.log(repo.value);
							$('#td_'+type+'_'+id).html(repo.value);
							$('#td_'+type+'_'+id).data('price',value);
							$('#td_'+type+'_'+id).removeClass('added');
						}
						else{
							alert('Lỗi!!');
						}
					}
				});
				
			}
			
		});
		
		$('.input_orders').on('change',function () {
			var id = $(this).data("id");
			var module = $(this).data("module");
			var method = "updateOrder";
			if($(this).data("method") !== undefined)
				method = $(this).data("method");
			var orders_new = $(this).val();

			$.ajax({
				type: "POST",
				url: '/admin/'+module+'/'+method,
				data: {id: id, orders_new: orders_new},
				success: function(data)
				{
					location.reload();
				}
			});
		});
		
		
        $('#description_seo').keyup(function(){
            update_preview_seo();
        });

        $('#title_seo').keyup(function(){
            update_preview_seo();
        });


        $('#description_seo').change(function(){
            update_preview_seo();
        });


        $('#title_seo').change(function(){
            update_preview_seo();
        });

        $('#imageshare').change(function(){
            update_preview_seo();
        });

    $('#productcat .dd').nestable({
        maxDepth : 3,
    });
	
	$('#product_cat_id').change(function(){
        var cat_id = $(this).val();
        $.ajax({
            url : "/admin/product/getProperties",
            type : "post",
            cache: false,
            dataType: 'JSON',
            data : {
                cat_id: cat_id
            },
            success : function (repo){
                if(repo.error === 0){
                    $("#product_properties_repo").html('');
                    $.each( repo.data, function( key, item ) {
                        $("#product_properties_repo").append(
                            '<div class="form-group">'+
                                '<label class="col-md-2 control-label">'+item.properties_name+':</label>'+
                            '<div class="col-md-8">'+
                                '<input type="hidden" name="properties['+item.properties_id+'][properties_id]" value="'+item.properties_id+'" class="form-control">'+
                                '<input type="text" name="properties['+item.properties_id+'][properties_value]" value="" class="form-control">'+
                            '</div>'+
                            '</div>');
                    });
                }
                else{
                    $("#product_properties_repo").html('');
                }
            }
        });
    });
	
    $('#productcat .dd').on('change', function() {
        var json = $('.dd').nestable('serialize');

        $.ajax({
            url : "/admin/product/savecatorder",
            type : "post",
            cache: false,
            data : {
                data: json
            },
            success : function (result){

            }
        });
    });

	$('#menulist .dd').nestable({
		maxDepth : 1,
	});
	$('#menulist .dd').on('change', function() {
		var json = $('.dd').nestable('serialize');

		$.ajax({
            url : "/admin/<?php echo $module;?>/save",
            type : "post",
            cache: false,
            data : {
                data: json
            },
            success : function (result){

            }
        });
	});
        if($('.colorpicker').length > 0){
            $('.colorpicker').spectrum({
                hideAfterPaletteSelect: "true",
                showInput: "true",
                allowEmpty: "false",
				showPalette: true,
				showSelectionPalette: true,
				palette: [
					["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
					["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
					["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
					["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
					["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
					["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
					["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
					["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
				],
				localStorageKey: "spectrum.homepage",
            });
        }
        if($('.repeater').length > 0){
            $('.repeater').repeater({
                show: function () {
                    $(this).slideDown();
                    if($('.i-checks').length > 0){
                        $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                        });
                    }

                },
                hide: function (remove) {
                    if(confirm('Bạn có muốn xóa dòng này?')) {
                        $(this).slideUp(remove);
                    }
                }
            });
        }


        $("#form_lich").submit(function(e) {
            var url = "/admin/doctor/submit_lich_lam_viec"; // the script where you handle the form input.
            $.ajax({
                type: "POST",
                url: url,
                data: $("#form_lich").serialize(),
                success: function(data)
                {
                    alert(data);
                }
            });
            e.preventDefault();

        });

        $("#btn_submit_dotor_form").click(function() {
            $("#doctor_form").submit()
        });


        $('#post_image').on('change', function (e) {
            var src = $('#post_image').val();
            alert(src);

        });



    </script>

    <script>
    var input_name = '';
    var input = '';
    var image_click = '';
	$('.dataTables').DataTable({


            });



        if($('.datetime').length > 0)
            $(".datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii',autoclose: true,todayBtn: true});

    if($('.i-checks').length > 0){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    }


    $(".preview").click(function(){
       var url_video = $(this).attr('data-url');
        document.getElementById("player_source").src = url_video;
        document.getElementById("player").load();
        $("#video").modal('show');
    });

    $(".cource_free_preview").click(function(){
        var url_video = $(this).attr('data-url');
        $("iframe").attr("src",url_video);
        $("#video").modal('show');
    });

    $("body").on("click",".btn-save",function(){
        var button = $(this);
        button.html('<img src="/public/templates/admin/default/img/loading.gif" />');
        var id = $(this).data('id');
        var text = $('#id-'+id).val();
        $.ajax({
            url : "/admin/language/edit",
            type : "post",
            cache: false,
            data : {
                id: id,
                text: text
            },
            success : function (result){
                result = $.parseJSON(result);
                if(result.error === 0){
                    button.html('<i class="fa fa-edit"></i>&nbsp;Sửa');
                }
                else{
                    alert("Có lỗi xảy ra!");
                }
            }
        });


    });

    $("body").on("click",".btn-trash",function(){
        var button = $(this);
        button.html('<img src="/public/templates/admin/default/img/loading.gif" />');
        var id = $(this).data('id');
        var a = confirm("Bạn có chắc chắn muốn xoá??");
        if(a){
            $.ajax({
                url : "/admin/language/del",
                type : "post",
                cache: false,
                data : {
                    id: id,
                },
                success : function (result){
                    result = $.parseJSON(result);
                    if(result.error === 0){
                        button.html('<i class="fa fa-trash"></i>&nbsp;Xoá');
                        location.reload();
                    }
                    else{
                        alert("Có lỗi xảy ra!");
                    }
                }
            });
        }



    });


    $("body").on("click",".btn-save-color",function(){
        var button = $(this);
        button.html('<img src="/public/templates/admin/default/img/loading.gif" />');
        var id = $(this).data('id');
        var text = $('#id-'+id).val();
        $.ajax({
            url : "/admin/product/editcolor",
            type : "post",
            cache: false,
            data : {
                id: id,
                text: text
            },
            success : function (result){
                result = $.parseJSON(result);
                if(result.error === 0){
                    button.html('<i class="fa fa-edit"></i>&nbsp;Sửa');
                }
                else{
                    alert("Có lỗi xảy ra!");
                }
            }
        });


    });



    $("#btnComment").click(function(){
        var content = $("#comment_content").val();
        var cource_id = $("#cource_id").val();
        if(content === "")
            alert("Bạn chưa nhập nội dung!");
        else{
            $.ajax({
                url : "/comment",
                type : "post",
                cache: false,
                data : {
                    cource_id: cource_id,
                    content: content
                },
                success : function (result){
                    result = $.parseJSON(result);
                    if(result.error === 0){
                        $("#comment_content").val("");
                        $("#comment-list").append('<div class="social-comment">' +
                            '<a href="" class="pull-left"><img alt="image" src="/public/userfiles/'+result.avatar+'"></a>'+
                            '<div class="media-body">'+
                            '<a href="#">'+ result.name +'</a>: '+
                            ''+content+''+
                            '<br><a href="#" onclick="alert(\'Chắc năng này chỉ dành cho giảng viên!\')" class="small"><i class="fa fa-comment"></i> Trả lời</a> - <small class="text-muted">'+ result.create_date +'</small></div></div>');
                    }
                    else{
                        alert("Có lỗi xảy ra!");
                    }
                }
            });
        }
    });
    $('.btn-replay').on('click',function (e) {
        $(this).parent().find(".cmt-box").toggle();
    });

    $(".btnreplysubmit").on('click', function(){
        var parent_id = $(this).parent().parent().parent().find(".parent").val();
        var content = $(this).parent().parent().find(".comment-content").val();
        var cource_id = $("#cource_id").val();
        var cmt_sub = $(this).parent().parent().parent().parent();
        var cmt_ob = $(this).parent().parent();
        if(content === "")
            alert("Bạn chưa nhập nội dung!");
        else{
            $.ajax({
                url : "/comment",
                type : "post",
                cache: false,
                data : {
                    cource_id: cource_id,
                    content: content,
                    parent_id: parent_id,
                },
                success : function (result){
                    result = $.parseJSON(result);
                    if(result.error === 0){
                        cmt_ob.find(".comment-content").val("");
                        cmt_sub.find(".cmt-sub").append('<div class="social-comment">' +
                            '<a href="" class="pull-left"><img alt="image" src="/public/userfiles/'+result.avatar+'"></a>'+
                            '<div class="media-body">'+
                            '<a href="#">'+ result.name +'</a>: '+
                            ''+content+''+
                            '<br><small class="text-muted">'+ result.create_date +'</small></div></div>');
                    }
                    else{
                        alert("Có lỗi xảy ra!");
                    }
                }
            });
        }
    });
    $(".btnremovecmt").on('click', function(){
        var id = $(this).attr("data");
        var parent_id = $(this).parent().parent();
        $.ajax({
            url : "/remove-comment",
            type : "post",
            cache: false,
            data : {
                id: id
            },
            success : function (result){
                if(result === "1")
                    parent_id.html("");
                else
                    alert("Có lỗi xảy ra!");
            }
        });

    });

    checkCookie();
    function checkCookie() {
        // the cookie exists
        if(localStorage.getItem('mchild') !== "") {
            var mchild = localStorage.getItem('mchild');
            var mparent = localStorage.getItem('mparent');
           $("#side-menu li.parent:eq(" + mparent + ")").addClass('active');
           $("#side-menu li.parent:eq(" + mparent + ") ul.nav-second-level li:eq(" + mchild + ")").addClass('active');
        }
    }

    $('.nav-second-level li').click(function(event) {
        // get the index
        var mchild = $(this).index();
        var mparent = $(this).parent().parent().index();

        // save the cookie
        //$.removeCookie('mchild');
        //$.removeCookie('mparent');
        localStorage.setItem('mchild', mchild);
        localStorage.setItem('mparent', mparent);


    });

    $('#list-permission').multiSelect();
	
	function deleteSelected(idForm)
    {
        var xacnhan = confirm("Bạn có muốn xóa nhưng mục này không?\n* Lưu ý: Thao tác không thể phục hồi");
        if (xacnhan == true) {
            $("#"+idForm).submit();
        }

    }

    function remove(page)
    {
        var xacnhan = confirm("Bạn có muốn xóa mục này không?\n* Lưu ý: Thao tác không thể phục hồi");
        if (xacnhan == true) {
            location.href= page;
        }

    }
    function action(hash,action,type)
    {
        $.ajax({
            type        : 'GET',
            async       : false,
            cache       : false,
            dataType    : "json",
            url         : 'action.php?action='+ action +'&type='+ type + '&hash='+ hash
            }).done(function(data) {
                    swal({
                        title: data.title,
                        text: data.text,
                        type: data.type
                    });
                    if(action == "remove")
                    {
                        location.reload();
                    }
             });


    }

   function responsive_filemanager_callback(field_id){
        if(field_id === "product_version_image_temp"){
            var url=jQuery('#product_version_image_temp').val();
            input.val(url);
            image_click.attr('src','/public/userfiles/'+url);

        }
        else{
            var url=jQuery('#'+field_id).val();
            $('#'+field_id+'_thumb').attr('src','/public/userfiles/'+url);
        }

    }

    $("body").on('click','.open_select_image',function () {
        image_click = $(this);
        input = image_click.parent().parent().find('input');
        var input_name_text = input.attr('name');
        input_name = input_name_text;
        open_popup('/public/filemanager/dialog.php?type=1&popup=1&field_id=product_version_image_temp&akey=datnguyen2017&relative_url=1&fldr=product/');
    });

    function open_popup(url) {
        var w = 880;
        var h = 570;
        var l = Math.floor((screen.width - w) / 2);
        var t = Math.floor((screen.height - h) / 2);
        var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
    }

	function set_status(type,id,module = 'product'){
        $.ajax({
            type        : 'GET',
            async       : false,
            cache       : false,
            dataType    : "json",
            url         : '/admin/'+module+'/setstatus.html?type='+ type + '&id='+ id
        }).done(function(data) {
        });
    }
    function update_preview_seo(){
        if($('#title_seo').val().length > 55){
            alert('Tiêu để SEO phải ngắn hơn 55 ký tự');
            return false;
        }

        if($('#description_seo').val().length > 200){
            alert('Tiêu để SEO phải ngắn hơn 155 ký tự và dài hơn 50 ký tự');
            return false;
        }


        $('.preview_title').html($('#title_seo').val());
        $('.preview_des').html($('#description_seo').val());

        $('.preview_image img').attr('src','/upload/'+$('#imageshare').val());

    }
	function XoaLienKet(name){
		var html = CKEDITOR.instances[name].getData();
		var newhtml = html.replace(/<a.*href="(.*?)".*>(.*?)<\/a>/gi, "<strong>$2</strong>");
		CKEDITOR.instances[name].setData(newhtml);
	}

    </script>

</body>

</html>

