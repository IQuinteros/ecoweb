<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/history_model.php');

class History extends Connection{
    public function insert_history($object){
        $this->connection_hosting();
        $sql="INSERT INTO `history` (`id`, `creation_date`, `deleted`, `article_id`, `user_id`) 
        VALUES (NULL, CURRENT_TIME(), false, :article_id, :user_id);";
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
    public function select_history($object){
        $this->connection_hosting();
        $sql="SELECT * FROM `history`";
        $haveWHERE = false;

         // Check for id
        if(!is_null($object) && isset($object->article_id)){
          $sql = $sql." WHERE article_id=:article_id";
          $haveWHERE = true;
        }
         // Check for user id
        if(!is_null($object) && isset($object->user_id)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."user_id=:user_id";
          $haveWHERE = true;
        }
         // Check for deleted
         if(!is_null($object) && isset($object->deleted)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."deleted=:deleted";
            $haveWHERE = true;
        }

        // TODO: return articles by id

        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->article_id)){
              $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
            }
            if(isset($object->user_id)){
              $resultado->bindParam(':user_id', $object->user_id, PDO::PARAM_INT);
            }
            if(isset($object->deleted)){
              $resultado->bindParam(':deleted', $object->deleted, PDO::PARAM_BOOL);
            }
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_history = array();
      
            for($i = 0; $i < count($data); $i++){
              $history =new History_model();
              $history->id=$data[$i]["id"];
              $history->creation_date=$data[$i]["creation_date"];
              $history->deleted=$data[$i]["deleted"];
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
   public function history_update_deleted($object){
    $this->connection_hosting();
    $sql="UPDATE `history` SET `deleted`= :deleted WHERE `article_id`=:article_id AND `user_id`=:user_id";
    try{
       $resultado=$this->pdo->prepare($sql);
       $resultado->bindParam(':deleted', $object->deleted, PDO::PARAM_BOOL);
      $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
      $resultado->bindParam(':user_id', $object->user_id, PDO::PARAM_INT);
      $re=$resultado->execute();
       $this->pdo = null;
       return array($re);
   
     }catch(PDOException $e){
       echo $e->getMessage();
       return $e;
       die();
     }
   }
   public function report_most_visited($object){
    $this->connection_hosting();
    $sql="SELECT COUNT(`article_id`) AS `contador`, `article_id` FROM `history` 
    INNER JOIN article ON history.`article_id` = article.`id` WHERE article.`store_id` =:store_id 
    GROUP BY `article_id` ORDER BY `contador` DESC LIMIT 4";
    try{
      $resultado=$this->pdo->prepare($sql);
      if(isset($object->store_id)){
        $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
      }
      $re=$resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      $lista_history = array();
      
      for($i = 0; $i < count($data); $i++){
        $array= array();
        $array["contador"]=$data[$i]["contador"];
        $array["article_id"]=$data[$i]["article_id"];
        array_push($lista_history, $array);
      }

      $articleIdObject = json_decode(json_encode(array("id_list" => array_map(function($value){
        return $value["article_id"];
      }, $lista_history))));
      $articleConnection = new Article();
      $articles = $articleConnection->select_article($articleIdObject);

      $lastResult = array();
      foreach($lista_history as $eachItem){
          foreach($articles as $eachArticle){
              if($eachItem["article_id"] == $eachArticle->id){
                  $eachItem["article"] = $eachArticle;
              }
          }
          array_push($lastResult, $eachItem);
      }

      $this->pdo = null;
      
      return $lastResult;
    }catch(PDOException $e){
      echo $e->getMessage();
      return $e;
      die();
    }
  }
}