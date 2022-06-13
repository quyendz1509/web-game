<?php 
header('Content-Type: application/json; charset=utf-8');
session_start();
// date default
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Config trang web
require '../modules/config.php';
// Kết nối database
require '../modules/database.php';
// Function Main (USER FOR ALL)
require '../modules/main.php';
$_main = new mainClass();
if (isset($_COOKIE['id'])) {
	$newId = $_COOKIE['id'];
	$idmember = $_main->checkCookieId($newId,$_ID_USER_NUMBER);
	if ($idmember == false) {
		$json = array('status' => 0, 'data' => 'UNKNOWN MEMBERS');
	}else{
		$info = $_main->userNameInfomationId($idmember);
	}
	if (!$info) {
		$json = array('status' => 0, 'data' => 'UNKNOWN MEMBERS');

	}else{
		if (isset($_GET['id'])) {
			// code...
			$_id = htmlspecialchars(trim( (is_numeric($_GET['id'])) ? $_GET['id'] : 0 ));
			$_real_id = $_id - $_ID_USER_NUMBER;
			$pay = $_main->getHistoryByUserIdOne(0,$info['name'],$_real_id);
			// code..
			if (!$pay) {
			// code...
				$json = array('status' => -99999, 'data' => 'NOT FOUND TRANSACTION');
			// 
			}else{

				$json = array(
					'status' => 9,
					'data' => array(
						'type' => $pay['loaithe'],
						'trans_id' => $pay['id'] + $_ID_USER_NUMBER,
						'username' => $pay['user'],
						'serial' => $pay['seri'],
						'code' => $pay['mathe'],
						'menhgia' => number_format($pay['menhgia']),
						'thucnhanh' => number_format($pay['soluong']),
						'time' => $pay['pay_time'],
						'stt' => (int)$pay['trangthai'],
						'promote' => $pay['khuyenmai'],

					)
				);
			// 
			}
		}else{
			$json = array('status' => -99, 'data' => 'NOT FOUND TRANSACTION');

		}

	}
}else{
	$json  = array('status' => -99, 'data' => '' );
}
// 
// // Return $json
if (isset($json)) {
	echo json_encode($json);
}else{
	echo json_encode(array('status' => -99, 'sms' => 'Not Have Access'));
}
?>