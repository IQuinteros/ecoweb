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
  public function delete_answer($id){
    $this->connection_hosting();
    $sql="DELETE FROM `answer` WHERE `id`=:id";
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
  public function select_answer($object){
    $this->connection_hosting();
    $sql="SELECT * FROM `answer`";
    $haveWHERE = false;
    // Check for id
    if(!is_null($object) && isset($object->id)){
      $sql = $sql." WHERE id=:id";
      $haveWHERE = true;
    }
      // Check for id_question
    if(!is_null($object) && isset($object->question_id)){
      $sql = $sql.($haveWHERE? " AND " : " WHERE ")."question_id=:question_id";
      $haveWHERE = true;
    }
    try{
      $resultado=$this->pdo->prepare($sql);
      if(isset($object->id)){
          $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
        }
      if(isset($object->question_id)){
        $resultado->bindParam(':question_id', $object->question_id, PDO::PARAM_INT);
      }
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      $lista_answer = array();

      for($i = 0; $i < count($data); $i++){
        $answerr =new Answer_model();
        $answerr->id=$data[$i]["id"];
        $answerr->answer=$data[$i]["answer"];
        $answerr->creation_date=$data[$i]["creation_date"];
        $answerr->question_id=$data[$i]["question_id"];
        array_push($lista_answer, $answerr);
      }

      $this->pdo = null;
      
      return $lista_answer;
    
      } catch(PDOException $e){
        echo $e->getMessage();
        return $e;
        die();
      }
  }
}