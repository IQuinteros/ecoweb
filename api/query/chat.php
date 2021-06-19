<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/chat_model.php');

class Chat extends Connection{
    public function insert_chat($object){
        $this->connection_hosting();
        $sql="INSERT INTO `chat` (`id`, `creation_date`, `closed`, `last_seen_date`, `profile_id`, `store_id`, `purchase_id`) 
        VALUES (NULL, CURRENT_TIME(), false, CURRENT_TIME(), :profile_id, :store_id, :purchase_id);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
        $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
        $resultado->bindParam(':purchase_id', $object->purchase_id, PDO::PARAM_INT);
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
    public function update_chat_closed($id){
        $this->connection_hosting();
        $sql="UPDATE `chat` SET `closed`=true WHERE `id`=:id";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        try{
            $resultado=$this->pdo->prepare($sql);
            $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
            $re=$resultado->execute();
            $this->pdo = null;
            return $re;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
    public function update_chat_date($id){
        $this->connection_hosting();
        $sql="UPDATE `chat` SET `last_seen_date`=CURRENT_TIME() WHERE `id`=:id";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        try{
            $resultado=$this->pdo->prepare($sql);
            $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
            $re=$resultado->execute();
            $this->pdo = null;
            return $re;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
    public function select_chat($object){
        $this->connection_hosting();
        $sql="SELECT * FROM `chat`";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $haveWHERE = false;
        // Check for id
        if(!is_null($object) && isset($object->id)){
            $sql = $sql." WHERE id=:id";
            $haveWHERE = true;
        }
        // Check for closed
        if(!is_null($object) && isset($object->closed)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."closed=:closed";
            $haveWHERE = true;
        }
        // Check for id_profile
        if(!is_null($object) && isset($object->profile_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."profile_id=:profile_id";
            $haveWHERE = true;
        }
        // Check for id_store
        if(!is_null($object) && isset($object->store_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."store_id=:store_id";
            $haveWHERE = true;
        }
        // Check for id_purchase
        if(!is_null($object) && isset($object->purchase_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."purchase_id=:purchase_id";
            $haveWHERE = true;
        }
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->id)){
                $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
            }
            if(isset($object->closed)){
              $resultado->bindParam(':closed', $object->closed, PDO::PARAM_INT);
            }
            if(isset($object->profile_id)){
                $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
            }
            if(isset($object->store_id)){
              $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
            }
            if(isset($object->purchase_id)){
                $resultado->bindParam(':purchase_id', $object->purchase_id, PDO::PARAM_INT);
              }
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_chat = array();
            for($i = 0; $i < count($data); $i++){
                $chat =new Chat_model();
                $chat->id=$data[$i]["id"];
                $chat->creation_date=$data[$i]["creation_date"];
                $chat->closed=$data[$i]["closed"];
                $chat->last_seen_date=$data[$i]["last_seen_date"];
                $chat->profile_id=$data[$i]["profile_id"];
                $chat->store_id=$data[$i]["store_id"];
                $chat->purchase_id=$data[$i]["purchase_id"];
                array_push($lista_chat, $chat);
            }
        
            $this->pdo = null;
              
            return $lista_chat;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
}