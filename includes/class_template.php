<?php
class Template {
    function Header() {
    	require("templates/overall_header.php");
    }
    
    function Footer() {
    	require("templates/overall_footer.php");
    }
    
    function Menu() {
    	require("templates/main_menu.php");
    }
    
    function Upload() {
    	require("templates/upload_content.php");
    }
    
    function ToS() {
    	require("templates/tos_content.php");
    }
    
    function FAQ() {
    	require("templates/faq_content.php");
    }
    
    function Login() {
    	require("templates/login_content.php");
    }
	
	function Contact() {
		require("templates/contact_content.php");
	}
    
    function Register() {
    	require("templates/register_content.php");
    }
    
    function Ad() {
    	require("config.php");
    	
    	if($cfg['ads']['enabled']) require("templates/adbrite_banner.php");
    }
    
    function Box($data) {
    	global $core;
    	
    	$core->Output("<div id=\"box\" class=\"box\">", 3);
    	$core->Output($data, 4);
    	$core->Output("</div>", 3);
    }
}
?>