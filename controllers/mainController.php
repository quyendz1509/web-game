<?php 

// kiem tra nguoi dung
if(!isset($infoUser)){

	if (isset($ctrl)) {
	// code...
		switch ($ctrl) {
			case 'forget':
			require 'forgetMember.php';
			break;
			case 'register':
			require 'registerMember.php';
			break;
			default:
			require 'loginMember.php';
			break;
		}
	}else{
		require 'loginMember.php';
	}

}else{
	if (isset($ctrl)) {
	// code...

// Kiểm tra người dùng có tồn tại không
		switch ($ctrl) {

			// Đăng xuất
			case 'logout':
			setcookie('id', '', time() - 999999); 
			header('location: /');
			break;

			case 'pwdchange':
			require 'passwordChanges.php';
			break;
			case 'ls-doixu':
			require 'historyXu.php';
			break;
			case 'ls-napxu':
			require 'historyNapXu.php';
			break;
			case 'ls-chuyenxu':
			require 'historyChuyenXu.php';
			break;
				case 'giftcode':
			require 'giftCode.php';
			break;
			default:
			require 'homeController.php';
			break;
		}

	}else{
		require 'homeController.php';
	}
}

?>