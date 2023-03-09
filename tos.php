<?php
require_once("global.php");

$template->Header();
$core->Output("<div id=\"box\" class=\"box\">", 3);

$template->Menu();
$template->Tos();

$core->Output("</div>", 3);
$template->Footer();
?>