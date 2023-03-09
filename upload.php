<?php
set_time_limit(86400);
require_once("global.php");

$OriginalName 	= $security->String($_FILES['userfile']['name']);
$RandID 		= $core->randomString(9);
$FileName 		= $RandID . "_" . $OriginalName;
$BadFileTypes 	= array(".php", ".php3", ".php4", ".php5", ".html", ".htm", ".asp");

$FileName 		= str_replace($BadFileTypes , "", $FileName);
$OriginalName	= str_replace($BadFileTypes , "", $OriginalName);

$UploadFile		= "file/" . $FileName;
$FileSize		= $_FILES['userfile']['size'];

$Ext 			= strtolower($core->fileNameExtension(basename($_FILES['userfile']['name'])));
$LegalExt		= array("jpg", "png", "gif", "tiff", "bmp", "zip", "rar", "txt", "swf", "jpeg", "fla", "7z", "tar", "gz", "tar.gz", "iso", "dmg", "doc", "xls", "rtf", "ppt", "mp3", "docx", "wav", "bsd", "m4a", "aac","exe","psd","c4d", "pdf", "dwg", "max", "ipa", "vtf", "iam", "ipt");
$DimensionsExt	= array("swf", "gif", "jpg", "jpeg", "png", "tiff", "bmp");
$ImageExt		= array("gif", "jpg", "jpeg", "png", "tiff", "bmp");
$ThumbExt		= array("gif", "jpg", "jpeg", "png", "bmp");

if(in_array($Ext, $DimensionsExt)){ 
	list($width, $height, $attr) = getimagesize($_FILES['userfile']['tmp_name']); 
} else { 
	$width = "0"; $height = "0";
}

$Time = time();
$IP = $core->getRealIP();

if((in_array($Ext, $LegalExt)) OR ($FileSize < 52428800) OR (!empty($_FILES['userfile']['name'])) OR ($_FILES['userfile']['size'] == 0)) {
	move_uploaded_file($_FILES['userfile']['tmp_name'], $UploadFile);
	
	$sql_file_values = array(
		"user_id" 		=> $user->Data("id"),
		"name"			=> $FileName,
		"original_name" => $OriginalName,
		"location" 		=> $UploadFile,
		"extension"		=> $Ext,
		"size"			=> $FileSize,
		"file_id"		=> $RandID,
		"width"			=> $width,
		"height"		=> $height,
		"time"			=> $Time,
		"ip"			=> $IP
	);
	$db->Insert("files", $sql_file_values);
	
	if((in_array($Ext, $ThumbExt))){ 
		$core->smart_resize_image($UploadFile, 175, "file/thumbnail_" . $FileName, 0, true, false);
	}
	
	$Trans = array(" " => "%20", "\'" => "27%");
?>

	<div id="small_box"><p>
		<b>Direct Link:</b><br />
		<input type="text" value="<?php $core->Output(HOST . CORE_ROOT . strtr($UploadFile, $Trans)); ?>" size="50" />
	</p></div>
	
	<div id="small_box"><p>
		<b>Direct Link BBCode:</b><br />
		<input type="text" value="[URL]<?php $core->Output(HOST . CORE_ROOT . strtr($UploadFile, $Trans)); ?>[/URL]" size="50" />
	</p></div>
	
	<?php if(in_array($Ext, $ImageExt)) { ?>
		<div id="small_box"><p>
			<b>IMG BBCode:</b><br />
			<input type="text" value="[IMG]<?php $core->Output(HOST . CORE_ROOT . strtr($UploadFile, $Trans)); ?>[/IMG]" size="50" />
		</p></div>
	<?php } ?>

<?php } ?>