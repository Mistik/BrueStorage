<?php
require_once("global.php");

(isset($_GET['pid'])) ? define("PAGE_ID", @intval($_GET['pid'])) : define("PAGE_ID", 1);

$template->Header();
$core->Output("<div id=\"box\" class=\"box\">", 3);

$template->Menu();

if($user->LoggedOn() && $user->AccessLevel(2, true)) {
    if(isset($_GET['action'])) {
        switch($_GET['action']) {
            case "delete":
                $id = @intval($_GET['action_id']);
                $file['location'] = mysql_result(mysql_query("SELECT location FROM files WHERE id = " . $id), 0);
                unlink(CWD . $file['location']);
                mysql_query("DELETE FROM files WHERE id = " . $id) or die(mysql_error());
                header("Location: staffcp.php?pid=" . PAGE_ID . "&action=fix");
                die("File " . $id . " has been deleted from database and file system.");
                break;
            case "fix":
                $files = mysql_query("SELECT * FROM files ORDER BY id ASC") or die(mysql_error());
                $count = 1;
                while($file = mysql_fetch_array($files)) {
                    mysql_query("UPDATE files SET id = " . $count . " WHERE id = " . $file['id']);
                    $count++;
                }
                header("Location: staffcp.php?pid=" . PAGE_ID);
                die("DONE");
                break;
        }
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    
	$core->Output("<div id=\"box_content\"><h1>Staff Control Panel</h1>");
	
	$file_result = $db->executeQuery("SELECT * FROM files ORDER BY id ASC LIMIT " . PAGE_ID . "0");
	if($db->numRows($file_result) > 0) {
		$core->Output("<div id=\"small_box\"><p><b>All uploads</b><br /><br />");
        $core->Output("<table cellpadding=\"2\"/>");
		
        $count = 0;
		while($file = $db->executeFetch($file_result)) {
            if(PAGE_ID == 1) {
                $startid = 1;
            } else {
                $startid = ((PAGE_ID - 1) * 10 + 1);
            }
            
            if($file['id'] >= $startid) {
                $core->Output("<tr><td>" . $file['id'] . ".</td><td><a href=\"" . HOST . CORE_ROOT . $file['location'] . "\">{$file['original_name']}</a></td><td align=\"right\"><a href=\"" . HOST . CORE_ROOT . "staffcp.php?pid=" . PAGE_ID . "&action=delete&action_id=" . $file['id'] . "\">DELETE</a></td></tr>");
                $count++;
            }
		}
		
        if(PAGE_ID != 1) {
            $core->Output("<tr><td colspan=\"3\" align=\"right\">[ <a href=\"" . HOST . CORE_ROOT . "staffcp.php?pid=1\">FIRST</a> ] [ " . PAGE_ID . " | <a href=\"" . HOST . CORE_ROOT . "staffcp.php?pid=" . (PAGE_ID + 1) . "\">" .(PAGE_ID + 1) . "</a> | <a href=\"" . HOST . CORE_ROOT . "staffcp.php?pid=" . (PAGE_ID + 2) . "\">" .(PAGE_ID + 2) . "</a> | <a href=\"" . HOST . CORE_ROOT . "staffcp.php?pid=" . (PAGE_ID + 3) . "\">" .(PAGE_ID + 3) . "</a> ] [ <a href=\"" . HOST . CORE_ROOT . "staffcp.php?pid=" . (PAGE_ID + 1) . "\">NEXT</a> ]</td></tr>");
        } else {
            $core->Output("<tr><td colspan=\"3\" align=\"right\">[ " . PAGE_ID . " | <a href=\"" . HOST . CORE_ROOT . "staffcp.php?pid=" . (PAGE_ID + 1) . "\">" .(PAGE_ID + 1) . "</a> | <a href=\"" . HOST . CORE_ROOT . "staffcp.php?pid=" . (PAGE_ID + 2) . "\">" .(PAGE_ID + 2) . "</a> | <a href=\"" . HOST . CORE_ROOT . "staffcp.php?pid=" . (PAGE_ID + 3) . "\">" .(PAGE_ID + 3) . "</a> ] [ <a href=\"" . HOST . CORE_ROOT . "staffcp.php?pid=" . (PAGE_ID + 1) . "\">NEXT</a> ]</td></tr>");
        }
        
        $core->Output("</table>");
        
        if($count == 0) {
            $core->Output("<b>Page doesn't exist!</b>");
        }
		$core->Output("</p></div>");
	} else {
		$core->Output("<div id=\"small_box\">");
		$core->Output("<p><b>No files uploaded yet.</b></p>");
		$core->Output("</div>");
	}
	
	$core->Output("</div>");
} else {
	Header("Location: " . HOST . CORE_ROOT . "index.php");
}

$core->Output("</div>", 3);
$template->Footer();
?>