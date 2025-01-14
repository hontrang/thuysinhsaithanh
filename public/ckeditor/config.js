/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
$(document).ready(function() {
	CKEDITOR.dtd.$removeEmpty['span'] = false;
	
	CKEDITOR.replaceClass = 'editor_full';
	
	
	CKEDITOR.editorConfig = function( config ) {
		// Define changes to default configuration here. For example:
		// config.language = 'fr';
		// config.uiColor = '#AADC6E';
		config.removePlugins = '';
		config.filebrowserImageBrowseUrl = '/public/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=datnguyen2017&relative_url=0';
		config.filebrowserImageBrowseLinkUrl = '/public/filemanager/dialog.php?type=1&editor=ckeditor&fldr=&akey=datnguyen2017&relative_url=0';
		config.filebrowserBrowseUrl = '/public/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=datnguyen2017&relative_url=0';
		config.filebrowserUploadUrl = '/public/filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=datnguyen2017&relative_url=0';
		config.allowedContent = true;
		config.extraPlugins = 'autogrow,youtube,tableresize,layoutmanager,basewidget,bootstrapTabs,btbutton,accordionList,collapsibleItem,fontawesome,lineutils,colordialog';
		config.autoGrow_minHeight = 200;
		config.autoGrow_maxHeight = 600;
		config.autoGrow_bottomSpace = 50;
		config.layoutmanager_loadbootstrap = true;
		config.contentsCss = '/public/font-awesome/css/font-awesome.min.css';
		//config.div_wrapTable = true;
		
	};

});


