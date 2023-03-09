<?php
class Core {
    function Init() {
		define("IN_BRUE_CORE", "true");
        define("DS", DIRECTORY_SEPARATOR);
        define("CWD", dirname(__FILE__) . DS);
        session_start();
    }
    
    function openDatabase() {
        require("config.php");
        
        global $db;
        
        if(!$db->Connect($cfg['sql']['host'], $cfg['sql']['user'], $cfg['sql']['pass'], $cfg['sql']['name'])) {
            die("Could not connect to database. Please contact the webmaster.");
        }
    }
    
    function closeDatabase() {
    	global $db;
    	
    	$db->Close();
    }
    
    function Output($data, $level = 0) {
    	if($level > 0) {
    		for($i = 0; $i < $level; $i++) {
    			print("	");
    		}
    	}
    	
    	print($data . "\n");
    }
    
    function inFile($file) {
    	if($_SERVER['PHP_SELF'] == CORE_ROOT . $file) {
    		return true;
    	} else {
    		return false;
    	}
    }
    
    function randomString($amount) {
    	$val = '';
		$charset = "abcdefghijkmnpqrstuvwxyz0123456789";
		
		for ($i = 0; $i < $amount; $i++)
		{
   			$val .= $charset[mt_rand(0, strlen($charset) - 1)];
		}
 
		return $val;
    }
    
	function fileNameExtension($FileName) {
	   $pos = strrpos($FileName, '.');
	   
	   if($pos === false) {
	       return false;
	   } else {
	       return substr($FileName, $pos + 1);
	   }
	}
	
	function getRealIP(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
	}
	
	function byteSize ( $file_size )
	{
		$file_size = $file_size-1;
		if ($file_size >= 1099511627776) $show_filesize = number_format(($file_size / 1099511627776),2) . "TB";
		elseif ($file_size >= 1073741824) $show_filesize = number_format(($file_size / 1073741824),2) . "GB";
		elseif ($file_size >= 1048576) $show_filesize = number_format(($file_size / 1048576),2) . "MB";
		elseif ($file_size >= 1024)  $show_filesize = number_format(($file_size / 1024),2) . "KB";
		elseif ($file_size > 0) $show_filesize = $file_size . "bytes";
		elseif ($file_size == 0 OR $file_size == -1) $show_filesize = "0 bytes";
		
		return $show_filesize;
	}
	
	function Processing($name) {
		if(isset($_POST[$name])) {
			return true;
		} else {
			return false;
		}
	}
	
	function generateQuestion() {
		$n1 = rand(0, 9);
		$n2 = rand(0, 9);
		$na = n1 + n2;
		
		$rs = $this->randomString(2 * rand(2, 10));
		$Questions = array(
			"Copy and paste this into the textbox: " . $rs 			=> $rs,
			"How many legs does a normal human have?" 				=> "2",
			"What year is it?" 										=> "2010",
			"What is {$n1} plus {$n2}?" 							=> $na,
			"Is this a filesharing/uploading website?" 				=> "yes",
			"Can you upload illegal content with bruestorage?"		=> "no"
		);
				
		$randQuestion = array_rand($Questions, 1);
		$_SESSION['q_answer'] = $Questions[$randQuestion];
		return $randQuestion;
	}
	
	function handleIndexActions() {
		global $user;
		
		$Action = $_GET['action'];
		
		switch($Action) {
			case "logout":
				$user->Logout();
			break;
		}
	}
	
	function sendAdminMail($Message, $Name, $From) {
		$to      = ADMIN_EMAIL;
		$subject = 'Bruestorage, contact from ' . $Name;
		$message = $Message;
		$headers = 'From: ' . $From . "\r\n" .
			'Reply-To: ' . $From . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	}
	
	function validEmail($email)
	{
		$lengthPattern = "/^[^@]{1,64}@[^@]{1,255}$/";
		$syntaxPattern = "/^((([\w\+\-]+)(\.[\w\+\-]+)*)|(\"[^(\\|\")]{0,62}\"))@(([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9]{2,})|\[?([1]?\d{1,2}|2[0-4]{1}\d{1}|25[0-5]{1})(\.([1]?\d{1,2}|2[0-4]{1}\d{1}|25[0-5]{1})){3}\]?)$/";
	
		return ((preg_match($lengthPattern, $email) > 0) && (preg_match($syntaxPattern, $email) > 0)) ? true : false;
	}

	function Shorten( $str, $num = 10 ) {
	  if( strlen( $str ) > $num ) $str = substr( $str, 0, $num ) . "...";
	  return $str;
	}

	function Ago($timestamp){
		$difference = time() - $timestamp;
		$periods = array("second", "minute", "hour", "day", "week", "month", "years", "decade");
		$lengths = array("60","60","24","7","4.35","12","10");
		
		for($j = 0; $difference >= $lengths[$j]; $j++)
			$difference /= $lengths[$j];
			
		$difference = round($difference);
		
		if($difference != 1) $periods[$j].= "s";
		
		$text = "$difference $periods[$j] ago";
		
		return $text;
	} 
	
	function smart_resize_image($file,
								$width = 0,
								$output = 'file',
								$height = 0,
								$proportional = true,
								$crop = true,
								$delete_original = false,
								$use_linux_commands = false,
								$apply_watermark = true) {
	      
		if ( $height <= 0 && $width <= 0 ) return false;
	 
		# Setting defaults and meta
	    $info = getimagesize($file);
	    $image = '';
	    $final_width = 0;
	    $final_height = 0;
	    list($width_old, $height_old) = $info;
	 
	    # Calculating proportionality
	    if ($proportional) {
			if ($width == 0){
				if($height!=0 && $height_old!=0) {
					$factor = $height/$height_old;
				}
			} elseif ($height == 0) {
				$factor = $width/$width_old;
			} else {
				$factor = min($width/$width_old,$height/$height_old);
			}
			
			$final_width = round ($width_old * $factor);
			$final_height = round ($height_old * $factor);
	    } else {
	      $final_width = ( $width <= 0 ) ? $width_old : $width;
	      $final_height = ( $height <= 0 ) ? $height_old : $height;
	    }
		
	    $int_width = 0;
		$int_height = 0;
	
		$adjusted_height = $final_height;
		$adjusted_width = $final_width;
	
		if ($crop) {
			$wm = $width_old/$width;
			$hm = $height_old/$height;
			$h_height = $height/2;
			$w_height = $width/2;
			
			$ratio = $width/$height;
			$old_img_ratio = $width_old/$height_old;
	
			if ($old_img_ratio > $ratio) {
				$adjusted_width = $width_old / $hm;
				$half_width = $adjusted_width / 2;
				$int_width = $half_width - $w_height;
			} else if($old_img_ratio <= $ratio) {
				$adjusted_height = $height_old / $wm;
				$half_height = $adjusted_height / 2;
				$int_height = $half_height - $h_height;
			}
		}
		
	    # Loading image to memory according to type
	    switch ( $info[2] ) {
	      case IMAGETYPE_GIF: $image = imagecreatefromgif($file); break;
	      case IMAGETYPE_JPEG: $image = imagecreatefromjpeg($file); break;
	      case IMAGETYPE_PNG: $image = imagecreatefrompng($file); break;
	      default: return false;
	    }
	    
	    
	    # This is the resizing/resampling/transparency-preserving magic
	    $image_resized = imagecreatetruecolor( $final_width, $final_height );
	    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
	      $transparency = imagecolortransparent($image);
	 
	      if ($transparency >= 0) {
	        $transparent_color = imagecolorsforindex($image, $trnprt_indx);
	        $transparency = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
	        imagefill($image_resized, 0, 0, $transparency);
	        imagecolortransparent($image_resized, $transparency);
	      }
	      elseif ($info[2] == IMAGETYPE_PNG) {
	        imagealphablending($image_resized, false);
	        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
	        imagefill($image_resized, 0, 0, $color);
	        imagesavealpha($image_resized, true);
	      }
	    }
	    if ($apply_watermark) {
	 
		$outputWidth = floor($rawWidth * $imageScaleTo);
		$outputHeight = floor($rawHeight * $imageScaleTo);
	 
		$outputImage = Imagecreatetruecolor($final_width, $final_height);
		imagecopyresampled($image_resized, $image, -$int_width, -$int_height, 0, 0, $adjusted_width, $adjusted_height, $width_old, $height_old);
	 
		// Turn on alpha blending
		imagealphablending($outputImage, true);
	 
		// Create overlay image - Could be a png?
		$watermark = imagecreatefromgif("images/watermark.gif");
	 
		// Get the offset centering for the overlay
		$offsetWidth = floor(($final_width - imagesx($watermark))/2);
		$offsetHeight = floor(($final_height - imagesy($watermark))/2);
	 
		// Overlay watermark
		imagecopy($image_resized, $watermark, $offsetWidth, $offsetHeight, 0, 0, imagesx($watermark), imagesy($watermark));
	 
	 
		} else {
	 
			imagecopyresampled($image_resized, $image, -$int_width, -$int_height, 0, 0, $adjusted_width, $adjusted_height, $width_old, $height_old);
		}
	    
	    # Taking care of original, if needed
	    if ( $delete_original ) {
	      if ( $use_linux_commands ) exec('rm '.$file);
	      else @unlink($file);
	    }
	 
	    # Preparing a method of providing result
	    switch ( strtolower($output) ) {
	      case 'browser':
	        $mime = image_type_to_mime_type($info[2]);
	        header("Content-type: $mime");
	        $output = NULL;
	      break;
	      case 'file':
	        $output = $file;
	      break;
	      case 'return':
	        return $image_resized;
	      break;
	      default:
	      break;
	    }
	    
	    # Writing image according to type to the output destination
		switch ( $info[2] ) {
			case IMAGETYPE_GIF: imagegif($image_resized, $output); break;
			case IMAGETYPE_JPEG: imagejpeg($image_resized, $output, 100); break;
			case IMAGETYPE_PNG: imagepng($image_resized, $output); break;
			default: return false;
		}
	 
		return true;
	}
}
?>