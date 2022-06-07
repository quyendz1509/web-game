$(document).ready(function() {
	$.validator.addMethod("validatePhoneVN", function (value, element) {
		return this.optional(element) || /^(0|84|03|08|09|07|05)([0-9]{9,12})$/g.test(value);
	}, "Số điện thoại không hợp lệ. Vui lòng kiểm tra lại.");

	const path_name = window.location.pathname;
	const search_name = window.location.search;
	const path_search_name = path_name+search_name;
	$(`.nav-link-custom a[href="${path_search_name}"]`).addClass('active');
});