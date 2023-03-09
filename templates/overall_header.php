<?php
require("includes/core_security_check.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Easy Upload, Share, Store and Connect - BrueStorage</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
		<meta name="keywords" content="brue, storage, bruestorage, asib, tayeb, asibtayeb, file, filebox, box, upload, file uploader, uploader, flash, swf, .swf, .fla, uploading, fast, server, adobe, movie, image, jpg, jpeg, gif, rar, zip, free, quick, host, hosting, image hosting, file share, fileshare, sharing" />
		<meta name="description" content="BrueStorage is a powerful upload website to easily share images, archives, music or flash files to anyone, securely." />
		<link type="image/x-icon" href="images/favicon.png" rel="shortcut icon"/>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.ajax_upload.3.5.min.js"></script>
		<script type="text/javascript" src="js/bruestorage.js"></script>
		<script type="text/javascript" src="js/jquery.qtip-1.0.0-beta3.1.min.js"></script>
		<script type="text/javascript" src="js/chbg.js"></script>
		<script type="text/javascript" src="js/jquery.truncator.js"></script>
		<script type="text/javascript" src="js/JQueryRotate.js"></script>
		<script type="text/javascript">
		function getHTTPObject(){
			if (window.ActiveXObject) 
			return new ActiveXObject("Microsoft.XMLHTTP");
			else if (window.XMLHttpRequest) 
			return new XMLHttpRequest();
			else {
				alert("Your browser does not support AJAX.");
				return null;
			}
		}
		function doWork(){
			httpObject = getHTTPObject();
			if (httpObject != null) {
				httpObject.open("GET", "uploadProgress.php?id="
								+document.getElementById('progress_key').value, true);
				httpObject.send(null);
				httpObject.onreadystatechange = setOutput;
			}
		}
		function setOutput(){
			if(httpObject.readyState == 4){
				document.getElementById('progress_key').value = httpObject.responseText;
			}
		}
		</script>
	</head>

	<body>
    	<div id="header">
        	<table>
            	<tr>
        			<td align="left"><img src="images/logo.png" /></td>
                    <td align="right" valign="top">
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="7NMXJVHCBG7VY">
						<input type="image" src="images/donate.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
						</form>
                    </td>
                </tr>
            </table>
        </div>
        <div id="container">