<?php 

/**
 * 
 */
class authClass extends DATABASE
{
	// check email
	function checkEmail($email){
		$sql='SELECT * FROM `users` WHERE `email` = ?';
		return $this->pdo_query_one($sql,$email);
	}
	// insert new pass
	function insertSecurityPassword($password,$id){
		$sql='UPDATE `users` SET `answer` = ? WHERE `ID` =? ';
		$this->pdo_execute($sql,$password,$id);
		// get info user by id
	}
	function userNameInfomationId($id){
		$sql='SELECT * FROM `users` WHERE `ID` = ?';
		return $this->pdo_query_one($sql,$id);
	}
	function getListUserAll(){
		return $this->pdo_query('SELECT * FROM `users` ORDER BY `ID` DESC');
	}
	// function update ip 
	function updateIp($ip,$id){
		$sql='UPDATE `users` SET `passwd2` = ?, `thedangky` = ? WHERE `id` = ?';
		$this->pdo_execute($sql,$ip,$ip,$id);
	}
	// get all info user 
	function getListUser(){
		return $this->pdo_query_values('SELECT IFNULL(MAX(id), 16) + 16 FROM `users`');
	}
	// Get info user by username
	function getInfoByUserName($username){
		$sql='SELECT * FROM `users` WHERE `name` = ?';
		return $this->pdo_query_one($sql,$username);
	}
	// function curl
	function curlGet($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;

	}
	// Tạo người dùng
	function makeMember($username,$salt,$password,$email,$phone,$coderand,$gender,$ip,$cretime,$id){
		$sql='INSERT INTO `users`(`name`,`passwd`,`Prompt`,`answer`,`truename`,`idnumber`,`email`,`mobilenumber`,`province`,`city`,`phonenumber`,`address`,`postalcode`,`gender`,`qq`,`passwd2`,`chuyenkhoan`,`napthe`,`hotro1`,`hotro2`,`thedangky`,`creatime`,`id`) VALUES(?,?,0,0,0,?,?,?,0,0,0,0,?,?,0,?,0,0,0,0,?,?,?)';
		$this->pdo_execute($sql,$username,$salt,$password,$email,$phone,$coderand,$gender,$ip,$ip,$cretime,$id);
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