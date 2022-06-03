<div class="col-lg-6 col-sm-12">
	<div class="card mt-3 mb-5">
		<div class="card-header">
			<h3 class="text-center text-capitalize"><?= $title ?></h3>
		</div>
		<div class="card-body">
			<form id="register-form" class="mt-3 mb-3">
				<div class="form-group box-valid mb-3">
					<label class="label-cus-left mb-2" for="taikhoan">Thông tin bắt buộc</label>
					<input name="taikhoan" type="text" class="form-control" placeholder="Tài khoản" minlength="6" maxlength="16">
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
				<div class="form-group mb-2">
					<button class="btn btn-primary w-100">Đăng ký mới</button>
				</div>
				<div class="text-center mb-2">
					<small>Bạn đã có tài khoản?</small>
				</div>

				<div class="text-center">
					<a href="/" class="btn btn-sm btn-outline-danger text-uppercase">Đăng nhập ngay</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {

// valid sosos điện thoại việt nam

$.validator.addMethod("validatePhoneVN", function (value, element) {
	return this.optional(element) || /(0|84)+([0-9]{8,10})$/g.test(value);
}, "Hãy nhập password từ 8 đến 16 ký tự bao gồm chữ hoa, chữ thường và ít nhất một chữ số");



$('#register-form').validate({
	rules:{
		"taikhoan": {
			required: true,
			minlength: 6,
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
			minlength: 'Tên tài khoản tối thiểu 6 ký tự',
			maxlength: 'Tên tài khoản tối đa 16 ký tự'
		},
		"email":{
			required: 'Vui lòng điền email',
			email: 'Vui lòng điền email hợp lệ'
		},
		"phone":{
			required:'Vui lòng điền số điện thoại',
			validatePhoneVN: 'Số điện thoại không hợp lệ'
		}

	}
});

$('#register-form').submit(function(event) {
	/* Act on the event */
	event.preventDefault();
});
});
</script>