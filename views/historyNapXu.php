<!-- only div right :D -->
<div class="col-md-8 col-sm-12 right-home mb-3">
	<div class="left-title-home">
		<h4><?= $title ?></h4>
	</div>
	<div class="form-right-home table-responsive-xxl">
		<table class="table table-bordered" id="history-napxu">
			<thead>
				<tr>
					<th>STT</th>
					<th>Loại thẻ</th>
					<th>Mệnh giá</th>
					<th>Thời gian</th>
					<th></th>

				</tr>
			</thead>
			<tbody>
				<?php foreach ($his_nap as $key => $value): ?>
					<tr>
						<th><?= $key ?></th>
						<td><span class="badge bg-info"><?= $value['loaithe'] ?></span></td>	
						<td><?= number_format($value['menhgia']) ?> đ</td>
						<td><?= date('Y-m-d',strtotime($value['pay_time']) ) ?></td>
						<td class="text-center">
							<button data-bs-toggle="tooltip" data-bs-placement="top"
							data-bs-custom-class="custom-tooltip"
							title="Xem thêm thông tin" class="view-more" data-id="<?= $value['id'] + $_ID_USER_NUMBER ?>"><i class="lar la-eye"></i></button>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<!-- only div right :D -->
<div class="modal fade" id="napxu-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#history-napxu').dataTable({
			order:[[0,"desc"]]
		});
		// check click
		$('#history-napxu .view-more').click(function(event) {
			/* Act on the event */
			let data_id = $(this).data('id');
			$.ajax({
				url: '/trans/'+data_id,
				type: 'GET',
			})
			.done(function(res) {
				let res_data = res.data;
				if (res.status !== 9) {
					bootbox.alert({
						title: 'Thông báo',
						message: res_data,
						centerVertical: true,
						backdrop:true,

					});
				}else{
					let status_dta, class_status_dta;
					// status
					switch(res_data.stt) {
						case 2:
						status_dta = 'Thành công';
						class_status_dta = 'bg-success';
						break;
						case 9:
						status_dta = 'Thẻ không hợp lệ';
						class_status_dta = 'bg-danger';
						break;
						case 10:
						status_dta = 'Thẻ sai mệnh giá';
						class_status_dta = 'bg-danger';
						break;
						case 3:
						status_dta = 'Thẻ sai';
						class_status_dta = 'bg-danger';
						break;
						default:
						status_dta = 'Đang xử lý';
						class_status_dta = 'bg-warning';
						break;
    // code block
}
					// status
					let modal_title_napxu = $('#napxu-modal .modal-title').html('Lịch sử giao dịch: #' +res_data.trans_id);
					let content_modal = `
					<ul class="nav flex-column">
					<li class="nav-item mb-2"><strong> Loại thẻ: </strong><span class="badge bg-info">${res_data.type}</span> </li>
					<li class="nav-item mb-2"><strong>Mã giao dịch:</strong> #${res_data.trans_id}</li>
					<li class="nav-item mb-2"><strong>Số serial:</strong> ${res_data.serial} </li>
					<li class="nav-item mb-2"><strong>Mã thẻ:</strong> ${res_data.code} </li>
					<li class="nav-item mb-2"><strong>Mệnh giá:</strong> ${res_data.menhgia} </li>
					<li class="nav-item mb-2"><strong>Thực nhận:</strong> ${res_data.thucnhanh} </li>
					<li class="nav-item mb-2"><strong>Trạng thái:</strong> <span class="badge ${class_status_dta}">${status_dta}</span> </li>
					<li class="nav-item mb-2"><strong>Khuyến mãi:</strong> ${res_data.promote} % </li>
					<li class="nav-item mb-2"><strong>Thời gian nhận:</strong> ${res_data.time} </li>
					</ul>

					`;

					$('#napxu-modal .modal-body').html(content_modal);
					$('#napxu-modal').modal('show');
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
			event.preventDefault();
		});
	});
</script>