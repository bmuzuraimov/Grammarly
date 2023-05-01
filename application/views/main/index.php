<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="/public/images/icons/favicon.ico" type="image/icon">
	<link rel="stylesheet" href="/public/css/style.css">
    <title id="webpage-title"><?=$doc_title?></title>  
</head>

<!--Body start-->
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
			<li><a href="#upload_file">Даяр файл жүктөө</a></li>
			<li><a href="#paste_text">Көчурүү</a></li>
			<li><a href="#print">Басып чыгаруу</a></li>
			<hr>
			<li><a href="#typing_club">Тез Терүү</a></li>
			<li><a href="/signin">Кирүү</a></li>
			<li><a href="#statistics">Статистика</a></li>
			<hr>
			<li><a href="#support">Колдоо кызматы</a></li>
			<li><a href="#install_keyboard">Кыргыз клавиатурасы</a></li>
			<li><a href="#news">Жанылык</a></li>
			<li><a href="#send_feedback">Ой болүшүү</a></li>
			<hr>
			<li><a href="#editor_settings">Редактор орнотуулар</a></li>
			<li><a href="#privacy_policy">Купуялуулук эрежелер</a></li>
			<li><a href="#user_terms">Тейлөө шарттары</a></li>
		</ul>
	</div>
    <main class="main__container">
        <input type="text" name="doc_title" class="doc-title" placeholder="Документтин аталышы" value="<?=$doc_title?>">
	    <aside id="mistakes">
	    	<h1 class="loading-title hidden">Иштеп жатат...</h1>
	    	<div class="lds-ellipsis">
	    		<div class=""></div>
	    		<div class=""></div>
	    		<div class=""></div>
	    		<div class=""></div>
	    	</div>
	    	<ul class="mistakes__table"></ul>
	    </aside>
        <aside id="word-promt">
        	<select class="docstat">
        		<option id="docstat_chars">0 тамга</option>
        		<option id="docstat_words" selected>0 сөз</option>
        		<option id="docstat_sentences">0 сүйлөм</option>
        	</select>
        	<div class="word-promt__table">
	        	<ul class="word-promt__words"></ul>
        	</div>
        </aside>
        <article>
	        <page size="A4" id="mypage"></page>
	        <textarea id="mydocument" sspellcheck="false" name="text" placeholder="Тексти жазыныз же даяр кочурунуз (Ctrl+V)"></textarea>
        </article>
        <footer class="main__footer">
        	<div class="footer__left">
	        	<h1>Эне Тил</h1>
	        	<h3>Сени кыргыз катары тилинден кабыл алат</h3>
        	</div>
        	<div class="footer__bottom">
	        	<p>&copy;All rights are reserved</p>
        	</div>
        </footer>
    </main>
    <script type="text/javascript" src="/public/js/jquery.js"></script>
    <!--External JavaScript file-->
    <script type="text/javascript" src="/public/js/script.js"></script>
    <script type="text/javascript" src="/public/js/main.js"></script>
</body>
  
</html>