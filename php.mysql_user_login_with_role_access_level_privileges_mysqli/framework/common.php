<?php



## Debug the Array ##

function test($test){

	echo "<pre>";

		print_r($test);

	echo "</pre>";
//	exit;
}


function putInFile($value,$filname='putInFile.txt'){
// The new of the file
// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
file_put_contents($filname, var_export($value, true), FILE_APPEND | LOCK_EX);
}

function logThis($message) {
	$logFilePath = dirname(__FILE__).'/sitelogs/';
	$date = new DateTime();
	$myLogFile = $logFilePath . $date->format('Y-m-d').".log";

	if(is_dir($logFilePath)) {
		if(!file_exists($myLogFile)) {
			/* create log file with first message on new day*/
			$fh  = fopen($myLogFile, 'a+') or die("Fatal Error !");
			$logcontent = "LogTime: " . $date->format('H:i:s')."\r\nLogText: " . $message ."\r\n";
			fwrite($fh, $logcontent);
			fclose($fh);
		}else{
			/* edit/update log file with new message on same day */
			$logcontent = "LogTime: " . $date->format('H:i:s')."\r\nLogText: " . $message ."\r\n\r\n";
			$logcontent = $logcontent . file_get_contents($myLogFile);
			file_put_contents($myLogFile, $logcontent);			

		}
	}else{if(mkdir($logFilePath,0777) === true){logThis($message);}}
}




function getFullCurrentUrlAddress(){
	$protocol = "";
	/*** check for https ***/
	//$protocol = @$_SERVER['HTTPS'] == 'on' ? 'https:' : 'http:';
	/*** return the full address ***/
	return $protocol.'//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}

function getReadMore($text,$cLnth,$endWith = ''){
	$result = substr($text, 0, $cLnth)." ".$endWith; ## Show the fixed length with incomplete last word ##
	//$result = substr($text, 0, strpos($text, ' ', $cLnth))." ".$endWith;  ## Show the full last word must be a long text ##
	return $result;
}
	
function formatMoney($number, $fractional=true) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
} 

## Browser detection ##

function getBrowser(){ 

    $u_agent = $_SERVER['HTTP_USER_AGENT']; 

    $bname = 'Unknown';

    $platform = 'Unknown';

    $version= "";

    //First get the platform?

    if (preg_match('/linux/i', $u_agent)){

        $platform = 'linux';

    }

    elseif (preg_match('/macintosh|mac os x/i', $u_agent)){

        $platform = 'mac';

    }

    elseif(preg_match('/windows|win32/i', $u_agent)){

        $platform = 'windows';

    }

    

    // Next get the name of the useragent yes seperately and for good reason

    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){

        $bname = 'IE'; 

        $ub = "MSIE"; 

    } 

    elseif(preg_match('/Firefox/i',$u_agent)){ 

        $bname = 'MozillaFirefox'; 

        $ub = "Firefox"; 

    }

    elseif(preg_match('/Chrome/i',$u_agent)){ 

        $bname = 'GoogleChrome'; 

        $ub = "Chrome"; 

    }

    elseif(preg_match('/Safari/i',$u_agent)){ 

        $bname = 'AppleSafari';

        $ub = "Safari";

    }

    elseif(preg_match('/Opera/i',$u_agent)){

        $bname = 'Opera';

        $ub = "Opera";

    }

    elseif(preg_match('/Netscape/i',$u_agent)){

        $bname = 'Netscape';

        $ub = "Netscape";

    } 

    

    // finally get the correct version number

    $known = array('Version', $ub, 'other');

    $pattern = '#(?<browser>' . join('|', $known) .

    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

    if (!preg_match_all($pattern, $u_agent, $matches)){

        // we have no matching number just continue

    }

    

    // see how many we have

    $i = count($matches['browser']);

    if ($i != 1){

        //we will have two since we are not using 'other' argument yet, see if version is before or after the name

        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){

            $version= $matches['version'][0];

        }else{

            $version= $matches['version'][1];

        }

    }else{

        $version= $matches['version'][0];

    }

    

    // check if we have a number

    if ($version==null || $version==""){

		$version="?";

	}

    //return array('userAgent'=>$u_agent,'name'=>$bname,'version'=>$version,'platform'=>$platform,'pattern'=>$pattern);

	//return $bname;

	

	// now try it, Block IE

	if($bname === 'IE'){

		echo "Please Download <a href='http://www.mozilla.org/en-US/firefox/all/' target='new'>Mozilla Firefox</a> or <a href='http://support.google.com/chrome/bin/answer.py?hl=en&answer=95346' target='new'>Google Chrome</a> for robust performance.";		

	}

}


function getAmountInWords($num,$rup='RUPEES',$paise='PAISE'){ 
$decones = array('01' => "One", '02' => "Two", '03' => "Three", '04' => "Four", '05' => "Five", '06' => "Six", '07' => "Seven", '08' => "Eight", '09' => "Nine", 10 => "Ten", 11 => "Eleven", 12 => "Twelve", 13 => "Thirteen", 14 => "Fourteen", 15 => "Fifteen", 16 => "Sixteen", 17 => "Seventeen", 18 => "Eighteen", 19 => "Nineteen" );
$ones = array( 0 => " ",1 => "One",2 => "Two", 3 => "Three", 4 => "Four", 5 => "Five", 6 => "Six", 7 => "Seven", 8 => "Eight", 9 => "Nine", 10 => "Ten", 11 => "Eleven", 12 => "Twelve", 13 => "Thirteen", 14 => "Fourteen", 15 => "Fifteen", 16 => "Sixteen", 17 => "Seventeen", 18 => "Eighteen", 19 => "Nineteen"); 
$tens = array( 0 => "",2 => "Twenty", 3 => "Thirty", 4 => "Forty", 5 => "Fifty", 6 => "Sixty", 7 => "Seventy", 8 => "Eighty", 9 => "Ninety" ); 
$hundreds = array( "Hundred", "Thousand", "Million", "Billion", "Trillion", "Quadrillion"); /*limit t quadrillion */
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1];
$whole_arr = array_reverse(explode(",",$wholenum));
krsort($whole_arr);
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
if($i < 20){$rettxt .= $ones[$i];}
elseif($i < 100){$rettxt .= $tens[substr($i,0,1)]; $rettxt .= " ".$ones[substr($i,1,1)];}
else{ $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; $rettxt .= " ".$tens[substr($i,1,1)]; $rettxt .= " ".$ones[substr($i,2,1)];} 
if($key > 0){ $rettxt .= " ".$hundreds[$key]." "; } 
}
$rettxt = $rettxt." ".strtoupper($rup);
if($decnum > 0){ $rettxt .= " and "; if($decnum < 20){ 
$rettxt .= $decones[$decnum]; 
}elseif($decnum < 100){ 
$rettxt .= $tens[substr($decnum,0,1)]; 
$rettxt .= " ".$ones[substr($decnum,1,1)]; 
} 
$rettxt = $rettxt." ".strtoupper($paise); 
} 
return strtoupper($rettxt);
} 

function getAddBarFullURL() {

    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';

//    echo $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	

	return $protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

}


function getDaysToExpire($date){
	$current = time();
	$target = $date;
	$target = strtotime($target);
	if($target > $current){
		$span = $target - $current;
		$daysLeft = ceil($span / (60 * 60 * 24));
		//echo 'You have less than '.$span.' days!';exit;
		return $daysLeft;
	} else {
		//echo 'Time has already expired!';exit;
		return 0;
	}
}


## Session Messages and Errors ##

function msgs(){

	if(!isset($_SESSION['msgs'])){

		$_SESSION['msgs'] = "";	

	}

	else{

		$msgs = $_SESSION['msgs'];

		echo $msgs;

		unset($_SESSION['msgs']);

	}

}



## Session Messages and Errors ##

function msgsSet($msgs,$type){

	switch($type){

		case 's':

		$msmgVal = "

		<div class='alert alert-success alert-dismissable'>

            <a href='' class='close'>&times;</a>

            ".$msgs."

        </div>";

		break;

		

		case 'e':

		$msmgVal = "

		<div class='alert alert-danger alert-dismissable'>

            <a href='' class='close'>&times;</a>

            ".$msgs."

        </div>";

		break;

		

		case 'i':

		$msmgVal = "

		<div class='alert alert-info alert-dismissable'>

            <a href='' class='close'>&times;</a>

            ".$msgs."

        </div>";

		break;

		

		case 'w':

		$msmgVal = "

		<div class='alert alert-warning alert-dismissable'>

            <a href='' class='close'>&times;</a>

            ".$msgs."

        </div>";

		break;

	}

	return $msmgVal;

}




## Session Messages and Errors ##

function showActiveness($status){
	switch($status){
		case 0:
		$output = "<span class=\"label label-danger\">Blocked</span>";
		break;
		case 1:
		$output = "<span class=\"label label-warning\">Pending</span>";
		break;
		case 2:
		$output = "<span class=\"label label-success\">Active</span>";
		break;	
	}
	return $output;
}



## Session Messages and Errors ##

function showStts($type){

	switch($type){
		case 1:
		$output = "<span class=\"label label-success\">Online</span>";
		break;

		case 0:
		$output = "<span class=\"label label-default\">Offline</span>";
		break;
	}

	return $output;

}

## Session Messages and Errors ##

function showAprovd($status){
	switch($status){
		case 0:
		$output = "<span class=\"label label-danger\">Dismissed</span>";
		break;
		case 1:
		$output = "<span class=\"label label-warning\">Pending</span>";
		break;
		case 2:
		$output = "<span class=\"label label-success\">Approved</span>";
		break;
		case 3:
		$output = "<span class=\"label label-default\">Expired</span>";
		break;		
	}
	return $output;
}


## Filter the String for Special Charectors if any used ##

function echoStr($string){

	$escaped_string = html_entity_decode($string);

	return $escaped_string;

}





## URL Query String On ##

function encQryStr($valu) {

	return rtrim(strtr(base64_encode($valu), '+/', '-_'), '=');

}



## URL Query String Off ##

function decQryStr($valu) {

	return base64_decode(str_pad(strtr($valu, '-_', '+/'), strlen($valu) % 4, '=', STR_PAD_RIGHT));

//	echo base64_decode(str_pad(strtr($valu, '-_', '+/'), strlen($valu) % 4, '=', STR_PAD_RIGHT));

} 





## Genrate Secure Code ##

function randGenSecCode($len){

	$randCodresult = "";

    $chars = "abcdefghijklmnopqrstuvwxyz!@#$%&?ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $charArray = str_split($chars);

    for($i = 0; $i < $len; $i++){

	    $randItem = array_rand($charArray);

	    $randCodresult .= "".$charArray[$randItem];

    }

    return $randCodresult;

}


## Genrate iCal file Name ##

function geniCalFileName($len=25){

	$randCodresult = "";

    //$chars = "1234567890abcdefghijklmnopqrstuvwxyz0123456789";
	$chars = "12345qwertyuiop67890asdfghjkl12345zxcvbnm67890";

    $charArray = str_split($chars);

    for($i = 0; $i < $len; $i++){

	    $randItem = array_rand($charArray);

	    $randCodresult .= "".$charArray[$randItem];

    }

    return $randCodresult.".ics";

}


## Is Secure Code Valid ##

function isSecCodeReal($code){

 	global $db;	

	//$code = decQryStr($code);

	$sql="SELECT pass_reset_scode FROM login WHERE pass_reset_scode = '".$code."'";

	return fetchNRow($db,$sql);

}



## Redirection ##

function goLoad($new_location) {

  header("Location: " .$new_location);

  exit;

}





## Image Size Compress ##

function compressImage($source_url, $destination_url, $quality){

	$info = getimagesize($source_url);

	if($info['mime'] == 'image/jpeg'){ 

		$image = imagecreatefromjpeg($source_url);

	}elseif($info['mime'] == 'image/gif'){

		$image = imagecreatefromgif($source_url);

	}elseif($info['mime'] == 'image/png'){

		$image = imagecreatefrompng($source_url);

	}

	//save it

	// Set $quality values between 0 - 100 % 

	imagejpeg($image, $destination_url, $quality);

	//return destination file url

	//return $destination_url;

}


## Image Resized and Compressed ##
function resizeAndCompressImage($sourceImage, $targetImage, $maxWidth, $maxHeight, $quality = 50){
    if (!$image = @imagecreatefromjpeg($sourceImage)){
        return false;
    }
    // Get dimensions of source image.
    list($origWidth, $origHeight) = getimagesize($sourceImage);
    if ($maxWidth == 0){
        $maxWidth  = $origWidth;
    }
    if ($maxHeight == 0){
        $maxHeight = $origHeight;
    }
	
    // Calculate ratio of desired maximum sizes and original sizes.
    $widthRatio = $maxWidth / $origWidth;
    $heightRatio = $maxHeight / $origHeight;

    // Ratio used for calculating new image dimensions.
    $ratio = min($widthRatio, $heightRatio);

    // Calculate new image dimensions.
    $newWidth  = (int)$origWidth  * $ratio;
    $newHeight = (int)$origHeight * $ratio;

    // Create final image with new dimensions.
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
    imagejpeg($newImage, $targetImage, $quality);

    // Free up the memory.
    imagedestroy($image);
    imagedestroy($newImage);
    return true;
}


## Error Handler Advance php/mysql errors Detector ##

function errorHandler($errno, $errstr, $errfile, $errline){

switch($errno){

 case 1: $errTyp = 'E_ERROR'; break;

 case 2: $errTyp = 'E_WARNING'; break;

 case 4: $errTyp = 'E_PARSE'; break;

 case 8: $errTyp = 'E_NOTICE'; break;

 case 16: $errTyp = 'E_CORE_ERROR'; break;

 case 32: $errTyp = 'E_CORE_WARNING'; break;

 case 64: $errTyp = 'E_COMPILE_ERROR'; break;

 case 128: $errTyp = 'E_COMPILE_WARNING'; break;

 case 256: $errTyp = 'E_USER_ERROR'; break;

 case 512: $errTyp = 'E_USER_WARNING'; break;

 case 1024: $errTyp = 'E_USER_NOTICE'; break;

 case 2048: $errTyp = 'E_STRICT'; break;

 case 4096: $errTyp = 'E_RECOVERABLE_ERROR'; break;

 case 8192: $errTyp = 'E_DEPRECATED'; break;

 case 16384: $errTyp = 'E_USER_DEPRECATED'; break;

 } 

	$output= "$errTyp [$errno] ($errstr)Please Check File: $errfile on line [$errline] \n";

		if(ERROR_SEND == 'LOG'){

			error_log("\nError With = PHP\nError Date = ".date("Y-m-d h:i:s a")."\nError Type = $errTyp [$errno] \nError Found = $errstr \nError File = $errfile on line ($errline) \n--------------------------------------------------------------------------------------------------", 3, "myPHPErrorLog.txt");

		}

		if(ERROR_SEND == 'MAIL'){

			error_log("\nError With = PHP\nError Date = ".date("Y-m-d h:i:s a")."\nError Type = $errTyp [$errno] \nError Found = $errstr \nError File = $errfile on line ($errline) \n--------------------------------------------------------------------------------------------------",1,SITE_ERROR_TO_MAIL,"From: Error Log <error@".DOMAIN.">");

		}

	$output;

	exit;

}





## File Upload ##

function upload_errors($err_code) {

	switch ($err_code) { 

        case UPLOAD_ERR_INI_SIZE: 

            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini'; 

        case UPLOAD_ERR_FORM_SIZE: 

            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form'; 

        case UPLOAD_ERR_PARTIAL: 

            return 'The uploaded file was only partially uploaded'; 

        case UPLOAD_ERR_NO_FILE: 

            return 'No file was uploaded'; 

        case UPLOAD_ERR_NO_TMP_DIR: 

            return 'Missing a temporary folder'; 

        case UPLOAD_ERR_CANT_WRITE: 

            return 'Failed to write file to disk'; 

        case UPLOAD_ERR_EXTENSION: 

            return 'File upload stopped by extension'; 

        default: 

            return 'Unknown upload error'; 

    } 

} 



## SEO Friendly Query Strings ##

function seoFriendlyURL($strVlu){

    $strVlu = str_replace(array('[\', \']'), '', $strVlu);

    $strVlu = preg_replace('/\[.*\]/U', '', $strVlu);

    $strVlu = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $strVlu);

    $strVlu = htmlentities($strVlu, ENT_COMPAT, 'utf-8');

    $strVlu = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $strVlu );

    $strVlu = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $strVlu);

	$strVlu = str_replace('20', '', $strVlu); 

    return strtolower(trim($strVlu, '-'));

}



## Repair with Junk Image Name Before Upload ##

function filterImgeName($pname){

	$pname = str_replace(' ', '_',strtolower($pname));

    $pname = str_replace(array('[\', \']'),'',$pname);

    $pname = preg_replace('/\[.*\]/U','',$pname);

    $pname = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-',$pname);

    $pname = htmlentities($pname,ENT_COMPAT,'utf-8');

    $pname = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1',$pname);

    $pname = preg_replace("/[^a-z0-9.-]/u","_",html_entity_decode($pname));

	return str_replace('-', '_',$pname);

}

## Resize Image ##
function resizeAndComprsMyImage($file, $height, $width, $quality){
  # Get image width/height to resize properly
     $size = GetImageSize($file);
     $img_width = $size[0];
     $img_height = $size[1];

     # In this part, we are calculating proper size for new image
     if ($img_width > $img_height) {
         $new_y = ceil(($width * $img_height) / $img_width);
         $new_x = $height;
     }else{
         $new_y = ceil(($height * $img_width) / $img_height);
         $new_x = $width;
     }

     # Create image with properly size for new sized image
     $image_p = imagecreatetruecolor($new_x, $new_y);
     $image = imagecreatefromjpeg($file);
     imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_x, $new_y, $img_width, $img_height);

     # finally, outout image file with correct header mime-type
     imagejpeg($image_p, null, $quality);
     Header("Content-type: image/jpeg");
 }



## Captcah Function ##

function myCaptcha($length = 6){

    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, strlen($characters) - 1)];

    }

    return $randomString;

}



## Dates Between Dates ##

function getDatesFromRange($startDate,$endDate){

	$dateArry = array($startDate);

	$start = $startDate;

	$i=1;

    if(strtotime($startDate) < strtotime($endDate)){

		while(strtotime($start) < strtotime($endDate)){

			$start = date('Y/m/d', strtotime($startDate.'+'.$i.' days'));

			$dateArry[] = $start;

			$i++;

		}

    }

return $dateArry;

}





## Date And Time ##

// eg.: myTime("Asia/Kolkata",'d/M/Y h:i:s A T');

function myTime($zone,$format,$date=''){

	date_default_timezone_set($zone);

	return date($format,($date==''?time():$date));

}







function timeForward($time){

	$curTime = time();

	$output = '';

	if($time <= $curTime){

		$output = "Invalid Time";

	}else{

		$timeCalculated = $time - $curTime;

		$seconds 	= $timeCalculated ;

		$minutes 	= round($timeCalculated / 60 );

		$hours 		= round($timeCalculated / 3600);

		$days 		= round($timeCalculated / 86400 );

		$weeks 		= round($timeCalculated / 604800);

		$months 	= round($timeCalculated / 2600640 );

		$years 		= round($timeCalculated / 31207680 );

		

		// Seconds

		if($seconds <= 60){

			$output = "$seconds seconds left";

		}

		//Minutes

		else if($minutes <=60){

			if($minutes==1){

				$output = "1 minute left";

			}

			else{

				$output = "$minutes minutes left";

			}

		}

		//Hours

		else if($hours <=24){

			if($hours==1){

				$output = "1 hour left";

			}else{

				$output = "$hours hours left";

			}

		}

		//Days

		else if($days <= 7){

			if($days==1){

				$output = "tomorrow";

			}else{

				$output = "$days days left";

			}

		}

		//Weeks

		else if($weeks <= 4.3){

			if($weeks==1){

				$output = "1 week left";

			}else{

				$output = "$weeks weeks left";

			}

		}

		//Months

		else if($months <=12){

			if($months==1){

				$output = "1 month left";

			}else{

				$output = "$months months left";

			}

		}

		//Years

		else{

			if($years==1){

				$output = "1 year left";

			}else{

				$output = "$years years left";

			}

		}

	}

	return $output;

}



function timeBackword($time){

	$curTime	= time();

	$output		= '';

	

	if($time >= $curTime){

		$output = "Invalid Time";

	}else{

	$timeCalculated = $curTime - $time;

	$seconds 	= $timeCalculated ;

	$minutes 	= round($timeCalculated / 60 );

	$hours 		= round($timeCalculated / 3600);

	$days 		= round($timeCalculated / 86400 );

	$weeks 		= round($timeCalculated / 604800);

	$months 	= round($timeCalculated / 2600640 );

	$years 		= round($timeCalculated / 31207680 );

	

		// Seconds

		if($seconds <= 60){

			$output = "$seconds seconds ago";

		}

		//Minutes

		else if($minutes <=60){

			if($minutes==1){

				$output = "one minute ago";

			}

			else{

				$output = "$minutes minutes ago";

			}

		}

		//Hours

		else if($hours <=24){

			if($hours==1){

				$output = "an hour ago";

			}else{

				$output = "$hours hours ago";

			}

		}

		//Days

		else if($days <= 7){

			if($days==1){

				$output = "yesterday";

			}else{

				$output = "$days days ago";

			}

		}

		//Weeks

		else if($weeks <= 4.3){

			if($weeks==1){

				$output = "1 week ago";

			}else{

				$output = "$weeks weeks ago";

			}

		}

		//Months

		else if($months <=12){

			if($months==1){

				$output = "1 month ago";

			}else{

				$output = "$months months ago";

			}

		}

		//Years

		else{

			if($years==1){

				$output = "1 year ago";

			}else{

				$output = "$years years ago";

			}

		}

	}

	return $output;	

}





function timeElasped($time){

	$curTime = time();

	if($time <= $curTime){

		return timeBackword($time);

	}else{

		return timeForward($time);

	}

}


function setPakgCreditThem($type){

	switch($type){

		case 1:
		$addClass = "panel-heading-trial";
		break;
		
		case 2:
		$addClass = "panel-heading-silver";
		break;
		
		case 3:
		$addClass = "panel-heading-gold";
		break;
		
		case 4:
		$addClass = "panel-heading-platinum";
		break;				

	}
	return $addClass;
}



function getYouTubeVideo($url){
    if(strpos( $url,"v=") !== false){
        return substr($url, strpos($url, "v=") + 2, 11);
    }elseif(strpos( $url,"embed/") !== false){
        return substr($url, strpos($url, "embed/") + 6, 11);
    }
}

function createMiniThumb($imgPath,$newWidth){
	list($imgWidth, $imgHeight) = getimagesize($imgPath);
	$aspectRatio = (float)($imgWidth / $imgHeight);	
	//$newWidth = 64;
	//$newHeight = 45; /* Fixed Calculated */
    $newHeight = round($newWidth/$aspectRatio); /* Auto Calculated */
	$imageQuality = 100;
    $imageThumbSrc = imagecreatefromjpeg($imgPath);	
    $imageThumb = imagecreatetruecolor($newWidth, $newHeight);	
    imagecopyresampled($imageThumb, $imageThumbSrc, 0,0,0,0, $newWidth, $newHeight, $imgWidth, $imgHeight);	
    ob_start();
	imageJPEG($imageThumb, null, $imageQuality);
	$outputImage = ob_get_contents();
    ob_end_clean();
	$ext_type = pathinfo($imgPath, PATHINFO_EXTENSION);
	$imgDataBinary = 'data:image/'.$ext_type.';base64,'.base64_encode($outputImage);		
	// Free the memory
	imagedestroy($imageThumbSrc);
	imagedestroy($imageThumb);
	//echo '<p><img src="'.$imgDataBinary.'"></p><p>Thumb Width: '.$newWidth.'</p>';exit;
	return $imgDataBinary;
}


function cleanStr($value){
	/*
	Converting Special Characters and Symbols to HTML Number (http://www.ascii.cl/htmlcodes.htm)
	Standard ASCII set, HTML Entity names, ISO 10646, ISO 8879, ISO 8859-1 Latin alphabet No. 1
	Browser support: All browsers
	*/
	$cleanedString = $value;
	//$cleanedString = str_replace (' ','&#32;',$cleanedString); /*space*/
	$cleanedString = str_replace ('!','&#33',$cleanedString); /*exclamation point*/
	$cleanedString = str_replace ('"','&#34',$cleanedString); /*double quotes*/
	$cleanedString = str_replace ('#','&#35',$cleanedString); /* number sign | hash */
	$cleanedString = str_replace ('$','&#36',$cleanedString); /* dollar sign */
	$cleanedString = str_replace ('%','&#37',$cleanedString); /* percent sign */
	//$cleanedString = str_replace ('&','&#38',$cleanedString); /* ampersand */
	$cleanedString = str_replace ("'",'&#39',$cleanedString); /* single quote */
	$cleanedString = str_replace ('(','&#40',$cleanedString); /* opening parenthesis */
	$cleanedString = str_replace (')','&#41',$cleanedString); /* closing parenthesis */
	$cleanedString = str_replace ('*','&#42',$cleanedString); /* asterisk */
	$cleanedString = str_replace ('+','&#43',$cleanedString); /* plus */
	$cleanedString = str_replace (',','&#44',$cleanedString); /* comma */
	$cleanedString = str_replace ('-','&#45',$cleanedString); /* minus sign - hyphen */
	$cleanedString = str_replace ('.','&#46',$cleanedString); /* period */
	$cleanedString = str_replace ('/','&#47',$cleanedString); /* slash */
	$cleanedString = str_replace (':','&#58',$cleanedString); /* colon */
	$cleanedString = str_replace (';','&#59',$cleanedString); /* semicolon */
	$cleanedString = str_replace ('<','&#60',$cleanedString); /*  less than sign */
	$cleanedString = str_replace ('=','&#61',$cleanedString); /* equal sign */
	$cleanedString = str_replace ('>','&#62',$cleanedString); /* greater than sign */
	$cleanedString = str_replace ('?','&#63',$cleanedString); /* question mark */
	$cleanedString = str_replace ('@','&#64',$cleanedString); /* at symbol */
	$cleanedString = str_replace ('[','&#91',$cleanedString); /* opening bracket */
	$cleanedString = str_replace (']','&#93',$cleanedString); /* closing bracket */
	//$cleanedString = str_replace ('\'," &#92",$cleanedString); /* backslash */
	$cleanedString = str_replace ('^','&#94',$cleanedString); /* caret - circumflex */
	
return $cleanedString;
}


function echocleanStr($value){
	/*
	Converting Special Characters and Symbols to HTML Number (http://www.ascii.cl/htmlcodes.htm)
	Standard ASCII set, HTML Entity names, ISO 10646, ISO 8879, ISO 8859-1 Latin alphabet No. 1
	Browser support: All browsers
	*/
	$cleanedString = $value;
	//$cleanedString = str_replace (' ','&#32;',$cleanedString); /*space*/
	$cleanedString = str_replace ('&#33','!',$cleanedString); /*exclamation point*/
	$cleanedString = str_replace ('&#34','"',$cleanedString); /*double quotes*/
	$cleanedString = str_replace ('&#35','#',$cleanedString); /* number sign | hash */
	$cleanedString = str_replace ('&#36','$',$cleanedString); /* dollar sign */
	$cleanedString = str_replace ('&#37','%',$cleanedString); /* percent sign */
	//$cleanedString = str_replace ('&','&#38',$cleanedString); /* ampersand */
	$cleanedString = str_replace ('&#39',"'",$cleanedString); /* single quote */
	$cleanedString = str_replace ('&#40','(',$cleanedString); /* opening parenthesis */
	$cleanedString = str_replace ('&#41',')',$cleanedString); /* closing parenthesis */
	$cleanedString = str_replace ('&#42','*',$cleanedString); /* asterisk */
	$cleanedString = str_replace ('&#43','+',$cleanedString); /* plus */
	$cleanedString = str_replace ('&#44',',',$cleanedString); /* comma */
	$cleanedString = str_replace ('&#45','-',$cleanedString); /* minus sign - hyphen */
	$cleanedString = str_replace ('&#46','.',$cleanedString); /* period */
	$cleanedString = str_replace ('&#47','/',$cleanedString); /* slash */
	$cleanedString = str_replace ('&#58',':',$cleanedString); /* colon */
	$cleanedString = str_replace ('&#59',';',$cleanedString); /* semicolon */
	$cleanedString = str_replace ('&#60','<',$cleanedString); /*  less than sign */
	$cleanedString = str_replace ('&#61','=',$cleanedString); /* equal sign */
	$cleanedString = str_replace ('&#62','>',$cleanedString); /* greater than sign */
	$cleanedString = str_replace ('&#63','?',$cleanedString); /* question mark */
	$cleanedString = str_replace ('&#64','@',$cleanedString); /* at symbol */
	$cleanedString = str_replace ('&#91','[',$cleanedString); /* opening bracket */
	$cleanedString = str_replace ('&#93',']',$cleanedString); /* closing bracket */
	//$cleanedString = str_replace ('\'," &#92",$cleanedString); /* backslash */
	$cleanedString = str_replace ('&#94','^',$cleanedString); /* caret - circumflex */
	
return $cleanedString;
}

function getWeekDay($value){
	switch($value){
		case 0:	$output = "Sunday"; break;
		case 1: $output = "Monday";	break;
		case 2:	$output = "Tuesday"; break;
		case 3:	$output = "Wednesday"; break;
		case 4: $output = "Thursday"; break;
		case 5:	$output = "Friday"; break;
		case 6:	$output = "Saturday"; break;
		case 7:	$output = "Sunday"; break;
	}
	return $output;
}

function findSatAndSunFromDateRange($dateStart,$dateEnd) {
$allSat = array();
$allSun = array();
	for ($i = strtotime($dateStart); $i <= strtotime($dateEnd); $i = strtotime('+1 day', $i)) {
	  if (date('N', $i) == 6){ //Saturday == 6
		$allSat[] = date('Y-m-d', $i); // if it's a Saturday
	  }
	  if (date('N', $i) == 7){ //Sunday == 7
		$allSun[] = date('Y-m-d', $i); // if it's a Sunday
	  }
	}
return array('saturdays' => $allSat, 'sundays' => $allSun);
}


function findWeekStartEndFromDateRange($dateStart,$dateEnd,$weekStartOn = 6) {
	$arrayWeekStart = array();
	$arrayWeekEnd = array();
	$foundWeeksRough = array();
	$foundWeeks = array();
	for ($i = strtotime($dateStart); $i <= strtotime($dateEnd); $i = strtotime('+1 day', $i)) {
	  if (date('N', $i) == $weekStartOn){ //Default is Saturday == 6
		$arrayWeekStart[] = date('Y-m-d', $i); // if it's a Saturday
	  }
	}
	foreach($arrayWeekStart as $valweekStartOn){
		$valWeekEnd  = strtotime("+6 day".$valweekStartOn);
		if($valWeekEnd <= strtotime($dateEnd)){
			$arrayWeekEnd[] = date('Y-m-d', strtotime("+6 day".$valweekStartOn));
		}
	}
	$foundWeeksRough = array_map(function ($arrayWeekStart, $arrayWeekEnd) {
					return ['Start' => $arrayWeekStart, 'End' => $arrayWeekEnd];
					}, $arrayWeekStart, $arrayWeekEnd);	
	
	foreach($foundWeeksRough as $foundWeekRough){	
		if(empty($foundWeekRough['End']))continue;
		$foundWeeks[] = $foundWeekRough['Start'].",".$foundWeekRough['End'];
	}
	
// Array of WeekStartDate and WeekEndDate
return $foundWeeks;
}

function findThuAndSunFromDateRange($dateStart,$dateEnd) {
$allThu = array();
$allSun = array();
$foundExtndWeekend = array();
	for ($i = strtotime($dateStart); $i <= strtotime($dateEnd); $i = strtotime('+1 day', $i)) {
		if (date('N', $i) == 4){ //Thursday == 4
			if($i<=$dateStart)continue;
			$allThu[] = date('Y-m-d', $i); // if it's a Saturday
		}
	}
	
	foreach($allThu as $thu){
		$valSun  = strtotime("+3 day".$thu);
		if($valSun <= strtotime($dateEnd)){
			$foundExtndWeekend[] = $thu.",".date('Y-m-d', $valSun);
		}
	}
return $foundExtndWeekend;
}

function findDatesFromDateRange($dateStart, $dateEnd){
    $foundDates = array($dateStart);
    while(end($foundDates) < $dateEnd){
        $foundDates[] = date('Y-m-d', strtotime(end($foundDates).' +1 day'));
    }
// Array of foundDates
return $foundDates;
}