<?php
require_once("global.php");

$template->Header();
$core->Output("<div id=\"box\" class=\"box\">", 3);

$template->Menu();

if($user->LoggedOn()) {
	$core->Output("<div id=\"box_content\"><h1>User Control Panel</h1>");
	
	$file_result = $db->executeQuery("SELECT * FROM files WHERE user_id = " . $user->Data("id") . " ORDER BY id DESC LIMIT 10");
	if($db->numRows($file_result) > 0) {
		$core->Output("<div id=\"small_box\"><p><b>Latest 10 uploads</b><br /><br />");
		
		while($file = $db->executeFetch($file_result)) {
			$core->Output("<a href=\"" . HOST . CORE_ROOT . $file['location'] . "\">{$file['original_name']}</a><br />");
		}
		
		$core->Output("</p></div>");
	} else {
		$core->Output("<div id=\"small_box\">");
		$core->Output("<p><b>You haven't uploaded any files yet!</b></p>");
		$core->Output("</div>");
	}
	
	$core->Output("</div>");
} else {
	Header("Location: " . HOST . CORE_ROOT . "index.php");
}

$core->Output("</div>", 3);
$template->Footer();
?>