<?php
require("includes/core_security_check.php");
?>

				<div id="box_content">
                	<form name="formUpload" action="upload.php" method="POST">
                	
                	<style type="text/css">
						#btn_upload:hover {
							background-image: url('images/btn_upload_hover.png');
						}
					</style>
                    <center><div id="btn_upload"></div></center>
                    
                    <div id="loading_image"></div>
                    <div class="file" style="text-align: center; font-size: 11px;"></div>
					<div class="data" style="text-align: center;"></div>
					<div style="font-size: 10px; margin: 0 auto; text-align: left;"></div>
					<div class="error" style="display:none"></div>
					</form>
					
					<div class="upInfo">
	                    <div id="small_box">
	                    	<p><b>File Types</b>:  jpg, png, gif, zip, rar, swf, tiff, bmp, txt, fla, 7z, tar, gz, iso, dmg, mp3, wav, m4a, aac, doc, docx, xls, rtf, ppt, bsd, exe, psd, c4d, pdf, dwg, max, ipa, vtf, iam, ipt<br />
							<b>File Size</b>: 500mb</p>
	                    </div>
                    </div>
                </div>