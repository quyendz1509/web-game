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

// Kiểm tra status Game

if ($_WEB_STATUS == 0) {
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