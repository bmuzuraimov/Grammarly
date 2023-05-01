<?php 
$path    = 'public/books/pieces';
$files = scandir($path);
$files = array_diff(scandir($path), array('.', '..'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/public/css/admin.css">
	<title>Add Words</title>
</head>
<body>
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
		<h1 class="title-text">Words to text</h1>
		<form action="splitted_book_process" method="POST" target="_blank">
			<select name="file_name">
			<?php 
			foreach ($files as $file): 
				echo "<option value=\"$file\">$file</option>";
			endforeach;
			?>
			</select>
			<input type="submit" value="Add words">
		</form>
	</main>
    <script type="text/javascript" src="/public/js/jquery.js"></script>
    <!--External JavaScript file-->
    <script type="text/javascript" src="/public/js/script.js"></script>
</body>
</html>