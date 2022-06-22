$(document).ready(function() {
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
	// 
	$.validator.addMethod("validatePhoneVN", function (value, element) {
		return this.optional(element) || /^(0|84|03|08|09|07|05)([0-9]{9,12})$/g.test(value);
	}, "Số điện thoại không hợp lệ. Vui lòng kiểm tra lại.");

	const path_name = window.location.pathname;
	const search_name = window.location.search;
	const path_search_name = path_name+search_name;
	$(`.nav-link-custom a[href="${path_search_name}"]`).addClass('active');
});

