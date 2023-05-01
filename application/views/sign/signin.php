<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sign In</title>
		<link rel="stylesheet" href="/public/css/style.css">
	</head>
	<body>
		<img src="/public/images/icons/navbar.png" class="navopen">
		<div class="sidebar">
			<ul>
				<hr>
				<li class="close navclose"><img src="/public/images/icons/close.png">Жабуу</li>
				<hr>
				<li><a href="#">Менин документтерим</a></li>
				<hr>
				<li><a href="#new_doc">Жаны документ</a></li>
				<li><a href="#paste_text">Көчурүү</a></li>
				<li><a href="#print">Басып чыгаруу</a></li>
				<hr>
				<li><a href="#typing_club">Тез Терүү</a></li>
				<li><a href="#statistics">Статистика</a></li>
				<hr>
				<li><a href="#install_keyboard">Кыргыз клавиатурасы</a></li>
				<li><a href="#news">Жанылык</a></li>
				<li><a href="#send_feedback">Ой болүшүү</a></li>
				<hr>
				<li><a href="#editor_settings">Редактор орнотуулар</a></li>
				<li><a href="#privacy_policy">Купуялуулук эрежелер</a></li>
				<li><a href="#user_terms">Тейлөө шарттары</a></li>
			</ul>
		</div>
		<main class="container">
			<div class="signin__container">
				<form id="signin-form" action="/authenticate" method="POST">
					<h3 class="message">Кирүү</h3>
					<div class="text-input">
						<label for="">Колдонуучунун аты</label>
						<input type="text" name="username">
					</div>
					<div class="text-input">
						<label for="">Купуя сөз</label>
						<input type="password" name="password">
					</div>
					<div class="text-input">
						<input type="submit" id="submit-btn" value="жөнөтүү">
					</div>
				</form>
			</div>
		</main>
		<script type="text/javascript" src="/public/js/jquery.js"></script>
		<script type="text/javascript">
			$('#submit-btn').click(function () {
				$.post($('#signin-form').attr('action'), $('#signin-form :input').serializeArray(), function(response) {
					console.log(response);
					responseObj = JSON.parse(response);
					if (responseObj.success==true) {
						$('.signin__container').addClass('success');
						window.setTimeout(function () {
					location.href = '/'+responseObj.link;
					}, 2000);
					}else {
						$('.signin__container').addClass('error');
					}
				});
			});
			$('.text-input input').change(function() {
				$('.signin__container').removeClass('error')
			});
			$('#signin-form').submit(function() {
				return false;
			});
			/* ========================================
			    Toggle sidebar
			   ====================================== */
			$('.navopen').click(function () {
			    $('.sidebar').css({left: '0px'});
			});
			$('.navclose').click(function () {
			    $('.sidebar').css({left: '-300px'});
			});
		</script>
	</body>
</html>