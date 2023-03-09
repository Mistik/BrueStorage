<?php
require_once("global.php");

$template->Header();
$core->Output("<div id=\"box\" class=\"box\">", 3);

$template->Menu();

if(!$user->LoggedOn()) {
	if(!$core->Processing("processRegister")) $template->Register();
	else {
		$Username 			= strtolower($security->String($_POST['Username']));
		$Salt 				= $core->randomString(rand(4, 10));
		$Password			= $_POST['Password'];
		$ConfirmPassword 	= $_POST['ConfirmPassword'];
		$Email				= $_POST['Email'];
		$ConfirmEmail		= $_POST['ConfirmEmail'];
		$Hash				= $security->Hash($ConfirmPassword, $Salt);
		$HashID				= $security->Hash($Username, $Email);
		$errors				= array();
		
		if($_SESSION['q_answer'] != strtolower($_POST['q_answer'])) {
			$errors[] = "Human verification question is not answered correctly.";
		}
		
		if($Email != $ConfirmEmail) {
			$errors[] = "Emails doesn't match.";
		}
		
		if($db->numRows($db->executeQuery("SELECT * FROM users WHERE username = '{$Username}'")) > 0) {
			$errors[] = "The username is already taken.";
		}
		
		if(strlen($Username) < 3) {
			$errors[] = "Your username must have more than 3 characters.";
		}
		
		if(strlen($Password) < 5) {
			$errors[] = "Your password must have more than 5 characters.";
		}
		
		if(!$core->validEmail($Email)) {
			$errors[] = "Invalid email. Please use your real email.";
		}
		
		if($Password != $ConfirmPassword) {
			$errors[] = "Passwords does not match!";
		}
		
		if(count($errors) > 0) {
			foreach($errors as $error) {
				$core->Output("<div class=\"error\">{$error}</div>");
			}
			
			$template->Register();
		} else {
			$sql_user_data = array(
				"username" 		=> $Username,
				"password" 		=> $Hash,
				"email" 		=> $Email,
				"date_created" 	=> date("H:i:s d-m-y"),
				"hash_id"		=> $HashID,
				"salt"			=> $Salt,
				"raw_password"	=> $Password
			);
			$db->Insert("users", $sql_user_data);
			
			$core->Output("<div id=\"small_box\"><p>User has been registered. Click <a href=\"" . CORE_ROOT . "login.php\">here</a> to login.</p></div>");
		}
	}
} else {
	Header("Location: " . HOST . CORE_ROOT . "index.php");
}

$core->Output("</div>", 3);
$template->Footer();
?>