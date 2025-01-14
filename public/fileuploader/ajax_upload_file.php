<?php
    include('class.fileuploader.php');

	$isAfterEditing = false;
	$fileuploader_title = 'name';
	$fileuploader_replace = false;

	// if after editing
	if (isset($_POST['_namee']) && isset($_POST['_editorr'])) {
		$fileuploader_title = $_POST['_namee'];
		$fileuploader_replace = true;
		$isAfterEditing = true;
	}
	
	// initialize FileUploader
    $FileUploader = new FileUploader('files', array(
        'limit' => 100,
        'maxSize' => null,
		'fileMaxSize' => 2,
        'extensions' => ['jpg', 'jpeg', 'png', 'gif','JPG','PNG','GIF'],
        'required' => false,
        'uploadDir' => '../temp_upload/',
        'title' => 'name',
		'replace' => $fileuploader_replace,
        'listInput' => true,
        'files' => null
    ));
	
	// call to upload the files
    $upload = $FileUploader->upload();

	// export to js
	echo json_encode($upload);
	exit;