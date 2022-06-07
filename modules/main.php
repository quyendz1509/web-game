<?php 

/**
 * 
 */
class mainClass extends DATABASE
{
	// get info user by id
	function userNameInfomationId($id){
		$sql='SELECT * FROM `users` WHERE `ID` = ?';
		return $this->pdo_query_one($sql,$id);
	}
	// get list user
	function getListUser(){
		return $this->pdo_query('SELECT * FROM `users` ORDER BY `ID` DESC');
	}
	// Function to get the client IP address
	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

}

?>