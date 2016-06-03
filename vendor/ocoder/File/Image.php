<?php

namespace Zendvn\File;

use PHPImageWorkshop\ImageWorkshop;

class Image {
	
	public function upload($fileInput, $options = null){
		if($options['task'] == 'user-avatar'){
			$uploadObj 			= new Upload();
			$uploadDirectory	= PATH_FILES . '/users/';
			$fileName			= $uploadObj->uploadFile($fileInput, $uploadDirectory, array('task' => 'rename'), 'user_');
				
			$layer = ImageWorkshop::initFromPath(PATH_FILES . '/users/' . $fileName);
			$layer->cropMaximumInPixel(0, 0, "MM");
			$layer->resizeInPixel(215, 215, true);
			$layer->save(PATH_FILES . '/users/thumb', $fileName, true);
			
			return $fileName;
		}
	}
	
	public function removeImage($fileName, $options = null){
		if($options['task'] == 'user-avatar'){
			$fileMain	= PATH_FILES . '/users/' . $fileName;
			@unlink($fileMain);
			
			$fileThumb	= PATH_FILES . '/users/thumb/' . $fileName;
			@unlink($fileThumb);
		}
	}
}