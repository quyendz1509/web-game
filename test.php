<?php 
date_default_timezone_set('Asia/Ho_Chi_Minh');
// setcookie("id", "", time() - 86400);
// json_encode(value)
$time = time() + 300;
echo date('d-m-Y H:i:s', $time);
?>