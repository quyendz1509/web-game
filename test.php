<?php 
$login = 'vanquy';

$password = 'thientu';

$Salt = $login.$password;

$Salt = md5($Salt);

$Salt = "0x".$Salt;

echo $Salt;
?>