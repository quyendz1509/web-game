<?php 
if (!isset($_COOKIE['id'])) {
	require 'controllers/loginMember.php';
}else{
	if (isset($_GET['ctrl']) && $_GET['ctrl']) {
		$ctrl = $_GET['ctrl'];
		$_MAIN_CONTROLLER = 'controllers/mainController.php';
		if (!file_exists($_MAIN_CONTROLLER)) {
			require 'controllers/homeController.php';
		}else{
			require $_MAIN_CONTROLLER;
		}
	}else{
		require 'controllers/homeController.php';

	}
}
?>