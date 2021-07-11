<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/answer.php');
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
    public function delete_question($id){
        $this->connection_hosting();
        $sql="DELETE FROM `question` WHERE `id`=:id";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
  
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':id', $id, PDO::PARAM_INT);
         $re=$resultado->execute();
         if (!$re) {
          //die(mysql_error());
        } else{
          $this->pdo = null;
          return $re;
      }
    }
    public function select_question($object){
      $this->connection_hosting();
      $sql="SELECT question.*, profile.name as profile_name, profile.last_name as profile_last_name,
      article.title as article_title
      FROM `question`
      JOIN `article` ON question.article_id = article.id
      LEFT JOIN `profile` ON question.profile_id = profile.id";
      $haveWHERE = false;

      // Check for id
     if(!is_null($object) && isset($object->id)){
       $sql = $sql." WHERE id=:id";
       $haveWHERE = true;
     }
      // Check for id_article
     if(!is_null($object) && isset($object->article_id)){
       $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article_id=:article_id";
       $haveWHERE = true;
     }
     // Check for id_list (ID LIST WILL BE A LIST WITH ID's TO GET)
     if(!is_null($object) && isset($object->id_list)){
        if(gettype($object->id_list) == "array"){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ");
            for($i = 0; $i < count($object->id_list); $i++){
                $sql = $sql."question.article_id=:each_id".$i;
                if($i < (count($object->id_list) - 1)){
                $sql = $sql." OR ";
                }
            }
            $haveWHERE = true;
        }
    }
     $sql = $sql." ORDER BY creation_date DESC";

     try{
      $resultado=$this->pdo->prepare($sql);
      if(isset($object->id)){
          $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
        }
      if(isset($object->article_id)){
        $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
      }
      if(isset($object->id_list)){
        if(gettype($object->id_list) == "array"){
            for($i = 0; $i < count($object->id_list); $i++){
            $resultado->bindParam(':each_id'.$i, $object->id_list[$i], PDO::PARAM_INT);
            }
        }
      }
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      $lista_question = array();

      for($i = 0; $i < count($data); $i++){
        $questionn =new Question_model();
        $questionn->id=$data[$i]["id"];
        $questionn->question=$data[$i]["question"];
        $questionn->creation_date=$data[$i]["creation_date"];
        $questionn->profile_id=$data[$i]["profile_id"];
        $questionn->article_id=$data[$i]["article_id"];
        $questionn->profile_name=$data[$i]["profile_name"]." ".$data[$i]["profile_last_name"];
        $questionn->article_name=$data[$i]["article_title"];

        array_push($lista_question, $questionn);
      }

      $idList = array_map(function($val){
          return $val->id;
      }, $lista_question);

      $questionIdObject = json_decode(json_encode(array("id_list" => $idList)));

      $answerConnection = new Answer();
      $answers = $answerConnection->select_answer($questionIdObject);

      foreach($lista_question as $question){
          $foundAnswers = array_filter($answers, function($val) use (&$question){
              return $question->id == $val->question_id;
          });
          
          $question->answer = count($foundAnswers) > 0? end($foundAnswers) : null;
      }

      $this->pdo = null;
      
      return $lista_question;
    
      } catch(PDOException $e){
        echo $e->getMessage();
        return $e;
        die();
      }
    }
}