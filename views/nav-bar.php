<div class="container">
	<div class="row justify-content-center">
		<div class="logo">
			<a href="#"><img src="/public/images/logo.png" width="115px"></a>
		</div>
		<div class="menu-game">
			<a href="/">Trang chủ</a>
			<a href="<?= $_LINKS_FANPAGES ?>">Fanpage</a>

			<a href="<?= $_LINKS_GROUPS ?>">Diễn Đàn</a>
		</div>

		<?php if (isset($_COOKIE['id'])): ?>
			<div class="col-lg-10 col-sm-12">
				<div class="row home-tab">
					<div class="col-md-4 col-sm-12 left-home mb-3">
						<div class="info-left-side">
							<div class="nav-link-custom justify-content-between">
								<p class="m-0 p-0"><i class="las la-user-circle cus-info-icon"></i><span>[<?= $id_user_hash ?>] <?= $infoUser['name'] ?></span></p>
								<button class="toggle-button-menu"><i class="las la-bars"></i></button>
							</div>
						</div>
						<div id="menu-home">
							<ul class="nav flex-column ul-custom-home-left" >
								
								<!-- another -->
								<li class="nav-item">
									<div class="nav-link-custom">
										<a href="/"><i class="las la-info-circle"></i> Thông tin tài khoản</a>
									</div>
								</li>
								<li class="nav-item">
									<div class="nav-link-custom">
										<a href="/routing?ctrl=pwdchange"><i class="las la-key"></i> Đổi mật khẩu</a>
									</div>
								</li>
								<li class="nav-item">
									<div class="nav-link-custom">
										<a href="/routing?ctrl=recharge"><i class="las la-coins"></i> Nạp xu</a>

									</div>
								</li>
								<li class="nav-item">
									<div class="nav-link-custom">
										<a href="/routing?ctrl=regame"><i class="las la-sign-in-alt"></i> Chuyển xu vào game</a>

									</div>
								</li>
								<li class="nav-item">
									<div class="nav-link-custom">
										<a href="/routing?ctrl=transfer"><i class="las la-exchange-alt"></i> Chuyển xu</a>

									</div>
								</li>
								<li class="nav-item">
									<div class="nav-link-custom">
										<a href="/routing?ctrl=history"><i class="las la-history"></i>Lịch sử giao dịch</a>

									</div>
								</li>
								<li class="nav-item">
									<div class="nav-link-custom">
										<a href="/routing?ctrl=giftcode"><i class="las la-gifts"></i> Nhận quà</a>

									</div>
								</li>
								<!-- another -->

							</ul>
						</div>
						<div class="btn_thoat">
							<a href="/routing?ctrl=logout" class="btn btn-danger w-100"><i class="fa fa-sign-out" aria-hidden="true"></i> THOÁT</a>
						</div>
					</div>
				<?php endif ?>

				<script>
					$(document).ready(function() {
						$('.toggle-button-menu').click(function() {
							/* Stuff to do every *odd* time the element is clicked */
							$('#menu-home').toggle(200);
						});

					});
				</script>