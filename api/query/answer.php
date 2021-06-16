<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/answer_model.php');

class Answer extends Connection{
    public function insert_answer($object){
        $this->connection_hosting();
        $sql="INSERT INTO `answer` (`id`, `answer`, `creation_date`, `question_id`) 
        VALUES (NULL, :answer, CURRENT_TIME(), :question_id);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':answer', $object->answer, PDO::PARAM_STR);
        $resultado->bindParam(':question_id', $object->question_id, PDO::PARAM_INT);
        $re=$resultado->execute();
        if (!$re) 
        {
         //die(mysql_error());
        } else{
         $re = $this->pdo->lastInsertId();
         $this->pdo = null;
         return array($re);
        }
    }
}