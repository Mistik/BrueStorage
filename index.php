<?php
require_once("global.php");

$core->handleIndexActions();

$template->Header();
$core->Output("<div id=\"box\" class=\"box\">", 3);

$template->Menu();
$template->Upload();

$core->Output("</div>", 3);
$template->Footer();
?>