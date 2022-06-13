<?php
$title = 'Lịch sử nạp xu';
// Thêm header
require 'views/header.php';
// Navbar 
require 'views/nav-bar.php';
// 
if (isset($infoUser)) {
	// code...
	$his_nap = $_main->getHistoryByUserId(0,$infoUser['name']);
	require 'views/historyNapXu.php';
}else{
	setcookie('id', '', time() - 999999);

}

// Thêm footer
require 'views/footer.php';

?>