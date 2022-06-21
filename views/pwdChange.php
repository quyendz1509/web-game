<!-- only div right :D -->
<div class="col-md-8 col-sm-12 right-home mb-3">
	<div class="left-title-home">
		<h4><?= $title ?></h4>
	</div>
	<div class="form-right-home">
		<form id="change-password" class="row">
			<div class="col-sm-12 mb-3">
				<label for="">Mật khẩu hiện tại</label>
				<input type="text" class="form-control" placeholder="Nhập mật khẩu cũ">
			</div>
			<div class="col-sm-12 mb-3">
				<label for="">Mật khẩu mới</label>
				<input type="text" class="form-control" placeholder="Nhập mật khẩu mới">
			</div>
			<div class="col-sm-12 mb-3">
				<label for="">Nhập lại mật khẩu mới</label>
				<input type="text" class="form-control" placeholder="Nhập mật khẩu xác nhận">
			</div>
			<div class="col-sm-12 mb-3">
				<label for="">Mã xác thực</label>
				<div class="input-group">
					<input type="email" class="form-control" id="input-email" placeholder="Gồm 6 chữ số">
					<button class="btn-cus btn-success" id="button-get-token" type="button">Lấy mã xác thực</button>
				</div>
			</div>
			
			<div class="col-sm-12 mb-3">
				<button class="btn-cus btn-info">Đổi mật khẩu</button>
			</div>
		</form>
	</div>
</div>
<!-- only div right :D -->
<script>
	$(document).ready(function() {
		$('#change-password').submit(function(event) {
			/* Act on the event */
			// event.preventDefault();

		});
		$('#button-get-token').click(function(event) {
			/* Act on the event */
			event.preventDefault();
			let token = $('body').data('token');
				$.ajax({
					url: '/xuly/getToken.php',
					type: 'POST',
					data: {web_token: token},
					beforeSend: function(){
						$('#button-get-token').attr('disabled', 'true').html('Đang xử lý....');
					}
				})
				.done(function(res) {
					let somthing = function(res){
						if (res.status !== -99) {
							window.location.href = "/";
						}

					}
					bootbox.alert({
						title: 'Thông báo',
						message: res.sms,
						centerVertical: true,
						backdrop:true,

					});

				})
				.fail(function() {
					bootbox.alert({
						title: 'Thông báo',
						message: 'Vui lòng kiểm tra kết nối mạng.',
						centerVertical: true,
						backdrop:true,

					});
				})
				.always(function() {
					$('#button-get-token').removeAttr('disabled').html('Lấy mã xác thực');
				});
				
			
		});
	});
</script>