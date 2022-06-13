<?php
$title = 'Lịch sử đổi xu';
// Thêm header
require 'views/header.php';
// Navbar 
require 'views/nav-bar.php';
// 
if (isset($infoUser)) {
	// code...
	$his_xu = $_main->getHistoryByUserId(1,$infoUser['name']);
	require 'views/historyXu.php';
}else{
	setcookie('id', '', time() - 999999);

}
// Thêm footer
require 'views/footer.php';

?>