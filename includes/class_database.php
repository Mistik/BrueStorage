<?php

class Database {
    var $Connection = null;
    
    function Connect($host, $user, $pass, $name) {
        $error = false;
        
        $this->Connection = mysql_connect($host, $user, $pass) or $error = true;
        mysql_select_db($name, $this->Connection) or $error = true;
        
        return !$error;
    }
    
    function executeQuery($query) {
        return mysql_query($query);
    }
    
    function executeFetch($result) {
        return mysql_fetch_assoc($result);
    }
    
    function executeFetchQuery($query) {
        $result = mysql_query($query);
        return mysql_fetch_assoc($result);
    }
    
    function numRows($result) {
        return mysql_num_rows($result);
    }
    
    function Escape($string) { 
    	if(get_magic_quotes_runtime()) $string = stripslashes($string); 
    	return @mysql_real_escape_string($string, $this->Connection); 
	}
    
    function Insert($table, $data) {
    	$query = "INSERT INTO " . $table . " ";
    	$v = ""; $n = ""; 
    	
    	foreach($data as $key=>$val) {
    		$n .=  $key . ", ";
    		
    		if(strtolower($val) == "null") {
    			$v .= "NULL, ";
    		} elseif(strtolower($val) == "now()") {
    			$v .= "NOW(), ";
    		} else {
    			$v .= "'" . $this->Escape($val) . "', ";
    		}
    	}
    	
    	$query .= "(" . rtrim($n, ', ') . ") VALUES (" . rtrim($v, ', ') . ");"; 
	    $this->executeQuery($query);
    }
    
    function Close() {
        if($this->Connected()) {
            mysql_close($this->Connection);
        }
    }
    
    function Connected() {
        if($this->Connection != null) {
            return true;
        } else {
            return false;
        }
    }
}
?>