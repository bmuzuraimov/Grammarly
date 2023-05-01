<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="/public/images/icons/favicon.ico" type="image/icon">
		<link rel="stylesheet" href="/public/css/admin.css">
		<title id="webpage-title">Админ</title>
	</head>
	<!--Body start-->
	<body>
		<button class="skip_btn">Кийинки</button>
		<img src="/public/images/icons/navbar.png" class="navopen">
		<div class="sidebar">
			<ul>
				<hr>
				<li class="close navclose"><img src="/public/images/icons/close.png">Жабуу</li>
				<hr>
				<li><a href="/">Башкы меню</a></li>
				<li><a href="/admin">Башкы бет</a></li>
				<hr>
				<li><a href="/verify_word">Сөз текшеруу</a></li>
				<hr>
				<li><a href="/splitted_book">Сөз кошуу(файл)</a></li>
				<li><a href="/textarea2words">Сөз кошуу(текст)</a></li>
				<hr>
				<li><a href="/logout">Чыгуу</a></li>
			</ul>
		</div>
		<main class="admin__container">
			<h1 class="title-text">Сөз текшеруу</h1>
			<input type="text" value="word name" id="word-title">
			<form action="">
				<div class="verification_block">
					<div class="morf_block">
						<div>
							<div class="radio-toolbar">
								<h3>Жазылышы</h3>
								<input type="radio" name="correct" id="correct">
								<label for="correct">Туура</label>
								<input type="radio" name="correct" id="incorrect">
								<label for="incorrect">Бильбейм</label>
							</div>
						</div>
						<div class="radio-toolbar">
							<h3>Самостоятельные части речи</h3>
							<input id="ps1" type="radio" name="part_speech" value="Зат атооч (имя существительное)">
							<label for="ps1">Зат атооч (имя существительное)</label>
							<input id="ps2" type="radio" name="part_speech" value="Сын атооч (имя прилагательное)">
							<label for="ps2">Сын атооч (имя прилагательное)</label>
							<input id="ps3" type="radio" name="part_speech" value="Сан атооч (числительное)">
							<label for="ps3">Сан атооч (числительное)</label>
							<input id="ps4" type="radio" name="part_speech" value="Ат атооч (местоимение)">
							<label for="ps4">Ат атооч (местоимение)</label>
							<input id="ps5" type="radio" name="part_speech" value="Этиш (глагол)">
							<label for="ps5">Этиш (глагол)</label>
							<input id="ps6" type="radio" name="part_speech" value="Тактооч (наречие)">
							<label for="ps6">Тактооч (наречие)</label>
							<h3>Служебные части речи</h3>
							<input id="ps7" type="radio" name="part_speech" value="Кириш сөздор (вводные слова)">
							<label for="ps7">Кириш сөздор (вводные слова)</label>
							<input id="ps8" type="radio" name="part_speech" value="Кесүү (междометие)">
							<label for="ps8">Кесүү (междометие)</label>
							<input id="ps9" type="radio" name="part_speech" value="Союз (союз)">
							<label for="ps9">Союз (союз)</label>
							<input id="ps10" type="radio" name="part_speech" value="Жасалмалар (предлоги)">
							<label for="ps10">Жасалмалар (предлоги)</label>
							<input id="ps11" type="radio" name="part_speech" value="Бөлүкчөлөр (частицы)">
							<label for="ps11">Бөлүкчөлөр (частицы)</label>
						</div>
					</div>
					<div class="def_block">
						<div>
							<h3>Описание</h3>
							<textarea name="" id=""></textarea>
						</div>
						<div>
							<h3>Синонимдери</h3>
							<label for="">Синоним</label>
							<input type="checkbox">
							<label for="">Синоним</label>
							<input type="checkbox">
							<label for="">Синоним</label>
							<input type="checkbox">
						</div>						
					</div>
				</div>
			</form>
		</main>
		<script type="text/javascript" src="/public/js/jquery.js"></script>
		<!--External JavaScript file-->
		<script type="text/javascript" src="/public/js/script.js"></script>
	</body>
	
</html>