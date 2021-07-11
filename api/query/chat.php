<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/store.php');
require_once __DIR__.('/message.php');
require_once __DIR__.('/purchase.php');
require_once __DIR__.('/../models/chat_model.php');

class Chat extends Connection{
    public function insert_chat($object){
        $this->connection_hosting();
        $sql="INSERT INTO `chat` (`id`, `creation_date`, `closed`, `last_seen_date`, `store_id`, `purchase_id`) 
        VALUES (NULL, CURRENT_TIME(), false, CURRENT_TIME(), :store_id, :purchase_id);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
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
    public function update_chat_closed($object){
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
    public function update_chat_date($object){
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
            return array($re);
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
    public function select_chat($object){
        $this->connection_hosting();
        $sql="SELECT chat.*
        FROM `chat` 
        INNER JOIN purchase ON chat.purchase_id = purchase.id";
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
        // Check for profile id
        if(!is_null($object) && isset($object->profile_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."purchase.profile_id=:profile_id";
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
            if(isset($object->store_id)){
              $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
            }
            if(isset($object->purchase_id)){
                $resultado->bindParam(':purchase_id', $object->purchase_id, PDO::PARAM_INT);
            }
            if(isset($object->profile_id)){
                $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
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
                $chat->store_id=$data[$i]["store_id"];
                $chat->purchase_id=$data[$i]["purchase_id"];

                array_push($lista_chat, $chat);
            }

            $idList = array_map(function($val){
                return $val->purchase_id;
            }, $lista_chat);

            $storeIdList = array_map(function($val){
                return $val->store_id;
            }, $lista_chat);

            $chatIdList = array_map(function($val){
                return $val->id;
            }, $lista_chat);

            $purchaseIdObject = json_decode(json_encode(array("id_list" => $idList)));
            $storeIdObject = json_decode(json_encode(array("id_list" => $storeIdList)));
            $chatIdObject = json_decode(json_encode(array("id_list" => $chatIdList)));

            $purchaseConnection = new Purchase();
            $purchases = $purchaseConnection->select_purchase($purchaseIdObject);

            $storeConnection = new Store();
            $stores = $storeConnection->select_store($storeIdObject);

            $messagesConnection = new Message();
            $messages = $messagesConnection->select_message($chatIdObject);
            
            foreach($lista_chat as $chat){
                $foundPurchase = array_filter($purchases, function($val) use (&$chat){
                    return $chat->purchase_id == $val->id;
                });
                $foundStores = array_filter($stores, function($val) use (&$chat){
                    return $chat->store_id == $val->id;
                });
                $foundMessages = array_filter($messages, function($val) use (&$chat){
                    return $chat->id == $val->chat_id;
                });
                
                $chat->purchase = count($foundPurchase) > 0? end($foundPurchase) : null;
                $chat->store = count($foundStores) > 0? end($foundStores) : null;
                $chat->messages = array_values($foundMessages) ?? [];
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