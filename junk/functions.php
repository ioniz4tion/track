<?php	
class functions
{

	public $login;
	
	function __construct()
	{
		session_start("lchsTrackLogin");
	    if (!array_key_exists("lchsTrackLogin",$_SESSION)) {
			$_SESSION["lchsTrackLogin"] = 0;
		}
		

		if ($_SESSION["lchsTrackLogin"] == true) {
			$this->login = true;
		} else {
			$this->login = false;
		}
	}
	


	//deletes a directory
	public static function deleteDir($dirPath) {
	    if (! is_dir($dirPath)) {
	        throw new InvalidArgumentException("$dirPath must be a directory");
	    }
	    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	        $dirPath .= '/';
	    }
	    $files = glob($dirPath . '*', GLOB_MARK);
	    foreach ($files as $file) {
	        if (is_dir($file)) {
	            self::deleteDir($file);
	        } else {
	            unlink($file);
	        }
	    }
	    rmdir($dirPath);
	}


}