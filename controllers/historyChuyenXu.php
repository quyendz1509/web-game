<?php
$title = 'Lịch sử chuyển xu';
// Thêm header
require 'views/header.php';
// Navbar 
require 'views/nav-bar.php';
// 
if (isset($infoUser)) {
	// code...
	$his_chuyen = $_main->getHistoryByUserId(2,$infoUser['ID']);
	require 'views/historyChuyenXu.php';
}else{
	setcookie('id', '', time() - 999999);

}

// Thêm footer
require 'views/footer.php';

?>