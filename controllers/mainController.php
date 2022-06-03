<?php 

// kiem tra nguoi dung
if(!isset($_COOKIE['id'])){

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

	// Thông tin người dùng
			case 'info':
			require 'infoMember.php';
			break;

			case 'logout':
			setcookie('id', '', time() - 999999); 
			header('location: /');
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