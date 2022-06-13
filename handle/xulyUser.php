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

			// Bắt đầu xử lý cookie người dùng
			
			if (!isset($_COOKIE['id'])) {
				$json  = array('status' => -99, 'sms' => 'UNKNOWN MEMBERS');
			}else{
				$newId = $_COOKIE['id'];
		// sau khi tìm được id thích hợp thì... lấy info ra :D
				$idmember = $func->checkCookieId($newId,$_ID_USER_NUMBER);
		// sau khi tìm được id thích hợp thì... lấy info ra :D
				if ($idmember == false) {
					$json  = array('status' => -99, 'sms' => 'Không tìm thấy tài khoản người dùng');
				}else{
					$info = $func->userNameInfomationId($idmember);
				}

				if (!$info) {
					$json  = array('status' => -99, 'sms' => 'Không tìm thấy tài khoản người dùng');
				}else{
					// xử lý nhận dữ liệu vào
					$password = htmlspecialchars(trim($_POST['password']));
					if ($password == '') {
						$json  = array('status' => -99, 'sms' => 'Không bỏ trống thông tin');

					}else if( strlen($password) < 6 || strlen($password) > 36 ){
						$json  = array('status' => -99, 'sms' => 'Mật khẩu chỉ được từ 6 - 36 ký tự');
					}
					else if ($info['answer'] != 0) {
						$json  = array('status' => -99, 'sms' => 'Tài khoản đã đăng ký mật khẩu cấp 2. Vui lòng lấy lại mật khẩu mới');
					}else{
						$salt = md5($password);
						$func->insertSecurityPassword($salt,$info['ID']);
						$json  = array('status' => 99, 'sms' => 'Đăng ký mật khẩu cấp 2 thành công.');

					}
				}
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