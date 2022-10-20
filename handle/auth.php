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

			// Register $key = 1
			if ($key == 1) {

				$username = htmlspecialchars(trim($_POST['taikhoan']));

				$password = htmlspecialchars(trim($_POST['matkhau']));

				$email = htmlspecialchars(trim($_POST['email']));

				$phone = htmlspecialchars(trim($_POST['phone']));

				$gender = htmlspecialchars(trim($_POST['gender']));

				$_gender = ($gender == 1) ? $gender : 0;

				$regx = preg_match('/^(0|84|03|08|09|07|05)([0-9]{9,12})/i', $phone);

				$captcha = $_POST['g-recaptcha-response'];

				// Kiểm tra dữ liệu nhập vào
				if(isset($_COOKIE['id'])){
					$erro = array( 'status' => -99, 'sms' => 'Bạn đã đăng nhập. Vui lòng thử lại sau');
					die();
				}else if(!$captcha){

					$erro = array( 'status' => -99, 'sms' => 'Vui lòng xác nhận captcha');

				}
				else if ($username == '' || $password == '' || $email == '' || $phone == '' || $gender == '') {

					$json  = array('status' => -99, 'sms' => 'Không được bỏ trống thông tin' );

				}else if(strlen($username) < 5 || strlen($username) > 16){
					$json  = array('status' => -99, 'sms' => 'Tài khoản từ 5 - 16 ký tự' );

				}else if(strlen($password) < 6 || strlen($password) > 36){
					$json  = array('status' => -99, 'sms' => 'Mật khẩu từ 6 - 36 ký tự' );

				}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

					$json  = array('status' => -99, 'sms' => 'Địa chỉ email không đúng định dạng' );

				}else if(!$regx){

					$json  = array('status' => -99, 'sms' => 'Số điện thoại không hợp lệ' );

				}else{

					$_userInfo = $func->getInfoByUserName($username);
					
					if ($_userInfo) {
						$json  = array('status' => -99, 'sms' => 'Đã tồn tại tài khoản trên hệ thống. Vui lòng thử lại' );
					}else if($func->checkEmail($email)){
						$json  = array('status' => -99, 'sms' => 'Địa chỉ email đã được sử dụng' );

					}else{

						
						$ip = $func->get_client_ip();

						$url = "https://www.google.com/recaptcha/api/siteverify?secret=6LcT32MdAAAAAOWAL0Y1AVp4ASrt2RKLIzUcBng0&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR'];

						$obj_res = json_decode($func->curlGet($url));

						if(!$obj_res->success){

							$erro = array( 'status' => -99, 'sms' => 'Vui lòng không spam !' );

						}else{

							$Salt = $username.$password;

							$Salt = md5($Salt);

							$Salt = "0x".$Salt;

							$cretime = date( 'Y-m-d h:i:s',time());

							$coderand = mt_rand(11111,99999);
						// Thêm người dùng vào database
							$id_nor = $func->getListUser();
							$id_general = $id_nor + $_ID_USER_NUMBER;
							$res_ = $func->makeMember($username,$Salt,$password,$email,$phone,$coderand,$gender,$ip,$cretime,$id_nor);

							if ($res_ == NULL) {
								$id_hash = md5($id_general.$password.$ip);
							// Rồi giờ mã hóa id 1 lớp nữa :3
							// setcookie người dùng
							setcookie('id', $id_hash, time() + 86400, "/");

							$json  = array('status' => 0, 'sms' => 'Đăng ký tài khoản thành công !' );
							}else{
									$json  = array('status' => -99, 'sms' => 'Lỗi hệ thống. Mã lỗi [3403] ' );
								
							}
						


						}
						

					}
				}
				// Bắt đầu hàm lấy thông tin user


			}else if($key == 2){
				$username = htmlspecialchars(trim($_POST['taikhoan']));

				$password = htmlspecialchars(trim($_POST['matkhau']));

				if ($username == '' || $password == '') {
					$json  = array('status' => -99, 'sms' => 'Không bỏ trống thông tin.' );

				}else if(isset($_COOKIE['id'])){
					$erro = array( 'status' => -99, 'sms' => 'Bạn đã đăng nhập. Vui lòng thử lại sau');
					die();
				}else{
					$_userInfo = $func->getInfoByUserName($username);
					if (!$_userInfo) {
						$json  = array('status' => -99, 'sms' => 'Tài khoản không tồi tại' );
					}else{
	// check mật khẩu
						if ($_userInfo['idnumber'] != $password) {
							$json  = array('status' => -99, 'sms' => 'Mật khẩu người dùng không chính xác.' );
						}else{
							$ip = $func->get_client_ip();

							$func->updateIp($ip,$_userInfo['ID']);

							$id_general = $_userInfo['ID'] + $_ID_USER_NUMBER;

							$id_hash = md5($id_general.$password.$ip);

							setcookie('id', $id_hash, time() + 86400, "/");

							

							$json  = array('status' => 0, 'sms' => 'Đăng nhập thành công' );
							

						}
					}
				}
			}
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