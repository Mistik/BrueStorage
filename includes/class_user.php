<?php
class User {
	function LoggedOn() {
		if(isset($_SESSION['hash_id']) || isset($_COOKIE['hash_id'])) {
			return true;
		} else {
			return false;
		}
	}
	
	function Login($user_id, $hash_id, $remember = "on") {
		$_SESSION['hash_id'] = $hash_id;
		
		if($remember == "on") {
			setcookie("hash_id", $hash_id, time()+100*365*24*60*60);
		}
	}
	
	function Logout() {
		unset($_SESSION['hash_id']);
		setcookie("hash_id", "", time()-3600);
	}
	
	function HashID() {
		if(isset($_SESSION['hash_id'])) {
			return $_SESSION['hash_id'];
		} elseif(isset($_COOKIE['hash_id'])) {
			return $_COOKIE['hash_id'];
		} else {
			return "";
		}
	}
	
	function Data($key) {
		global $db;
		
		$udata = $db->executeFetchQuery("SELECT * FROM users WHERE hash_id = '" . $this->HashID() . "'");
		return $udata[$key];
	}
    
    function AccessLevel($level, $more = false) {
        if(!$more) {
            if($this->Data("access") == $level) {
                return true;
            }
        } else {
            if($this->Data("access") >= $level) {
                return true;
            }
        }
        
        return false;
    }
}
?>