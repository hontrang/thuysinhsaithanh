<style>
	.preview_box{
	border: 1px solid #e8e8e8;
    padding: 10px;
    width: 600px;
    overflow: hidden;
	}
	.preview_title{
		color: #2e3bea;
font-size: 18px;
	}
	.preview_url{
			color: #3ba023;
	}
	.preview_box_fb{
			border: 1px solid #e8e8e8;
	}
	.preview_info_fb{
		padding: 5px 10px;
		background-color: #F2F3F5;
	}
	.preview_url_fb{
			color: #3ba023;
	}
	
	.preview_title_fb{
		font-weight: bold;
		font-size: 18px;
	}
</style>

<div class="hr-line-dashed"></div>
<div class="form-group">
	<label class="control-label col-md-2" ></label>
	<div class="col-md-10">
		<h3>Cấu hình SEO</h3>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-2" >Title:</label>
	<div class="col-md-10">
	
		<input id="title_seo" name="title_seo" class="form-control" value="<?php echo set_value('title_seo',(isset($info->title_seo) and $info->title_seo != "")?$info->title_seo:'')?>" maxlength="60" />
	</div>
</div>

<div class="form-group">
	<label class="control-label col-md-2" >Description:</label>
	<div class="col-md-10">
		<input id="description_seo" name="des_seo" class="form-control" value="<?php echo set_value('des_seo',(isset($info->des_seo) and $info->des_seo != "")?$info->des_seo:'')?>" maxlength="160" />
	</div>
</div>

<div class="form-group">
	<label class="control-label col-md-2" >Keyword:</label>
	<div class="col-md-10">
		<input id="keyword_seo" name="keyword_seo" class="form-control" value="<?php echo set_value('keyword_seo',(isset($info->keyword_seo) and $info->keyword_seo != "")?$info->keyword_seo:'')?>" maxlength="500" />
	</div>
</div> 

<div class="form-group">
	<label class="control-label col-md-2" >Preview :</label>
	<div class="col-md-10">
		<div class="preview_box">
				<div class="preview_title"><?php echo set_value('title_seo',(isset($info->title_seo) and $info->title_seo != "")?$info->title_seo:'')?></div>
				<div class="preview_url"><?php echo site_url();?>....</div>
				<div class="preview_des"><?php echo set_value('des_seo',(isset($info->des_seo) and $info->des_seo != "")?$info->des_seo:'')?></div>
			</div>
	</div>
</div> 
			