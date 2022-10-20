<?php 

if (isset($_GET['ctrl']) && $_GET['ctrl']) {
	$ctrl = $_GET['ctrl'];
	$_MAIN_CONTROLLER = 'controllers/mainController.php';
	if (!file_exists($_MAIN_CONTROLLER)) {
		require 'controllers/homeController.php';
	}else{
		require $_MAIN_CONTROLLER;
	}
}else{

	if (isset($_COOKIE['id'])){
			// code...
		require 'controllers/homeController.php';
	}else{
		require 'controllers/loginMember.php';
	}

}

?>