<!-- only div right :D -->
<div class="col-md-8 col-sm-12 right-home mb-3">
	<div class="left-title-home">
		<h4><?= $title ?></h4>
	</div>
	<div class="form-right-home">
		<div class="row">
			<div class="col-sm-12 mb-3">
				<label for="">Nhập Giftcode</label>
				<div class="input-group custom-have-otp box-valid">
					<input type="number" name="otpPWD" class="form-control" id="input-email" placeholder="Gồm 6 chữ số">
					<button class="btn-cus btn-success" type="button">Nhận ngay</button>
				</div>
			</div>
			
			<div class="col-sm-12 mb-3">
				<button class="btn-cus btn-danger"  id="button-get-token">Lấy mã xác nhận</button>
			</div>

			<div class="col-sm-12">
				<hr>
				<h5>Mã ưu đãi dành riêng cho bạn</h5>
				
				<table id="giftcode-form" class="table table-bordered">
					<thead>
						<tr>
							<th>Giftcode</th>
							<th>Hạn sử dụng</th>
							<th>Trạng thái</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<td>21zfd</td>
							<td>2020-23-10</td>
							<td><span class="badge bg-success">Active</span></td>

						</tr>
					</tbody>
				</table>
				<hr>
			</div>
			<div class="col-sm-12">
				<h5>Lịch sử</h5>
				<table>
					
				</table>
			</div>
		</div>
	</div>
</div>
<!-- only div right :D -->
<!-- <script>
	$(document).ready(function() {
		$('#giftcode-form').dataTable();
	});
</script> -->