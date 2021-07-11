<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/chat.php');
require_once __DIR__.('/article_purchase.php');
require_once __DIR__.('/info_purchase.php');
require_once __DIR__.('/../models/purchase_model.php');

class Purchase extends Connection{
    public function insert_purchase($object){
        $infoPurchaseConnection = new Info_purchase();
        $result = $infoPurchaseConnection->insert_info_purchase($object->info);

        if(gettype($result) == "void") return array(false);
        if(count($result) <= 0) return array(false);

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
        $resultado->bindParam(':info_purchase_id', $result[0], PDO::PARAM_INT);
        $re=$resultado->execute();
        if (!$re) 
        {
         //die(mysql_error());
        } else{
          $re = $this->pdo->lastInsertId();
          $this->pdo = null;

          // Insert articles
          if(gettype($object->articles) == "array"){
                foreach($object->articles as $article){
                    $article->purchase_id = $re;
                    $articlesPurchaseConnection = new Article_purchase();
                    $result = $articlesPurchaseConnection->insert_article_purchase($article);
                }
          }

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
        $sql="SELECT purchase.*, profile.name as profile_name, profile.last_name as profile_last_name 
        FROM `purchase`
        LEFT JOIN profile ON purchase.profile_id = profile.id";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $haveWHERE = false;
        // Check for id
        if(!is_null($object) && isset($object->id)){
            $sql = $sql." WHERE purchase.id=:id";
            $haveWHERE = true;
        }
        // Check for profile_id
        if(!is_null($object) && isset($object->profile_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."purchase.profile_id=:profile_id";
            $haveWHERE = true;
        }
        // Check for profile_id
        if(!is_null($object) && isset($object->chat_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."purchase.chat_id=:chat_id";
            $haveWHERE = true;
        }
        // Check for id_list (ID LIST WILL BE A LIST WITH ID's TO GET)
        if(!is_null($object) && isset($object->id_list)){
            if(gettype($object->id_list) == "array"){
                $sql = $sql.($haveWHERE? " AND " : " WHERE ");
                for($i = 0; $i < count($object->id_list); $i++){
                    $sql = $sql."purchase.id=:each_id".$i;
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
            if(isset($object->profile_id)){
              $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
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
            $lista_purchase = array();
            for($i = 0; $i < count($data); $i++){
                $purchase =new Purchase_model();
                $purchase->id=$data[$i]["id"];
                $purchase->total=$data[$i]["total"];
                $purchase->creation_date=$data[$i]["creation_date"];
                $purchase->profile_id=$data[$i]["profile_id"];
                $purchase->info_purchase_id=$data[$i]["info_purchase_id"];
                $purchase->profile_name=$data[$i]["profile_name"]." ".$data[$i]["profile_last_name"];

                $infoPurchaseIdObject = json_decode(json_encode(array("id" => $purchase->info_purchase_id)));
                $infoPurchaseConnection = new Info_purchase();
                $info = $infoPurchaseConnection->select_info_purchase($infoPurchaseIdObject);
                $purchase->info_purchase = count($info) > 0? $info[0] : null;

                array_push($lista_purchase, $purchase);
            }

            $idList = array_map(function($val){
                return $val->id;
            }, $lista_purchase);

            $purchaseIdObject = json_decode(json_encode(array("id_list" => $idList)));
            $articlesPurchaseConnection = new Article_purchase();
            $articles = $articlesPurchaseConnection->select_article_purchase($purchaseIdObject);
            
            foreach($lista_purchase as $purchase){
                $foundArticlesPurchases = array_filter($articles, function($val) use (&$purchase){
                    return $purchase->id == $val->purchase_id;
                });
                
                $purchase->articles = array_values($foundArticlesPurchases) ?? null;
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