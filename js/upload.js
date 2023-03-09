$(document).ready( function(){
  new Ajax_upload('#up', {
		action: 'upload.php',
		onSubmit : function(file , ext){
			if (ext && /^(jpg|png|jpeg|gif|tiff|bmp|zip|rar|txt|swf|fla|7z|tar|gz|iso|dmg|mp3|doc|xls|rtf|ppt|exe|psd|c4d|pdf|dwg|max|ipa|vtf|iam|ipt)$/.test(ext)){
				$('#content #up').css("color","#EEB631"); 
				$('#content #up').text('Uploading');
				document.title = 'Uploading...';
			interval = window.setInterval(function(){
					$('#content #loadingImg').html('<img src="http://up2share.com/images/Loading.gif" />');
			}, 400);
			
			this.disable();
			$('#content #uploadform').bind('click', function() {
 				return false;
			});
				$('#content .text').text('Uploading ' + file);	
			} else {
				$('#content #up').css("color","#E05418"); 
				$('#content .error').html('File type <strong id="blink">.' + ext + '</strong> is disallowed!');
				document.title = 'Upload - Error';
				return false;				
			}

	
		},
		onComplete : function(file , data){
			window.clearInterval(interval);
			$('#content #up').css("color","#91E221"); 
			$('#content #up').text('Uploaded!');
			$('#content #loadingImg').html('');
			document.title = 'Uploaded!';
			this.disable();
			$('#content .text').html(data);				
		}		
	});

});
function beginUpload() {
	$("#uploadprogressbar").fadeIn();
	var i = setInterval(function() { 
		 $.getJSON("demo.php?id=" + progress_key, function(data) {
			if (data == null) {
				clearInterval(i);
				location.reload(true);
				return;
				}
			var percentage = Math.floor(100 * parseInt(data.bytes_uploaded) / parseInt(data.bytes_total));
			$("#uploadprogressbar").progressBar(percentage);
			});
		 }, 1500);
	return true;
}