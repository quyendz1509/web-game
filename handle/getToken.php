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
					if (!$info) {
						$json  = array('status' => -99, 'sms' => 'Không tìm thấy tài khoản người dùng');
					}else{
					// xử lý nhận dữ liệu vào
						
						$send_mail = $func->sendMail($info['email'],$info['ID']);
						if ($send_mail == 'die') {
							$json  = array('status' => -99, 'sms' => 'Vui lòng thử lại sau 2 phút.');

						}else if ($send_mail == 'done') {
							$json  = array('status' => 99, 'sms' => 'Gửi OTP đến email <strong>'.$info['email'].'</strong> Vui lòng kiểm tra hòm thư (hoặc hòm thư spam).');

						}else{
							$json  = array('status' => -99, 'sms' => 'Gửi OTP thất bại vui lòng liên hệ admin.');

						}
						
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