<!-- only div right :D -->
<div class="col-md-8 col-sm-12 right-home mb-3 relative-card">
	<div class="loading-form">
		<div>
			<i class="spinner-border "></i>
			<span>Đang tải...</span>
		</div>
	</div>
	<div class="left-title-home">
		<h4><?= $title ?></h4>
	</div>
	<div class="form-right-home">
		<form id="change-password" class="row">
			<div class="col-sm-12 mb-3 box-valid">
				<label for="">Mật khẩu hiện tại</label>
				<input name="oldPass" type="password" class="form-control" placeholder="Nhập mật khẩu cũ">
			</div>
			<div class="col-sm-12 mb-3 box-valid">
				<label for="">Mật khẩu mới</label>
				<input type="password" name="newPass" id="newPass" class="form-control" placeholder="Nhập mật khẩu mới">
			</div>
			<div class="col-sm-12 mb-3 box-valid">
				<label for="">Nhập lại mật khẩu mới</label>
				<input type="password"  name="reNewPass" class="form-control" placeholder="Nhập mật khẩu xác nhận">
			</div>
			<div class="col-sm-12 mb-3">
				<label for="">Mã xác thực</label>
				<div class="input-group custom-have-otp box-valid">
					<input type="number" name="otpPWD" class="form-control" id="input-email" placeholder="Gồm 6 chữ số">
					<button class="btn-cus btn-success" id="button-get-token" type="button">Lấy mã xác thực</button>
				</div>
			</div>
			
			<div class="col-sm-12 mb-3">
				<button class="btn-cus btn-info" id="btn-doi-mat-khau">Đổi mật khẩu</button>
			</div>
		</form>
	</div>
</div>
<!-- only div right :D -->
<script>
	$(document).ready(function() {
		$('#change-password').validate({
			rules:{
				"oldPass": {
					required: true,
					minlength: 6,
					maxlength: 36
				},
				"newPass": {
					required: true,
					minlength: 6,
					maxlength: 36
				},
				"reNewPass": {
					required: true,
					minlength: 6,
					maxlength: 36,
					equalTo: '#newPass'
				},
				"otpPWD": {
					required: true,
					minlength: 6,
					maxlength: 6
				},
			},
			messages:{
				"oldPass":{
					required: 'Vui lòng nhập mật khẩu cũ',
					minlength: 'Mật khẩu tối thiểu 6 ký tự',
					maxlength: 'Mật khẩu tối đa 36 ký tự'
				},
				"newPass":{
					required: 'Vui lòng nhập mật khẩu mới',
					minlength: 'Mật khẩu tối thiểu 6 ký tự',
					maxlength: 'Mật khẩu tối đa 36 ký tự'
				},
				"reNewPass":{
					required: 'Vui lòng nhập mật khẩu khác nhận',
					minlength: 'Mật khẩu tối thiểu 6 ký tự',
					maxlength: 'Mật khẩu tối đa 36 ký tự',
					equalTo: 'Mật khẩu xác nhận không khớp với mật khẩu mới'
				},
				"otpPWD":{
					required: 'Vui lòng nhập mã OTP',
					minlength: 'Mã OTP chỉ được 6 số',
					maxlength: 'Mã OTP chỉ được 6 số',

				}
			}
		});

		$('#change-password').submit(function(event) {
			/* Act on the event */
			event.preventDefault();	
			if($('#change-password').valid() === true){

				let oldPass = $(this).find('input[name="oldPass"]').val();
				let newPass = $(this).find('input[name="newPass"]').val();
				let reNewPass = $(this).find('input[name="reNewPass"]').val();
				let otpPWD = $(this).find('input[name="otpPWD"]').val();
				let token = $('body').data('token');

				$.ajax({
					url: '/xuly/changePassword.php',
					type: 'POST',
					data: {oldpass: oldPass, newpass:newPass, otp:otpPWD, web_token:token},
					beforeSend: function(){
						$('#btn-doi-mat-khau').attr('disabled', 'true').html('Đang xử lý...');
						$('.loading-form').css('display', 'unset');
					}
				})
				.done(function(res) {
						if (res.status === -99) {
							bootbox.alert({
								title: 'Thông báo',
								message: res.sms,
								centerVertical: true,
								backdrop:true,
							});
						
						}else{
							bootbox.alert({
								title: 'Thông báo',
								message: res.sms,
								centerVertical: true,
								backdrop:true,
								callback: function(){
								window.location.reload();

								}
							});
						}

					

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
					$('#btn-doi-mat-khau').removeAttr('disabled').html('Đổi mật khẩu');
					$('.loading-form').css('display', 'none');
				});
				

			}
		});
	
	});
</script>