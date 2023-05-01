<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function insert_synonym($wordid1, $wordid2)
    {
        $params = [
            'wordid1' => $wordid1,
            'wordid2' => $wordid2,
        ];
        $result = $this->db->query('INSERT INTO `kyrgyz_synonyms`(`wordid1`, `wordid2`) VALUES (:wordid1, :wordid2)', $params);
    }
    public function insert_description($id, $description)
    {
        $params = [
            'id'          => $id,
            'description' => $description,
        ];
        $result = $this->db->query('UPDATE `kyrgyz_words` SET `description`=:description WHERE `id`=:id', $params);
    }
    public function insert_root_language($id, $root_language)
    {
        $params = [
            'id'            => $id,
            'root_language' => $root_language,
        ];
        $result = $this->db->query('UPDATE `kyrgyz_words` SET `root_language`=:root_language WHERE `id`=:id', $params);
    }
    public function insert_root_dialect($id, $dialect)
    {
        $params = [
            'id'      => $id,
            'dialect' => $dialect,
        ];
        $result = $this->db->query('UPDATE `kyrgyz_words` SET `dialect`=:dialect WHERE `id`=:id', $params);
    }
    public function get_description($pattern)
    {
        $params = [
            'pattern' => '%' . $pattern . '%',
        ];
        $result = $this->db->rows('SELECT `id`, `word`, `description`, `root_language`, `dialect`  FROM `kyrgyz_words` WHERE `description` LIKE :pattern', $params);
        return $result;
    }
    public function isSynonymExists($wordid)
    {
        $params = [
            'wordid' => $wordid,
        ];
        $result = $this->db->row('SELECT `id` FROM `kyrgyz_synonyms` WHERE `wordid1` = :wordid OR `wordid2` = :wordid', $params);
        return $result;
    }
    public function get_question_words()
    {
        $result = $this->db->colums('SELECT `word` FROM `question_words`');
        return $result;
    }
    public function get_promt_words($word)
    {
        $params = [
            'word' => $word . '%',
        ];
        $result = $this->db->rows('SELECT `word`, `description`  FROM `kyrgyz_words` WHERE `word` != :word AND `word` LIKE :word ORDER BY `used` DESC LIMIT 5', $params);
        return $result;
    }
}
