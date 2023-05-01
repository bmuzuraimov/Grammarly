<?php 

namespace application\controllers;
use application\core\Controller;

class CustomerController extends Controller
{
	public function indexAction(){
		//$this->view->path = 'test/test';
		//$this->view->layout = 'custom';
		$vars = [
			'name' => 'Baiel',
			'age' => '20',
		]; 
		$this->view->render('Main Page', $vars);
	}
	public function edit_profileAction(){
		//$this->view->path = 'test/test';
		//$this->view->layout = 'custom';
		$vars = [
			'name' => 'Baiel',
			'age' => '20',
		]; 
		$this->view->render('Main Page', $vars);	
	}
}
 ?>