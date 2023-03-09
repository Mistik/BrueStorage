<?php
class Security {
	function String($variable) {
		$variable = htmlentities($variable, ENT_QUOTES);
		
	  	if (get_magic_quotes_gpc()) { 
		   $variable = stripslashes($variable); 
		}
		
	  	$variable = mysql_real_escape_string(trim($variable));
	 	$variable = strip_tags($variable);
		$variable = str_replace("	", "", $variable);
	 	return $variable;
	}
	
	function Hash($rawData, $salt) {
		return sha1(md5($rawData) . $salt);
	}
}
?>