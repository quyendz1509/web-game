<!-- only div right :D -->
<div class="col-md-8 col-sm-12 right-home mb-3">
	<div class="left-title-home">
		<h4><?= $title ?></h4>
	</div>
	<div class="form-right-home table-responsive">
		<table class="table table-striped dt-responsive nowrap" style="width: 100%;" id="history-chuyenxu">
			<thead>
				<tr>
					<th>STT</th>
					<th>Loại</th>
					<th>Người nhận / gửi</th>				
					<th>Số lượng</th>
					<th>Phí</th>
					<th>Thực nhận</th>
					<th>Số dư</th>
					<th>Thời gian</th>
					<th>Nội dung</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($his_chuyen as $key => $value): 
					if ($value['id_user_send'] == $infoUser['ID']) {
						$noidung = $value['id_user_get'];
						$note = 1;
						$soluong = '-'.number_format($value['soluong']);
						$thucnhan = '-'.number_format($value['thucnhan']);

						$sodu = $value['sodu_user_get'];
						$class_f = 'text-danger'; 
					}else{
						$noidung = $value['id_user_send'];;
						$note = 0;
						$soluong = '+'.number_format($value['soluong']);
						$thucnhan = '+'.number_format($value['thucnhan']);
						$sodu = $value['sodu_user_send'];
						$class_f = 'text-success'; 

					}
					?>
					<tr>
						<th><?= $key +1 ?></th>
						<td><?= ($note == 0) ? '<span class="badge bg-info text-uppercase">Nhận Xu '.$value['loai_xu'].'</span>' : '<span class="badge bg-danger text-uppercase">Gửi Xu '.$value['loai_xu'].'</span>'; ?></td>
						<td>ID: <?= $noidung + $_ID_USER_NUMBER ?></td>
						<td><?= $soluong ?> xu</td>
						<td><?= $_FEED_TRANS ?>%</td>
						<td><?= $thucnhan ?> xu</td>

						<td><span class="<?= $class_f ?>"><?= number_format($sodu) ?> xu</span></td>
						<td><?= date('Y-m-d',strtotime($value['time']) ) ?></td>
						<td>
							<textarea class="form-custom" rows="3" readonly><?= $value['noidung'] ?></textarea>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<!-- only div right :D -->

<script>
	$(document).ready(function() {
		$('#history-chuyenxu').dataTable({
			order:[[6,"desc"]],

		});
		// check click
		
	});
</script>