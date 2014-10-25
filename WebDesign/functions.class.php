<?php
namespace WebDesign;

class Functions
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
	    return true;
	}

	public function listFolderContent($dir,$path) {
        $r = array();
        $list = scandir($dir);
        foreach ($list as $item) {
            if($item!='.' && $item!='..'){
                if(is_file($path.$item)){
                    $r['files'][] = $path.$item;
                }elseif(is_dir($path.$item)){
                    $r['folders'][] = $path.$item;
                    $sub = $this->listFolderContent($path.$item,$path.$item.'/');
                    if(isset($sub['files']) && count($sub['files'])>0)
                        $r['files'] = isset ($r['files'])?array_merge ($r['files'], $sub['files']):$sub['files'];
                    if(isset($sub['folders']) && count($sub['folders'])>0)
                        $r['folders'] = array_merge ($r['folders'], $sub['folders']);
                }
            }
        }
        return $r;
    }

    public static function check($check) {

    	if(isset($_POST["gallery"])) {

    		if ($_POST["gallery"] == $check) {
    			echo 'selected="selected"';
    		}
    	}

    }

       public static function checkYear($check) {

    	if(isset($_POST["year"])) {

    		if ($_POST["year"] == $check) {
    			echo 'selected="selected"';
    		}
    	}

    }


	public static function upload($name,$path, $allowZip = false,$max = true) {
		$allowedExts = array("gif", "jpeg", "jpg", "JPG", "x-png", "png", "pjpeg","JPEG");
		$temp = explode(".", $_FILES[$name]["name"]);
		$extension = end($temp);
		require_once "WebDesign/simpleimage.class.php";

		//echo $_FILES[$name]["type"] . "<br>";

		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png")
		|| ($_FILES["file"]["type"] == "image/JPEG")
		|| ($_FILES["file"]["type"] == "image/JPG"))
		
		&& in_array($extension, $allowedExts)) {
		
		  if ($_FILES[$name]["error"] > 0)
		    {
		   //echo "Return Code: " . $_FILES[$name]["error"] . "<br>";
		    }
		  else
		    {
		    //echo "Upload: " . $_FILES[$name]["name"] . "<br>";
		    //echo "Type: " . $_FILES[$name]["type"] . "<br>";
		    //echo "Size: " . ($_FILES[$name]["size"] / 1024) . " kB<br>";
		    //echo "Temp file: " . $_FILES[$name]["tmp_name"] . "<br>";

		    if (file_exists($path . $_FILES[$name]["name"]))
		      {
		      //echo $_FILES[$name]["name"] . " already exists. ";
		      }
		    else
		      {
		      move_uploaded_file($_FILES[$name]["tmp_name"],
		      $path . $_FILES[$name]["name"]);

		      if ($max) {
			    $image = new SimpleImage();
			    $image->load($path . $_FILES[$name]["name"]);		      
			    $image->resizeToWidth(900);
			    $image->save($path . $_FILES[$name]["name"]);
			    unset($image);
			  }
		      //echo "Stored in: " . "upload/" . $_FILES[$name]["name"];
		      }
		    }

		} elseif($allowZip) {


			if($_FILES[$name]["name"]) {
				$filename = $_FILES[$name]["name"];
				$source = $_FILES[$name]["tmp_name"];
				$type = $_FILES[$name]["type"];
				
				$name = explode(".", $filename);
				$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
				foreach($accepted_types as $mime_type) {
					if($mime_type == $type) {
						$okay = true;
						break;
					} 
				}
				
				$continue = strtolower($name[1]) == 'zip' ? true : false;
				if(!$continue) {
					$message = "The file you are trying to upload is not a .zip file. Please try again.";
				}

				$target_path = $path . $filename;  // change this to the correct site path
				if(move_uploaded_file($source, $target_path)) {
					$zip = new \ZipArchive();

					//$path = "zip_file.zip";					
					
					if ($zip->open($target_path) === true) {
					    for($i = 0; $i < $zip->numFiles; $i++) {
					        $filename = $zip->getNameIndex($i);
					        $fileinfo = pathinfo($filename);

					        if (preg_match('#\.(jpg|jpeg|gif|png)$#i', $filename)) {
					        	$zip->extractTo($path, array($filename));
					    	}					       
					    }                  
					    $zip->close();                  
					}
					unlink($target_path);
					
					$message = "Your .zip file was uploaded and unpacked.";
				} else {	
					$message = "There was a problem with the upload. Please try again.";
				}
			}
		}		  
	}

	public static function uploadThumbnail($name,$path,$thumbnailPath,$max = false) {
		$allowedExts = array("gif", "jpeg", "jpg", "JPG", "x-png", "png", "pjpeg","JPEG");
		$temp = explode(".", $_FILES[$name]["name"]);
		$extension = end($temp);
		require_once "WebDesign/simpleimage.class.php";

		//echo $_FILES[$name]["type"] . "<br>";

		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png")
		|| ($_FILES["file"]["type"] == "image/JPEG")
		|| ($_FILES["file"]["type"] == "image/JPG"))
		
		&& in_array($extension, $allowedExts)) {
		
		  if ($_FILES[$name]["error"] > 0)
		    {
		   //echo "Return Code: " . $_FILES[$name]["error"] . "<br>";
		    }
		  else
		    {
		    //echo "Upload: " . $_FILES[$name]["name"] . "<br>";
		    //echo "Type: " . $_FILES[$name]["type"] . "<br>";
		    //echo "Size: " . ($_FILES[$name]["size"] / 1024) . " kB<br>";
		    //echo "Temp file: " . $_FILES[$name]["tmp_name"] . "<br>";

		    if (file_exists($path . $_FILES[$name]["name"]))
		      {
		      //echo $_FILES[$name]["name"] . " already exists. ";
		      }
		    else
		      {
		      move_uploaded_file($_FILES[$name]["tmp_name"],
		      $path . $_FILES[$name]["name"]);
		     
		      $image = new SimpleImage();
		      $image->load($path . $_FILES[$name]["name"]);
		      if ($max) {
			      $image->resizeToWidth(900);
			      $image->save($path . $_FILES[$name]["name"]);
			  }
		      $image->resizeToWidth(120);
		      $image->save($thumbnailPath . $_FILES[$name]["name"]);
		      unset($image);
		      
		      //echo "Stored in: " . "upload/" . $_FILES[$name]["name"];
		      }
		    }

		} else {


			if($_FILES[$name]["name"]) {
				$filename = $_FILES[$name]["name"];
				$source = $_FILES[$name]["tmp_name"];
				$type = $_FILES[$name]["type"];
				
				$name = explode(".", $filename);
				$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
				foreach($accepted_types as $mime_type) {
					if($mime_type == $type) {
						$okay = true;
						break;
					} 
				}
				
				$continue = strtolower($name[1]) == 'zip' ? true : false;
				if(!$continue) {
					$message = "The file you are trying to upload is not a .zip file. Please try again.";
				}

				$target_path = $path . $filename;  // change this to the correct site path
				if(move_uploaded_file($source, $target_path)) {
					$zip = new \ZipArchive();

					//$path = "zip_file.zip";					
					
					if ($zip->open($target_path) === true) {
					    for($i = 0; $i < $zip->numFiles; $i++) {
					        $filename = $zip->getNameIndex($i);
					        $fileinfo = pathinfo($filename);

					        if (preg_match('#\.(jpg|jpeg|gif|png)$#i', $filename)) {
					        	$zip->extractTo($path, $filename);

					        	rename($path . $filename, $path . $fileinfo["basename"]);

					        	$image = new SimpleImage();
						      	$image->load($path . $fileinfo["basename"]);
						      	if ($max) {
								    $image->resizeToWidth(1200);
								    $image->save($path . $_FILES[$name]["name"]);
								}
						     	$image->resizeToWidth(120);
						      	$image->save($thumbnailPath . $fileinfo["basename"]);
						      	unset($image);
						      	
					    	}					       
					    }
					    rmdir($path . $fileinfo["dirname"]);
					    $zip->close();                  
					}
					unlink($target_path);
					
					$message = "Your .zip file was uploaded and unpacked.";
				} else {	
					$message = "There was a problem with the upload. Please try again.";
				}
			}
		}

	}



}