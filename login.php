<?php
require_once("global.php");

$template->Header();
$core->Output("<div id=\"box\" class=\"box\">", 3);

$template->Menu();

if(!$user->LoggedOn()) {
	if(!$core->Processing("processLogin")) $template->Login();
	else {
		$Username = strtolower($security->String($_POST['Username']));
		$UDATA = $db->executeFetchQuery("SELECT * FROM users WHERE username = '{$Username}'");
		$Password = $security->Hash($_POST['Password'], $UDATA['salt']);
		$Remember = $_POST['Remember'];
		$errors = array();
		
		if($db->numRows($db->executeQuery("SELECT * FROM users WHERE username = '{$Username}'")) < 1) {
			$errors[] = "Username doesn't exist.";
		}
		
		if($Password != $UDATA['password']) {
			$errors[] = "Username and password doesn't match.";
		}
		
		if(count($errors) > 0) {
			foreach($errors as $error) {
				$core->Output("<div class=\"error\">{$error}</div>");
			}
			
			$template->Login();
		} else {
			$user->Login($UDATA['id'], $UDATA['hash_id'], $Remember);
			$core->Output("<div id=\"box_content\"><div id=\"small_box\">User successfully logged on. Click <a href=\"usercp.php\">here</a> to continue.</div></div>");
		}
	}
} else {
	Header("Location: " . HOST . CORE_ROOT . "index.php");
}

$core->Output("</div>", 3);
$template->Footer();
?>