

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


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="/public/fileuploader/css/jquery.fileuploader.css" rel="stylesheet" type="text/css" />
    <link href="/public/fileuploader/css/jquery.fileuploader-theme-thumbnails.css" rel="stylesheet" type="text/css" />




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
        <strong>DOS.VN</strong> &copy; 2017.
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
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/tinymce/tinymce.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/pekeUpload.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/jquery.cookie.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/jquery.multi-select.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/morris/morris.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/iCheck/icheck.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/jquery.repeater.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url('public/templates/admin/'.$current_template);?>/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select[id!=list-permission]').select2();
    </script>
    <?php
    if(isset($scripts))
        foreach ($scripts as $script)
            echo $script;
    ?>
    <script>
        tinymce.init({
            selector: 'textarea.tiny',
            height: 100,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            toolbar: 'undo redo | insert | bold italic'
        });

        tinymce.init({
            selector: 'textarea.textmini',
            height: 200,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
        });


        tinymce.init({
            selector: 'textarea#news',
            height: 500,
            theme: 'modern',
            plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools code contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect fontsizeselect fontselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat code',
            image_advtab: true,
            external_filemanager_path:"/public/filemanager/",
            filemanager_title:"Quản lý file" ,
            external_plugins: { "filemanager" : "/public/filemanager/plugin.min.js"},
            filemanager_access_key:"datnguyen2017",
            fontsize_formats: "7pt 8pt 9pt 10pt 11px 12pt 13px 14pt 15pt 16px 17px 18pt 24pt 36pt"
        });


        $('#post_image').on('change', function (e) {
            var src = $('#post_image').val();
            alert(src);

        });



    </script>

    <script>
        if($('.datetime').length > 0)
            $(".datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii',autoclose: true,todayBtn: true});

        if($('.repeater').length > 0)
        $('.repeater').repeater({
            show: function () {
                $(this).slideDown();
                tinymce.init({
                    selector: 'textarea.tiny',
                    height: 100,
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table contextmenu paste code'
                    ],
                    toolbar: 'undo redo | insert | bold italic'
                });
            },
            hide: function (remove) {
                if(confirm('Bạn có muốn xóa dòng này?')) {
                    $(this).slideUp(remove);
                }
            }
        });

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

    $(".btn-save").click(function(){
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
    var url=jQuery('#'+field_id).val();
    $('#'+field_id+'_thumb').attr('src','/public/userfiles/'+url);
}

    function open_popup(url) {
    var w = 880;
    var h = 570;
    var l = Math.floor((screen.width - w) / 2);
    var t = Math.floor((screen.height - h) / 2);
    var win = window.open(url, 'ResponsiveFilemanager', "scrollbars=1,width=" + w + ",height=" + h + ",top=" + t + ",left=" + l);
    }


    </script>

</body>

</html>

