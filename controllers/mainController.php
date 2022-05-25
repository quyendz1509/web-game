<?php 
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
	die();
}
?>