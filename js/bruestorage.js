$(document).ready( function(){
  new Ajax_upload('#btn_upload', {
		action: 'upload.php',
		data: {
    		password : 'll',
			username : $('#user'),
			hide : $('#hide'),
			thumb : $('#thumb'),
			swfcontrol : $('#swfcontrol')
  		},
		onSubmit : function(file , ext){
			if (ext && /^(jpg|png|jpeg|gif|tiff|bmp|zip|rar|txt|swf|fla|7z|tar|gz|mp3|wav|m4a|aac|doc|docx|xls|rtf|ppt|bsd|exe|psd|c4d|pdf|dwg|max|ipa|vtf|iam|ipt)$/.test(ext)){

				$('#btn_upload').css("color","#eee0b2"); 
				$('#btn_upload').css("background","#594e3a");
				$('#btn_upload').css("border","#FFFFFF");
				$('#btn_upload').css("font-size","40px");
				$('#btn_upload').css("height","50px");
				$('#btn_upload').text('Uploading');
				document.title = 'Uploading...';
				$('#loading_image').html('<img src="images/loader.gif" />');
				interval = window.setInterval(function(){
			}, 400);
			
			this.disable();
			$('#formUpload').bind('click', function() {
 				return false;
			});
				$('.file').text('Uploading ' + file);	
				$('.error').hide();
				$('.upInfo').hide();
			} else {
				$('.error').show();
				$('.error').html('File type <strong id="blink">.' + ext + '</strong> is disallowed!');
				document.title = 'Upload - Error';
				
				return false;				
			}

	
		},
		onComplete : function(file , data){
			window.clearInterval(interval);
			$('#btn_upload').css("color","#91E221"); 
			$('#btn_upload').css("background","#594e3a");
			$('#btn_upload').text('Uploaded!');
			$('#loading_image').html('');
			document.title = 'Uploaded!';
			$('.file').hide();
			$('.data').html(data);	
			this.disable();		
		}		
	});

});
function beginUpload() {
	$("#uploadprogressbar").fadeIn();
	var i = setInterval(function() { 
		 $.getJSON("uploadProgress.php?id=" + progress_key, function(data) {
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
};