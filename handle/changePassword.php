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
					// xử lý nhận dữ liệu vào
					// xử lý nhận dữ liệu vào
					// xử lý nhận dữ liệu vào
						$pass_old = htmlspecialchars(trim($_POST['oldpass']));
						$pass_new = htmlspecialchars(trim($_POST['newpass']));
						$otp = htmlspecialchars(trim($_POST['otp']));
						if ($pass_old == '' || $pass_new == '' || $otp == '') {
							$json  = array('status' => -99, 'sms' => 'Không được bỏ trống thông tin');
						}else if($info['idnumber'] != $pass_old){
							$json  = array('status' => -99, 'sms' => 'Mật khẩu cũ không chính xác');

						}else{
							// check otp nào :D
							$time_check = $func-> checkTokenByIdUser($otp,$info['ID']);
							if ($time_check == 'unknown') {
								$json  = array('status' => -99, 'sms' => 'Mã xác thực không hợp lệ vui lòng lấy <strong class="text-danger">mã xác thực</strong> trước.');
							}else if($time_check == 'timeout'){
								$json  = array('status' => -99, 'sms' => 'Mã xác thực của bạn đã hết hạn sử dụng vui lòng lấy <strong class="text-danger">mã xác thực</strong> mới.');
							}else{
								$Salt = $info['name'].$pass_new;

								$Salt = md5($Salt);

								$Salt = "0x".$Salt;

						// Thêm người dùng vào database
								$ip = $func->get_client_ip();
								$id_general = $info['ID'] + $_ID_USER_NUMBER;
								$res_ = $func->updateUser($info['ID'],$pass_new,$Salt,$ip);
								if ($res_ == NULL) {
									$id_hash = md5($id_general.$pass_new.$ip);
							// Rồi giờ mã hóa id 1 lớp nữa :3
							// setcookie người dùng
									setcookie('id', $id_hash, time() + 86400, "/");

									$json  = array('status' => 0, 'sms' => 'Đổi mật khẩu thành công !' );
								}else{
									$json  = array('status' => -99, 'sms' => 'Lỗi hệ thống. Mã lỗi [3403] ' );

								}

							}
						}

						

					// kết thúc xử lý dữ liệu đầu vào
					// kết thúc xử lý dữ liệu đầu vào
					// kết thúc xử lý dữ liệu đầu vào
					// kết thúc xử lý dữ liệu đầu vào


						
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