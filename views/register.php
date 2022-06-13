<div class="col-lg-6 col-sm-12">
	<div class="card mt-3 mb-5 relative-card">
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

			<form id="register-form" class="mt-3 mb-3">
				<div class="form-group box-valid mb-3">
					<label class="label-cus-left mb-2" for="taikhoan">Thông tin bắt buộc</label>
					<input name="taikhoan" type="text" class="form-control" placeholder="Tài khoản" minlength="5" maxlength="16">
				</div>
				<div class="form-group box-valid mb-3">
					<label class="label-cus-left mb-2" for="email">Thông tin bắt buộc</label>
					<input name="email" type="email" class="form-control" placeholder="Email">
				</div>
				<div class="form-group box-valid mb-3">
					<label class="label-cus-left mb-2" for="phone">Thông tin bắt buộc</label>
					<input name="phone" type="number" class="form-control" placeholder="Số điện thoại">
				</div>
				<div class="form-group box-valid mb-3">
					<select name="gender" id="" class="form-select mt-4">
						<option value="0">Nam</option>
						<option value="1">Nữ</option>

					</select>
				</div>
				<div class="form-group box-valid mb-3">
					<label class="label-cus-left mb-2" for="matkhau">Thông tin bắt buộc</label>
					<input name="matkhau" id="matkhau" type="password" class="form-control" placeholder="Mật khẩu" minlength="6" maxlength="36">
				</div>
				<div class="form-group box-valid mb-3">
					<label class="label-cus-left mb-2" for="matkhau2">Thông tin bắt buộc</label>
					<input name="matkhau2" type="password" class="form-control" placeholder="Xác nhận mật khẩu" minlength="6" maxlength="36">
				</div>
				<div class="form-group box-valid mb-3">
					<div id="register-captcha" class="g-recaptcha" data-sitekey="6LcT32MdAAAAAIjN__avjyDVQiBso1aCb-9jTEls"></div>
				</div>
				<div class="form-group mb-2">
					<button class="btn-cus btn-primary w-100" id="register-button">Đăng ký mới</button>
				</div>
				<div class="text-center mb-2">
					<small>Bạn đã có tài khoản?</small>
				</div>

				<div class="text-center">
					<a href="/" class="btn-cus btn-danger text-uppercase">Đăng nhập ngay</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {

// valid sosos điện thoại việt nam




$('#register-form').validate({
	rules:{
		"taikhoan": {
			required: true,
			minlength: 5,
			maxlength: 16
		},
		"email": {
			required: true,
			email: true
		},
		"phone": {
			required: true,
			validatePhoneVN: true
		},
		"matkhau": {
			required: true,
			minlength: 6,
			maxlength: 36
		},"matkhau2": {
			required: true,
			equalTo: "#matkhau",
			minlength: 6,
			maxlength: 36,
		},
	},
	messages:{
		"taikhoan":{
			required: 'Nhập tên tài khoản',
			minlength: 'Tên tài khoản tối thiểu 5 ký tự',
			maxlength: 'Tên tài khoản tối đa 16 ký tự'
		},
		"email":{
			required: 'Vui lòng điền email',
			email: 'Vui lòng điền email hợp lệ'
		},
		"phone":{
			required:'Vui lòng điền số điện thoại',
			validatePhoneVN: 'Số điện thoại không hợp lệ'
		},
		"matkhau":{
			required: 'Vui lòng nhập mật khẩu',
			minlength: 'Mật khẩu tối thiểu 6 ký tự',
			maxlength: 'Mật khẩu tối đa 36 ký tự'
		},
		"matkhau2":{
			required: 'Vui lòng nhập mật khẩu xác nhận',
			equalTo: 'Mật khẩu xác nhận không chính xác',
			minlength: 'Mật khẩu xác nhận tối thiểu 6 ký tự',
			maxlength: 'Mật khẩu xác nhận tối đa 36 ký tự'
		}
	}
});

$('#register-form').submit(function(event) {
	/* Act on the event */
	event.preventDefault();
	if ($('#register-form').valid()) {

		let taikhoan = $(this).find('input[name="taikhoan"]').val();
		let email = $(this).find('input[name="email"]').val();
		let phone = $(this).find('input[name="phone"]').val();
		let matkhau = $(this).find('input[name="matkhau"]').val();
		let matkhau2 = $(this).find('input[name="matkhau2"]').val();
		let gender = $(this).find('select[name="gender"]').val();

		let captcha = grecaptcha.getResponse();
		let token = $('body').data('token');
		if (captcha == '') {
			bootbox.alert({
				title: 'Thông báo',
				message: "Vui lòng xác nhận captcha",
				centerVertical: true
			});
		}else{
			$.ajax({
				url: '/handle/auth.php',
				type: 'POST',
				data: {taikhoan: taikhoan,email:email,phone:phone,matkhau:matkhau,'g-recaptcha-response': captcha,web_token:token,key: 1,gender:gender},
				beforeSend: function(){
					$('#register-button').attr('disabled', 'true');
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
							window.location.href = "/";
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
				$('#register-button').removeAttr('disabled');

				$('.loading-form').css('display', 'none');

			});
		}
	}
});
});
</script>