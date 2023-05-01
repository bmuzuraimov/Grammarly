<?php 
namespace application\controllers;
use application\core\Controller;

class AdminController extends Controller
{
    private function isLogin()
    {
        $logout = false;
        if (isset($_SESSION['session_key'])) {
            $curr_ip    = $this->model->get_client_ip();
            $curr_ip    = md5($curr_ip);
            $db_session = $this->model->get_key($_SESSION['user_id']);
            $logout     = ($_SESSION['session_key'] != $db_session['authKey']) ? true : false;
            $logout     = ($_SESSION['log_ip'] != $db_session['log_ip']) ? true : false;
        } else {
            $logout = true;
        }
        if ($logout) {
        	$userid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
            $this->model->delete_key($userid);
            session_destroy();
            $this->view->errorCode(403);;
            exit;
        }
    }
	public function indexAction(){
		$this->isLogin();
		$vars = [];
		$this->view->render('Add words', $vars);
	}
	public function verify_wordAction(){
		$this->isLogin();
		$vars = [];
		$this->view->render('Add words', $vars);
	}
	public function splitted_bookAction(){
		$this->isLogin();
		$vars = [];
		$this->view->render('Add words', $vars);
	}
	public function splitted_book_processAction(){
		$this->isLogin();
		$new_words = 0;
		$existing_words = 0;
		$has_comma = '';
	    if (!empty($_POST['file_name'])) {
	    	$file_name = "public/books/pieces/".filter_input(INPUT_POST, 'file_name');
	    	$handle = fopen($file_name, "r");
	    	$text = fread($handle, filesize($file_name));
	    	fclose($handle);
	    	$text = $this->filter2kyrgyzwords($text);
	    	$words = preg_split("/[\s]/", $text);
	    	foreach ($words as $word) {
	    		$word = trim($word);
	    		if(strlen($word)<2){
	    			continue;
	    		}
	    		if($word!=''){
    				$word = mb_strtolower($word, 'utf-8');
    				$isExist = $this->model->isWordExists($word);
    				if($isExist!=false){
    					$this->model->used_word($isExist['id']);
    					$existing_words ++;
    				}else{
    					$this->model->insert_words($word, '');
    					$new_words ++;
    				}
	    		}
	    	}
	    	unlink($file_name);
	    	echo 'New words added: '.$new_words.'<br>';
	    	echo 'Existing words: '.$existing_words.'<br>';
	    }else {
	        echo json_encode(array('success' => false, 'link' => null, 'message' => 'Проиошла ошибка!'), JSON_UNESCAPED_UNICODE);
	    }
	}
	public function textarea2wordsAction(){
		$this->isLogin();
		$vars = [];
		$this->view->render('Add words', $vars);
	}
	public function textarea2words_processAction(){
		$this->isLogin();
		$new_words = 0;
		$existing_words = 0;
		$has_comma = '';
	    if (!empty($_POST['text'])) {
	    	$text = filter_input(INPUT_POST, 'text');
	    	$text = $this->filter2kyrgyzwords($text);
	    	$words = preg_split("/[\s]/", $text);
	    	foreach ($words as $word) {
	    		$word = preg_replace('/^\-|$\-/', '', $word);
	    		$word = trim($word);
	    		if(strlen($word)<2){
	    			continue;
	    		}
	    		if($word!=''){
    				$word = mb_strtolower($word, 'utf-8');
    				$isExist = $this->model->isWordExists($word);
    				if($isExist!=false){
    					$this->model->used_word($isExist['id']);
    					$existing_words ++;
    				}else{
    					$this->model->insert_words($word, '');
    					$new_words ++;
    				}
	    		}
	    	}
	    	echo 'New words added: '.$new_words.'<br>';
	    	echo 'Existing words: '.$existing_words.'<br>';
	    }else {
	        echo json_encode(array('success' => false, 'link' => null, 'message' => 'Проиошла ошибка!'), JSON_UNESCAPED_UNICODE);
	    }
	}
	private function split_book(){
		$handle = fopen("public/books/book.txt", "r");
		$limit = 500;
		$piece_text = '';
		$no_line = 1;
		$no_file = 1;
		if ($handle) {
		    while (($line = fgets($handle)) !== false) {
		    	$piece_text .= $line;
		        if($no_line%500 == 0 && $no_line != 1){
		        	$piece_text_file = fopen("public/books/pieces/piece_file_".$no_file.".txt", "w");
					fwrite($piece_text_file, $piece_text);
					fclose($piece_text_file);
		        	$piece_text = '';
		        	$no_file ++;
		        }
		        $no_line ++;
		    }

		    fclose($handle);
		} else {
		    echo 'Error occured while opening file';
		}
	}

	private function filter2kyrgyzsentences($text){
		$text = preg_replace('Ї', 'Ү', $text);
		$text = preg_replace('ї', 'ү', $text);
		$text = preg_replace('Є', 'Ө', $text);
		$text = preg_replace('є', 'ө', $text);
		$text = preg_replace('Ў', 'Ң', $text);
		$text = preg_replace('ў', 'ң', $text); 
		$text = preg_replace('/[^А-ЯҢӨҮа-яңөү\s\?\.\!\,\-]/u', ' ', $text);
		$text = preg_replace('/(\s\-\s)/u', '-', $text);// азык - тулук => азык-тулук
		$text = preg_replace('/(\-\s.)/u', '', $text);//башка- дан => башкадан
		$text = preg_replace('/\s+/', ' ', $text);//ким    коргон  болсо => ким коргон болсо
		return $text;
	}
	private function filter2kyrgyzwords($text){	
		$text = preg_replace('Ї', 'Ү', $text);
		$text = preg_replace('ї', 'ү', $text);
		$text = preg_replace('Є', 'Ө', $text);
		$text = preg_replace('є', 'ө', $text);
		$text = preg_replace('Ў', 'Ң', $text);
		$text = preg_replace('ў', 'ң', $text);
		$text = preg_replace('/[^А-ЯҢӨҮа-яңөү\s\-]/u', ' ', $text);
		$text = preg_replace('/(\-\s.)/u', '', $text);//remove dash cause of the line break
		$text = preg_replace('/\s+/', ' ', $text);
		return $text;
	}
    public function logoutAction()
    {
    	$userid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
        $this->model->delete_key($userid);
        session_destroy();
        $this->view->redirect('/signin');
    }
}
?>
