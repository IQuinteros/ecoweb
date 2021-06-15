<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/history_model.php');

class History extends Connection{
    public function insert_history($object){
        $this->connection_hosting();
        $sql="INSERT INTO `history` (`id`, `creation_date`, `article_id`, `user_id`) 
        VALUES (NULL, CURRENT_TIME(), :article_id, :user_id);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
        $resultado->bindParam(':user_id', $object->user_id, PDO::PARAM_INT);
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
    public function select_history(){
        $this->connection_hosting();
        $sql="SELECT * FROM `history`;";
        try{
            $resultado=$this->pdo->prepare($sql);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_history = array();
      
            for($i = 0; $i < count($data); $i++){
              $history =new History_model();
              $history->id=$data[$i]["id"];
              $history->creation_date=$data[$i]["creation_date"];
              $history->article_id=$data[$i]["article_id"];
              $history->user_id=$data[$i]["user_id"];
              array_push($lista_history, $history);
            }
      
            $this->pdo = null;
            
            return $lista_history;
          
            } catch(PDOException $e){
              echo $e->getMessage();
              return $e;
              die();
            }
    }
    public function history_delete($id){
      $this->connection_hosting();

      $sql = "DELETE FROM `history` WHERE `id`=:id";

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
}