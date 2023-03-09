<?php
require_once("global.php");

$template->Header();
$core->Output("<div id=\"box\" class=\"box\">", 3);

$template->Menu();

if(true) {
	if(!$core->Processing("processContact")) $template->Contact();
	else {
		$Name = $_POST['Name'];
		$Email = $_POST['Email'];
		$Message = $_POST['Message'];
		$errors = array();
		
		if(strlen($Name) < 1) {
			$errors[] = "Please type your real name.";
		}
		
		if(!$core->validEmail($Email)) {
			$errors[] = "Please use a valid email.";
		}
		
		if(strlen($Message) < 5) {
			$errors[] = "Message too short.";
		}
		
		if($_SESSION['last_message'] == $Message) {
			die("Please do not use the Contact Page for spam.");
		}
		
		if(count($errors) > 0) {
			foreach($errors as $error) {
				$core->Output("<div class=\"error\">{$error}</div>");
			}
			
			$template->Login();
		} else {
			$_SESSION['last_message'] = $Message;
			$core->sendAdminMail($Message, $Name, $Email);
			$core->Output("<div id=\"box_content\"><div id=\"small_box\">Message sent! Click <a href=\"contact.php\">here</a> to continue.</div></div>");
		}
	}
} else {
	Header("Location: " . HOST . CORE_ROOT . "index.php");
}

$core->Output("</div>", 3);
$template->Footer();
?>