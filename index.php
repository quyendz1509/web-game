<?php 
session_start();
// date default
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Config trang web
require 'modules/config.php';
// Kết nối database
require 'modules/database.php';
// Function Main (USER FOR ALL)
require 'modules/main.php';
$_main = new mainClass();

// Kiểm tra status Game

if ($_WEB_STATUS == 0) {

	if (isset($_COOKIE['id'])) {
		// check hết tất cả người dùng
		
		$newId = $_COOKIE['id'];
		$idmember = $_main->checkCookieId($newId,$_ID_USER_NUMBER);
		// sau khi tìm được id thích hợp thì... lấy info ra :D
		if ($idmember == false) {
			setcookie('id', '', time() - 999999);
		}else{
			$infoUser = $_main->userNameInfomationId($idmember);
		}
		// nếu không tìm thấy thì cho logout :D
		if (!$infoUser) {
			setcookie('id', '', time() - 999999);
			header('location: /');
		}else{
			$id_user_hash = $infoUser['ID'] + $_ID_USER_NUMBER;
		}
	}
	// Tạo sesion web token
	$cost = ["cost" => 12 ];
	$_AUTH_TOKEN = password_hash($_WEB_TOKEN, PASSWORD_DEFAULT, $cost);
	$_SESSION['web_token'] = $_AUTH_TOKEN;
	// Dẫn tới route
	require 'route.php';


}else{
	// Bảo trì Trang web
	require 'views/404.php';
}

?>