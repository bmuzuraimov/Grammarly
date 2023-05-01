<?php 
return [
	//main page
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'operation' => [
		'controller' => 'main',
		'action' => 'operation',
	],
	'saveuser' => [
		'controller' => 'main',
		'action' => 'saveuser',
	],
	'isquestionmark' => [
		'controller' => 'main',
		'action' => 'isquestionmark',
	],
	'promtwords' => [
		'controller' => 'main',
		'action' => 'promtwords',
	],
	//add words from small pieces of book
	'verify_word' => [
		'controller' => 'admin',
		'action' => 'verify_word',
	],
	'splitted_book' => [
		'controller' => 'admin',
		'action' => 'splitted_book',
	],
	'splitted_book_process' => [
		'controller' => 'admin',
		'action' => 'splitted_book_process',
	],
	//add words from textarea
	'textarea2words' => [
		'controller' => 'admin',
		'action' => 'textarea2words',
	],
	'textarea2words_process' => [
		'controller' => 'admin',
		'action' => 'textarea2words_process',
	],	
	'logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],
	//sign in	
	'signin' => [
		'controller' => 'sign',
		'action' => 'signin',
	],
	'authenticate' => [
		'controller' => 'sign',
		'action' => 'authenticate',
	],
	'signin' => [
		'controller' => 'sign',
		'action' => 'signin',
	],
	'admin' => [
		'controller' => 'admin',
		'action' => 'index',
	],
	'logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],
];
?>