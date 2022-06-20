
<?php
$title = 'Nhận quà Giftcode';
// Thêm header
require 'views/header.php';
// Navbar 
require 'views/nav-bar.php';
// 
if (isset($infoUser)) {
	// code...
	require 'views/giftcode.php';
}else{
	setcookie('id', '', time() - 999999);

}
// Thêm footer
require 'views/footer.php';

?>