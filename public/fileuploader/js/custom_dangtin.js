$(document).ready(function() {
	
	// editor save function
	var saveEditedImage = function(item) {
		// if still uploading
		// pend and exit
		if (item.upload && item.upload.status == 'loading')
			return item.editor.isUploadPending = true;

		// if not appended or not uploaded
		if (!item.appended && !item.uploaded)
			return;

		// if no editor
		if (!item.editor || !item.reader.width)
			return;
		
		// if uploaded
		// resend upload
		if (item.upload && item.upload.resend) {
			item.editor._namee = item.name;
			item.upload.resend();
		}
		
		// if appended
		// send request
		if (item.appended) {
			$.post('/public/fileuploader/ajax_resize_file.php', {_file: item.file, _editor: JSON.stringify(item.editor), fileuploader: 1}, function() {
				item.reader.read(function() {
					item.popup.html = item.popup.editor = item.editor.crop = item.editor.rotation = null;
					item.renderThumbnail();
				}, null, true);
			});
		}
	};
	
	// enable fileuploader plugin
	$('input[name="files"]').fileuploader({
        limit: 200,
        fileMaxSize: 2,
        extensions: ['jpg', 'jpeg', 'png', 'gif','JPG','PNG','GIF'],
		changeInput: ' ',
		theme: 'thumbnails',
        enableApi: true,
		addMore: true,
		/*
		files: [{
			name: 'stocksnap_4521.jpg',
			size: 62500,
			type: 'image/jpeg',
			file: 'uploads/TW0IzCswkMdJ.jpg',
		}],
		*/
		thumbnails: {
			box: '<div class="fileuploader-items" >' +
                      '<ul class="fileuploader-items-list ">' +
					      '<li class="fileuploader-thumbnails-input col-xs-6  col-md-6 col-sm-6  col-lg-4"><div class="fileuploader-thumbnails-input-inner " style="min-width: 100px;"><span style="font-size: 30px;"><i class="fa fa-picture-o"></i></span><br /><span style="font-size: 15px;">Nhấn vào đây<br />để thêm hình <br />ảnh</span></div></li>' +
                      '</ul>' +
                  '</div>',
			item: '<li class="fileuploader-item col-xs-6  col-md-6 col-sm-6  col-lg-4">' +
				       '<div class="fileuploader-item-inner">' +
                           '<div class="thumbnail-holder">${image}</div>' +
                           '<div class="actions-holder">' +
						   	   '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' +
							   '<span class="fileuploader-action-popup"></span>' +
                           '</div>' +
                       	   '<div class="progress-holder">${progressBar}</div>' +
                       '</div>' +
						'<div class="check"><input type="radio" value="${name}" name="default_image"> Ảnh đại diện</div>' +
                   '</li>',
			item2: '<li class="fileuploader-item col-xs-6 col-md-6 col-sm-6 col-lg-4">' +
				       '<div class="fileuploader-item-inner">' +
                           '<div class="thumbnail-holder">${image}</div>' +
                           '<div class="actions-holder">' +
                               '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="remove"></i></a>' +
							   '<span class="fileuploader-action-popup"></span>' +
                           '</div>' +
                       '</div>' +
					   '<div class="check"><input type="radio" value="${name}" name="default_image"> Ảnh đại diện</div>' +
                   '</li>',
			startImageRenderer: true,
			canvasImage: false,
			_selectors: {
				list: '.fileuploader-items-list',
				item: '.fileuploader-item',
				start: '.fileuploader-action-start',
				retry: '.fileuploader-action-retry',
				remove: '.fileuploader-action-remove'
			},
			onItemShow: function(item, listEl) {
				var plusInput = listEl.find('.fileuploader-thumbnails-input');
				
				plusInput.insertAfter(item.html);
				
				if(item.format == 'image') {
					item.html.find('.fileuploader-item-icon').hide();
				}
			}
		},
		afterRender: function(listEl, parentEl, newInputEl, inputEl) {
			var plusInput = listEl.find('.fileuploader-thumbnails-input'),
				api = $.fileuploader.getInstance(inputEl.get(0));
		
			plusInput.on('click', function() {
				api.open();
			});
		},
		upload: {
            url: '/public/fileuploader/ajax_upload_file.php',
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: function(item) {
				// add editor to upload data
				// note! that php will automatically adjust _editorr to the file
				if (item.editor && (typeof item.editor.rotation != "undefined" || item.editor.crop)) {
					item.upload.data._editorr = JSON.stringify(item.editor);
					if (item.editor._namee) {
						item.upload.data._namee = item.name;
						delete item.editor._namee;
					}
					
					// remove success icon that was added in onSuccess callback
					item.html.find('.column-actions .fileuploader-action-success').remove();
				}
			},
            onSuccess: function(result, item) {
                var data = {};
				
				try {
					data = JSON.parse(result);
				} catch (e) {
					data.hasWarnings = true;
				}
                
				// if success
                if (data.isSuccess && data.files[0]) {
                    item.name = data.files[0].name;
					item.html.find('.column-title > div:first-child').text(data.files[0].name).attr('title', data.files[0].name);
					
					// send pending editor
					if (item.editor && item.editor.isUploadPending) {
						delete item.editor.isUploadPending;
						
						saveEditedImage(item);
					}
                }
				
				// if warnings
				if (data.hasWarnings) {
					for (var warning in data.warnings) {
						alert(data.warnings);
					}
					
					item.html.removeClass('upload-successful').addClass('upload-failed');
					// go out from success function by calling onError function
					// in this case we have a animation there
					// you can also response in PHP with 404
					return this.onError ? this.onError(item) : null;
				}

                setTimeout(function() {
					item.html.find('.progress-holder').fadeOut();
                }, 400);
            },
            onError: function(item) {
				item.html.find('.progress-holder').hide();
				item.html.find('.fileuploader-item-icon i').text('Failed!');
            },
            onProgress: function(data, item) {
                var progressBar = item.html.find('.progress-holder');
				
                if(progressBar.length > 0) {
                    progressBar.show();
                    progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
                }
            },
            onComplete: null,
        },
		onRemove: function(item) {
			$.post('/public/fileuploader/ajax_remove_file.php', {
				file: item.name
			});
		},
		editor: {
			cropper: {
				showGrid: true,
			},
			onSave: function(dataURL, item) {
				saveEditedImage(item);
			}	
		},
        captions: {
            confirm: 'Lưu',
            cancel: 'Hủy',
            name: 'Tên',
            type: 'Loại',
            size: 'Dung lượng',
            dimensions: 'Kích thước',
            duration: 'Thời lượng',
            crop: 'Cắt ảnh',
            rotate: 'Xoay ảnh',
            download: 'Tải về',
            remove: 'Xóa',
            drop: 'Kéo file ảnh vào đây để upload',
            paste: '<div class="fileuploader-pending-loader"><div class="left-half" style="animation-duration: ${ms}s"></div><div class="spinner" style="animation-duration: ${ms}s"></div><div class="right-half" style="animation-duration: ${ms}s"></div></div> Pasting a file, click here to cancel.',
            removeConfirmation: 'Bạn có thực sự muốn xóa file này?',
            errors: {
                filesLimit: 'Bạn chỉ được phép tải lên ${limit} ảnh.',
                filesType: 'Bạn chỉ được phép tải lên những định đang này: ${extensions}.',
                fileSize: 'File ${name} quá lớn! Bạn chỉ được phép tải lên ${fileMaxSize} MB.',
                filesSizeAll: 'File của bạn quá lớn! Bạn chỉ được phép tải lên ${maxSize} MB.',
                fileName: 'Có vẻ như file ${name} đã được tải lên. Hãy đổi tên file thành tên khác.',
                folderUpload: 'You are not allowed to upload folders.'
            }
        }
	});
	
	
	
	
});
$("li input[type=radio]").on("click",function(){
		console.log($(this).parent().parent().html());
	});