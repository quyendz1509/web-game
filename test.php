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
<section class="third-about-area third-about-bg pb-90">
    <div class="container custom-container">
        <!--  -->
        <div class="see-my-info-wrap pt-50">
            <div class="row">
                <div class="col-12 ">
                    <div class="third-section-title text-center mb-50">
                        <h2>nạp tiền ví điện tử <span>Momo</span></h2>
                    </div>
                </div>
            <div class='col-sm-12 mb-5'>
                <div class='card'>
                    <div class='card-header'>
                        <h6 class='m-0 text-dark text-uppercase'>Nạp tiền qua ví momo</h6>
                    </div>
                    <div class='card-body text-dark'>
                      <div id='noi-dung-nap'>
                          
                      </div> 
                      <button class='w-100 btn btn-sm btn-custom-chuyentien' ><i class="fas fa-plus-circle"></i> Tạo mã chuyển tiền</button>
                    </div>
                </div>
            </div>
            <!-- History -->
               <div class='col-sm-12'>
                <div class='card'>
                    <div class='card-header'>
                        <h6 class='m-0 text-dark text-uppercase'>Lịch sử giao dịch</h6>
                    </div>
                    <div class='card-body text-dark'>
                        <div class='table-responsive' >
                              <table id="table-nap" class="table table-striped table-bordered">
                         <thead>
                             <tr>
                                 <th>STT</th>
                                 <th>User</th>
                                 <th>TransId</th>
                                 <th>Coin</th>
                                 <th>STATUS</th>
                                 <th>Thời gian</th>
                             </tr>
                         </thead>
                         <tbody>
                             <tr>
                                 <td>1</td>
                                   <td>quyendz</td>
                                   <td>3ghr234</td>
                                   <td>10.000 đ</td>
                                   <td><span class='badge bg-danger'>Đang chờ</span></td>
                                   <td>2020-20-12 19:20:00</td>
                                 
                             </tr>
                         </tbody>
                     </table>
                        </div>
                   
                    </div>
                </div>
            </div>
    </div>

</div>
<!--  -->
</div>
</section>
<script>
    $(document).ready(function() {
    	$('#table-nap').dataTable();
    });
</script>
