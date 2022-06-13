<div class="col-lg-6 col-sm-12">
	<div class="card mt-3 relative-card">
		<div class="loading-form">
			<div>
				<i class="spinner-border "></i>
				<span>Đang tải...</span>
			</div>
		</div>
		<div class="card-header">
			<h3 class="text-center text-capitalize"><?= $title ?></h3>
		</div>
		<div class="card-body">
			<form id="login-form" class="mt-3 mb-3">
				<div class="form-group box-valid mb-3">
					<input name="taikhoan" type="text" class="form-control" placeholder="Tài khoản" minlength="5" maxlength="16">
				</div>
				<div class="form-group box-valid mb-2">
					<input  name="matkhau" type="password" class="form-control" placeholder="Mật khẩu" minlength="6" maxlength="36">
				</div>
				<div class="form-check mb-2">
					<input class="form-check-input" type="checkbox" id="flexRadioDefault1">
					<label for="flexRadioDefault1" class="form-check-label">Ghi nhớ đăng nhập</label>
				</div>
				<div class="form-group box-valid mb-2">
					<button class="btn-cus btn-primary w-100" id="login-button">Đăng nhập ngay</button>
				</div>
				<div class="text-center mb-2">
					<small>Bạn quên mật khẩu? <a href="/index.php?ctrl=forget">Lấy lại mật khẩu</a></small>
				</div>
				<div class="text-center mb-2">
					<p class="other-case m-0">Hoặc</p>
				</div>
				<div class="text-center">
					<a href="/index.php?ctrl=register" class=" btn-cus btn-success text-uppercase">Đăng ký tài khoản mới</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#login-form').validate({
			rules:{
				"taikhoan": {
					required: true,
					minlength: 5,
					maxlength: 16
				},
				"matkhau": {
					required: true,
					minlength: 6,
					maxlength: 36
				}
			},
			messages:{
				"taikhoan":{
					required: 'Nhập tên tài khoản',
					minlength: 'Tên tài khoản tối thiểu 5 ký tự',
					maxlength: 'Tên tài khoản tối đa 16 ký tự'
				},
				"matkhau":{
					required: 'Vui lòng nhập mật khẩu',
					minlength: 'Mật khẩu tối thiểu 6 ký tự',
					maxlength: 'Mật khẩu tối đa 36 ký tự'
				}
			}
		});

		$('#login-form').submit(function(event) {
			/* Act on the event */
			event.preventDefault();
			if($('#login-form').valid()){
				let taikhoan = $(this).find('input[name="taikhoan"]').val();
				let matkhau = $(this).find('input[name="matkhau"]').val();
				let token = $('body').data('token');
				$.ajax({
					url: '/handle/auth.php',
					type: 'POST',
					data: {key:2,taikhoan:taikhoan,matkhau:matkhau,web_token:token},
					beforeSend: function(){
						$('#login-button').attr('disabled', 'true');
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
						window.location.href = "/";
						
						
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
					$('#login-button').removeAttr('disabled');
					$('.loading-form').css('display', 'none');
				});
				
			}
		});
	});
</script>