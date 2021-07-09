<?php
require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/history_detail_model.php');
class History_detail extends Connection{
    public function insert_history_detail($object){
        $this->connection_hosting();
        $sql="INSERT INTO `history_detail` (`id`, `creation_date`, `history_id`) 
        VALUES (NULL, CURRENT_TIME(), :history_id);";
        try{
            $resultado=$this->pdo->prepare($sql);
            $resultado->bindParam(':history_id', $object->history_id, PDO::PARAM_INT);
            $re=$resultado->execute();
            $re = $this->pdo->lastInsertId();
            $this->pdo = null;
            return array($re);
         
           }catch(PDOException $e){
             echo $e->getMessage();
             return $e;
             die();
        }
    }
    public function select_history_detail($object){
        $this->connection_hosting();
        $sql="SELECT * FROM `history_detail`";
        $haveWHERE = false;

        // Check for id
        if(!is_null($object) && isset($object->id)){
          $sql = $sql." WHERE id=:id";
          $haveWHERE = true;
        }
        // Check for history_id
        if(!is_null($object) && isset($object->history_id)){
        $sql = $sql.($haveWHERE? " AND " : " WHERE ")."history_id=:history_id";
        }
        $sql = $sql.";";
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->id)){
              $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
            }
            if(isset($object->name)){
              $resultado->bindParam(':history_id', $object->history_id, PDO::PARAM_INT);
            }
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_history_d = array();
      
            for($i = 0; $i < count($data); $i++){
              $detail_h =new History_detail_model();
              $detail_h->id=$data[$i]["id"];
              $detail_h->creation_date=$data[$i]["creation_date"];
              $detail_h->history_id=$data[$i]["history_id"];
              array_push($lista_history_d, $detail_h);
            }
      
            $this->pdo = null;
            
            return $lista_history_d;
          
        } catch(PDOException $e){
              echo $e->getMessage();
              return $e;
              die();
        }
    }
    public function report_most_visualized($object){
      $this->connection_hosting();
      $sql="SELECT COUNT(`history_id`) AS `contador`, history.`article_id` FROM `history_detail` 
      INNER JOIN history ON history_detail.`history_id`=history.`id` 
      INNER JOIN article ON history.`article_id` = article.`id` WHERE article.`store_id`=:store_id 
      GROUP BY history.`article_id` ORDER BY `contador` DESC";
       try{
        $resultado=$this->pdo->prepare($sql);
        if(isset($object->store_id)){
          $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
        }
        $re=$resultado->excecute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $lista_history_d = array();
        
        for($i = 0; $i < count($data); $i++){
          $array= array();
          $array["contador"]=$data[$i]["contador"];
          $array["article_id"]=$data[$i]["article_id"];
          array_push($lista_history_d, $array);
        }
  
        $this->pdo = null;
        
        return $lista_history_d;
      }catch(PDOException $e){
        echo $e->getMessage();
        return $e;
        die();
      }
    }
}