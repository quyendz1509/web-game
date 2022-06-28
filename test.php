<?php 
// require 'modules/database.php';
// require 'modules/main.php';
// $main = new mainClass();

// $rand  = $main->vongquay();
//  // 20/10/100/50/80/0
// // thuật toán viper của quyền
// $mangmoi = [];

// foreach ($rand as $key => $value) {
// 	if ( 100 - $value['percent'] <= 50 ) {
// 		$mangmoi[] = $value['name'];
// 	}
// }

// //  // mảng sẽ ra giá trị là : 2/3/4/5 tức là 0/50/20/10
// $last = [];
// for ($i=0; $i < count($mangmoi); $i++) { 
// 	$last[] = $mangmoi[$i];
// }
// $rand_number = mt_rand(0, count($last) - 1);
// echo $last[$rand_number];
// // 2 giá trị cuối sẽ là : 0 và 20 


$a = array(
	'Giải đặc biệt' => 1,
	'Giải nhì' => 10,
	'Giải ba' => 20,
	'Giải bét' => 200 
);
$vongquay = [];
foreach ($a as $key => $value) {
	// code...
for ($i=0; $i < $value; $i++) { 
	$vongquay[] = $key;
}
}

for ($i=0; $i < 500; $i++) { 
	$quayso = rand(0, count($vongquay) - 1);
	echo 'Bạn đã trúng giải: <strong>['.$vongquay[$quayso].']</strong><br>';
}
?>
