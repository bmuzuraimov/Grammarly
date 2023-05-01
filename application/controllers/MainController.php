<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        if (isset($_COOKIE['doc_title'])) {
            $doc_title = $_COOKIE['doc_title'];
        } else {
            $doc_title = '';
        }
        $vars = [
            'doc_title' => $doc_title,
        ];
        $this->view->render('Main Page', $vars);
    }

    public function operationAction()
    {
        /*
        $total=0;
        $counter=0;
        $dialect = 'анат';
        $rows = $this->model->get_description(''.$dialect.'');
        echo 'Found: '.count($rows).'<br>';
        foreach ($rows as $row) {
            $description_elements = explode(' ', $row['description']);
            $word_pos = array_search($dialect, $description_elements);
            $total +=$word_pos;
            $counter++;
            if(in_array($dialect, $description_elements)){
                $updated_description = array_diff($description_elements, [$dialect]);
                $updated_description = implode(' ', $updated_description);
                echo $row['word'].' '.$row['description'].' '.$row['dialect'].'<br>';
                //$this->model->insert_root_dialect($row['id'], $dialect);
                //$this->model->insert_description($row['id'], $updated_description);
            }
        }
        echo $total/$counter;*/   
    }

    public function saveuserAction()
    {
        $cookie_name  = "doc_title";
        $cookie_value = json_decode($_POST['data']);
        setcookie($cookie_name, $cookie_value, time() + 18000, "/");
    }

    public function isquestionmarkAction()
    {
        $question_words = $this->model->get_question_words();
        $sentences      = json_decode($_POST['data']);
        $response       = array('correct' => true,
            'fixes'                           => [],
        );
        $mark = '';
        for ($i = 0; $i < count($sentences); $i++) {
            $words = explode(" ", $sentences[$i]);
            if (isset($sentences[$i + 1])) {
                $mark = $sentences[$i + 1];
            }
            $question_words = array_map('strtolower', $question_words);
            $words          = array_map('strtolower', $words);
            $is_q_sentence  = array_intersect($words, $question_words);
            if (count($is_q_sentence) > 0 && $mark != '?') {
                $response['correct'] = false;
                array_push($response['fixes'], array($i, $mark, '?'));
            } elseif (count($is_q_sentence) == 0 && $mark == '?') {
                $response['correct'] = false;
                array_push($response['fixes'], array($i, $mark, '.'));
            }
            $mark = '';
        }
        echo json_encode($response);
    }

    public function promtwordsAction()
    {
        $words       = json_decode($_POST['data'], JSON_UNESCAPED_UNICODE);
        $promt_words = $this->model->get_promt_words(end($words));
        echo json_encode($promt_words, JSON_UNESCAPED_UNICODE);
    }

    private function txt2db()
    {
        $pattern = "/[ ]/";
        $path    = 'public/words';
        $files   = array_diff(scandir($path), array('.', '..'));
        mb_internal_encoding("UTF-8");
        foreach ($files as $file):
            $text = fopen("public/words/" . $file, "r");
            if ($text) {
                $counter = 1;
                while (($paragraph = fgets($text)) !== false) {
                    $clear_paragraph = preg_replace('/[^А-Яа-яүө ]/u', '', $paragraph);
                    $clear_paragraph = trim($clear_paragraph);
                    $elements        = preg_split($pattern, $clear_paragraph);
                    $word            = $elements[0];
                    $word_length     = strlen($word);
                    $word            = trim($word);
                    $description     = substr($paragraph, $word_length);
                    $description     = preg_replace('/[^А-Яа-яүө\(\) ]/u', '', $description);
                    $description     = trim($description);
                    if(strlen($word)!=0){
                        $this->model->insert_words($word, $description);
                    }
                }
                fclose($text);
            } else {
                echo 'error occured';
            }
        endforeach;
    }
    private function classify_root_languages()
    {
        $root_languages = ['ар'=>'арабский язык', 'башк'=>'башкирский язык', 'греч'=>'греческий язык', 'иp'=>'иранские языки', 'каз'=>'казахский язык', 'кирг'=>'киргизский язык', 'кит'=>'китайский язык', 'монг'=>'монгольский язык', 'p'=>'русский язык', 'тадж'=>'таджикский язык', 'тат'=>'татарский язык', 'тиб'=>'тибетский язык', 'тув'=>'тувинский язык', 'узб'=>'узбекский язык', 'уйг'=>'уйгурский язык'];
        $language = 'иp';
        $rows = $this->model->get_description(''.$language.'');
        echo 'Found: '.count($rows).'<br>';
        foreach ($rows as $row) {
            $description_elements = explode(' ', $row['description']);
            $word_pos = array_search($language, $description_elements);
            $total += $word_pos;
            $counter++;
            if(in_array($language, $description_elements)){
                $updated_description = array_diff($description_elements, [$language]);
                $updated_description = implode(' ', $updated_description);
                echo $row['word'].' '.$row['description'].' '.$row['root_language'].'<br>';
                //$this->model->insert_root_language($row['id'], $language);
                //$this->model->insert_description($row['id'], $updated_description);
            }
        }
    }
    private function nestedLowercase($value)
    {
        if (is_array($value)) {
            return array_map('nestedLowercase', $value);
        }
        return strtolower($value);
    }
}
