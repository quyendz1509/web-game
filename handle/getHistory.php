<?php 
header('Content-Type: application/json; charset=utf-8');
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
require '../modules/config.php';

require '../modules/database.php';

require '../modules/auth.php';

$func = new authClass();


if (isset($_POST['web_token']) && $_POST['web_token']) {
	
// Kiểm tra token có trùng không
	$check_token_COOKIE = (isset($_SESSION['web_token'])) ? $_SESSION['web_token'] : ''; // lấy thông tin web_token
	// kiểm tra web_token có bằng với token đã được set trước ở hệ thống hay không
	if ($_POST['web_token'] == $check_token_COOKIE ) {
		if (password_verify($_WEB_TOKEN,$_POST['web_token'])) {
			// xử lý sau khi xác thực người dùng thành công

			$key = (int) htmlspecialchars(trim($_POST['key']));


			else{
				$json  = array('status' => -99, 'sms' => 'Access Denied' );
			}

			// end check

		}else{
			$json  = array('status' => -99, 'sms' => 'Xác thực hệ thống không thành công.' );
		}
	}else{
		$json  = array('status' => -99, 'sms' => 'Token xác thực đã quá hạn. Vui lòng tải lại trang.' );
	}

}else{
	$json  = array('status' => -99, 'sms' => '...' );
}

// Return $json
if (isset($json)) {
	echo json_encode($json);
}else{
	echo json_encode( array('status' => -99, 'sms' => 'Not Have Access'));
}
?>