<!-- only div right :D -->
<div class="col-md-8 col-sm-12 right-home mb-3">
	<div class="left-title-home">
		<h4><?= $title ?></h4>
	</div>
	<div class="form-right-home table-responsive">
		<table class="table table-striped dt-responsive nowrap w-100" id="history-doixu">
			<thead>
				<tr>
					<th>STT</th>
					<th>Số knb</th>
					<th>Số xu</th>
					<th>Nội dung</th>
					<th>Thời gian</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($his_xu as $key => $value): 
					$soxu = number_format($_main->sumKnbAndXu(0,$value['user']));
					$soknb = number_format($_main->sumKnbAndXu(1,$value['user']));
					?>
					<tr>
						<th><?= $key + 1 ?></th>
						<td><?= number_format( $value['soknb'] ) ?> knb</td>

						<td><?= number_format( $value['amount'] ) ?> xu</td>
						<td><?= $value['ghichu'] ?></td>
						<td><?= date('Y-m-d',strtotime($value['time']) ) ?></td>
						
					</tr>
				<?php endforeach ?>
			</tbody>
			
		</table>
		<p style="border-right: 0;">Tổng xu đã đổi: <strong class="text-info"><?= (isset($soxu)) ?  $soxu : 0; ?> xu</strong> - Tổng KNB đã đổi: <strong class="text-info"><?=  (isset($soknb)) ?  $soknb : 0; ?> knb</strong></p>
	</div>
</div>
<!-- only div right :D -->

<script>
	$(document).ready(function() {
		$('#history-doixu').dataTable({
			order:[[0,"desc"]]
		});
		// check click
	});
</script>