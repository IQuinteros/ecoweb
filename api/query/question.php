<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/question_model.php');

class Question extends Connection{
    public function insert_question($object){
        $this->connection_hosting();
        $sql="INSERT INTO `question` (`id`, `question`, `creation_date`, `profile_id`, `article_id`) 
        VALUES (NULL, :question, CURRENT_TIME(), :profile_id, :article_id);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':question', $object->question, PDO::PARAM_STR);
        $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
        $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
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
    public function delete_question(){
        
    }
}