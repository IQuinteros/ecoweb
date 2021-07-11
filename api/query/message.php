<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/message_model.php');

class Message extends Connection{
    public function insert_message($object, $fromStore = false){
        $this->connection_hosting();
        $sql="INSERT INTO `message` (`id`, `message`, `creation_date`, `chat_id`, `from_store`) 
        VALUES (NULL, :message, CURRENT_TIME(), :chat_id, :fromStore);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':message', $object->message, PDO::PARAM_STR);
        $resultado->bindParam(':chat_id', $object->chat_id, PDO::PARAM_INT);
        $resultado->bindParam(':fromStore', $fromStore, PDO::PARAM_BOOL);
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
    public function delete_message($id){
        $this->connection_hosting();
        $sql="DELETE FROM `message` WHERE id=:id;";
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
    public function select_message($object){
        $this->connection_hosting();
        $sql="SELECT * FROM `message`";
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
        // Check for chat_id
        if(!is_null($object) && isset($object->chat_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."chat_id=:chat_id";
            $haveWHERE = true;
        }
        // Check for id_list (ID LIST WILL BE A LIST WITH ID's TO GET)
        if(!is_null($object) && isset($object->id_list)){
            if(gettype($object->id_list) == "array"){
                $sql = $sql.($haveWHERE? " AND " : " WHERE ");
                for($i = 0; $i < count($object->id_list); $i++){
                    $sql = $sql."chat_id=:each_id".$i;
                    if($i < (count($object->id_list) - 1)){
                    $sql = $sql." OR ";
                    }
                }
                $haveWHERE = true;
            }
        }

        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->id)){
                $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
            }
            if(isset($object->chat_id)){
              $resultado->bindParam(':chat_id', $object->chat_id, PDO::PARAM_INT);
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
            $lista_message = array();
            for($i = 0; $i < count($data); $i++){
                $messages =new Message_model();
                $messages->id=$data[$i]["id"];
                $messages->message=$data[$i]["message"];
                $messages->creation_date=$data[$i]["creation_date"];
                $messages->chat_id=$data[$i]["chat_id"];
                $messages->from_store=$data[$i]["from_store"];
                array_push($lista_message, $messages);
            }
        
            $this->pdo = null;
              
            return $lista_message;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
}