<!-- only div right :D -->
<div class="col-md-8 col-sm-12 right-home mb-3 relative-card">
	<div class="loading-form">
		<div>
			<i class="spinner-border "></i>
			<span>Đang tải...</span>
		</div>
	</div>
	<div class="left-title-home">
		<h4>Thông tin tài khoản</h4>
	</div>
	<div class="form-right-home">

		<div class="row">
			<div class="col-sm-6 mb-3">
				<label for="">ID</label>
				<input type="text" class="form-control" value="<?= $id_user_hash ?>" readOnly>
			</div>
			<div class="col-sm-6 mb-3">
				<label for="">Tài khoản</label>
				<input type="text" class="form-control" value="<?= $infoUser['name'] ?>" readOnly>
			</div>
			<div class="col-sm-12 mb-3">
				<label for="">Địa chỉ email</label>
				<input type="email" name="email" class="form-control" value="<?= $infoUser['email'] ?>" readOnly>
			</div>
			<div class="col-sm-12 mb-3">
				<label for="">Số điện thoại</label>
				<div class="box-valid home-form-box-valid">
					<input type="text" name="phone" class="form-control" value="<?= $infoUser['mobilenumber'] ?>" readOnly>

				</div>

			</div>
			<!-- xác nhjana mật khẩu cấp 2 -->
			<?php 
			if ($infoUser['answer'] == 0):
				?>
				<div id="div-pwd2">
					<div class="col-sm-12">
						<div class="text-center">
							<p class="other-case m-0">Mật khẩu bảo mật để sử dụng nhiều tính năng hơn. </p>
						</div>
					</div>
					<form id="home-form">
						<div class="col-sm-12 mb-3 box-valid">
							<label for="">Mật khẩu cấp 2 </label>
							<input type="password" name="passwordtwo" id="passwordtwo" class="form-control" placeholder="Từ 6 - 36 ký tự">
						</div>
						<div class="col-sm-12 mb-3 box-valid">
							<label for="">Xác nhận mật khẩu cấp 2 </label>
							<input type="password" name="repasswordtwo" class="form-control" placeholder="Nhập lại mật khẩu">
						</div>
						<div class="col-sm-12 mb-3">
							<button class="btn-cus btn-primary" id="save-button-pass2">Lưu thông tin</button>
						</div>
					</form>
				</div>
			<?php endif ?>
		</div>

	</div>
</div>
<!-- only div right :D -->
<script>
	$(document).ready(function() {
		$('#home-form').validate({
			rules:{
				"passwordtwo":{
					required: true,
					minlength: 6,
					maxlength: 36
				},"repasswordtwo":{
					required: true,
					minlength: 6,
					maxlength: 36,
					equalTo: "#passwordtwo"
				}
			},
			messages:{
				"passwordtwo":{
					required:"Không bỏ trống thông tin",
					minlength: "Mật khẩu tối thiểu 6 ký tự",
					maxlength: "Mật khẩu tối đa 36 ký tự"
				},
				"repasswordtwo":{
					required:"Không bỏ trống thông tin",
					minlength: "Mật khẩu tối thiểu 6 ký tự",
					maxlength: "Mật khẩu tối đa 36 ký tự",
					equalTo: "Mật khẩu xác nhận không chính xác"
				}
			}
		});

		
	});
	$(document).ready(function() {

		$('#home-form').submit(function(event) {
			/* Act on the event */
			event.preventDefault();
			if($('#home-form').valid()){
				let passwordtwo = $(this).find('input[name="passwordtwo"]').val();
				let repasswordtwo = $(this).find('input[name="repasswordtwo"]').val();
				let token = $('body').data('token');
				$.ajax({
					url: '/handle/makePassTwo.php',
					type: 'POST',
					data: {web_token:token,password:passwordtwo},
					beforeSend: function(){
						$('#save-button-pass2').attr('disabled', 'true');
						$('.loading-form').css('display', 'unset');
					}
				})
				.done(function(res) {
					if (res.status == -99) {
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
							$('#div-pwd2').remove();

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
					$('#save-button-pass2').removeAttr('disabled');
					$('.loading-form').css('display', 'none');
				});
				
			}
		});
	});
</script>