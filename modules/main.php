<?php 

/**
 * 
 */
class mainClass extends DATABASE
{
	// 
	// check cookie
	function checkCookieId($id_hash,$_ID_USER_NUMBER){
		// Lấy thông tin tất cả member (Củ chuối thế nhờ :( )
		$sql='SELECT * FROM `users`';
		// kết quả là gì ? 
		$kq = $this->pdo_query($sql);
		// Bắt đầu
		$test = '';
		foreach ($kq as $key => $value) {
			if (md5( $value['ID'] + $_ID_USER_NUMBER.$value['idnumber'].$value['passwd2']  ) == $id_hash) {
				$test = $value['ID'];
				break;
			}else{
				$test = false;

			}
		}
		return $test;
	}
// tính tổng số xu + số knb đã chuyển dựa vào exchange
	function sumKnbAndXu($key,$user){
		if ($key == 0) {
			// code...
			$sql='SELECT SUM(`amount`) FROM `exchange` WHERE `user` = ?';
			return $this->pdo_query_values($sql,$user);
		}else{
			$sql='SELECT SUM(`soknb`) FROM `exchange` WHERE `user` = ?';
			return $this->pdo_query_values($sql,$user);
		}
	}
	function getHistoryByUserId($key,$user){
		// Dựa theo key để lấy nhé
		//////////////
		// Key = 0 Là lấy lịch sử giao dịch của nạp thẻ //
		//////////////
		if ($key == 0) {
			$sql='SELECT * FROM `pay` WHERE `user` = ? ORDER BY `id` DESC';	
			return $this->pdo_query($sql,$user);
		}else if($key == 1){
			$sql='SELECT * FROM `exchange` WHERE `user` = ? ORDER BY `id` DESC';
			return $this->pdo_query($sql,$user);
		}else if($key == 2){
			$sql='SELECT * FROM `transfersxu` WHERE `id_user_send` = ? OR `id_user_Get` = ? ORDER BY `id` DESC';
			return $this->pdo_query($sql,$user,$user);
		}
	}
	function getHistoryByUserIdOne($key,$user,$id){
		// Dựa theo key để lấy nhé
		//////////////
		// Key = 0 Là lấy lịch sử giao dịch của nạp thẻ //
		//////////////
		if ($key == 0) {
			$sql='SELECT * FROM `pay` WHERE `user` = ? AND `id` = ?';	
			return $this->pdo_query_one($sql,$user,$id);
		}
	}
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