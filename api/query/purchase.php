<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/chat.php');
require_once __DIR__.('/article_purchase.php');
require_once __DIR__.('/info_purchase.php');
require_once __DIR__.('/../models/purchase_model.php');

class Purchase extends Connection{
    public function insert_purchase($object){
        $this->connection_hosting();
        $sql="INSERT INTO `purchase` (`id`, `total`, `creation_date`, `profile_id`, `info_purchase_id`) 
        VALUES (NULL, :total, CURRENT_TIME(), :profile_id, :info_purchase_id);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':total', $object->total, PDO::PARAM_INT);
        $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
        $resultado->bindParam(':info_purchase_id', $object->info_purchase_id, PDO::PARAM_INT);
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
    public function delete_purchase($id){
        $this->connection_hosting();
        $sql="DELETE FROM `purchase` WHERE id=:id;";
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
    public function select_purchase($object){
        $this->connection_hosting();
        $sql="SELECT * FROM `purchase`";
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
        // Check for profile_id
        if(!is_null($object) && isset($object->profile_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."profile_id=:profile_id";
            $haveWHERE = true;
        }
        // Check for profile_id
        if(!is_null($object) && isset($object->chat_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."chat_id=:chat_id";
            $haveWHERE = true;
        }
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->id)){
                $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
            }
            if(isset($object->profile_id)){
              $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
            }
            if(isset($object->chat_id)){
              $resultado->bindParam(':chat_id', $object->chat_id, PDO::PARAM_INT);
            }
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_purchase = array();
            for($i = 0; $i < count($data); $i++){
                $purchase =new Purchase_model();
                $purchase->id=$data[$i]["id"];
                $purchase->total=$data[$i]["total"];
                $purchase->creation_date=$data[$i]["creation_date"];
                $purchase->profile_id=$data[$i]["profile_id"];
                $purchase->info_purchase_id=$data[$i]["info_purchase_id"];

                $chatIdObject = json_decode(json_encode(array("id" => $purchase->chat_id ?? 0)));
                $chatConnection = new Chat();
                $chats = $chatConnection->select_chat($chatIdObject);
                $purchase->chat = count($chats) > 0? $chats[0] : null;

                $infoPurchaseIdObject = json_decode(json_encode(array("id" => $purchase->info_purchase_id)));
                $infoPurchaseConnection = new Info_purchase();
                $info = $infoPurchaseConnection->select_info_purchase($infoPurchaseIdObject);
                $purchase->info_purchase = count($info) > 0? $info[0] : null;

                $purchaseIdObject = json_decode(json_encode(array("purchase_id" => $purchase->id)));
                $articlesPurchaseConnection = new Article_purchase();
                $articles = $articlesPurchaseConnection->select_article_purchase($purchaseIdObject);
                $purchase->articles = $articles;

                array_push($lista_purchase, $purchase);
            }
        
            $this->pdo = null;
              
            return $lista_purchase;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
}