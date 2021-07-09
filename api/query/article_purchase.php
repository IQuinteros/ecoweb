<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/article.php');
require_once __DIR__.('/store.php');
require_once __DIR__.('/../models/article_purchase_model.php');

class Article_purchase extends Connection{
    public function insert_article_purchase($object){
        $this->connection_hosting();
        $sql="INSERT INTO `article_purchase` (`id`, `purchase_id`, `article_id`, `title`, `unit_price`, 
        `quantity`, `photo_url`, `recycled_mats`, `recycled_mats_detail`, `reuse_tips`, `recycled_prod`, 
        `recycled_prod_detail`, `general_detail`, `store_id`) 
        VALUES (NULL, :purchase_id, :article_id, :title, :unit_price, :quantity, :photo_url, :recycled_mats, 
        :recycled_mats_detail, :reuse_tips, :recycled_prod, :recycled_prod_detail, :general_detail, :store_id);";
        try{
            $resultado=$this->pdo->prepare($sql);
            $resultado->bindParam(':purchase_id', $object->purchase_id, PDO::PARAM_INT);
            $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
            $resultado->bindParam(':title', $object->title, PDO::PARAM_STR);
            $resultado->bindParam(':unit_price', $object->unit_price, PDO::PARAM_INT);
            $resultado->bindParam(':quantity', $object->quantity, PDO::PARAM_INT);
            if(isset($object->photo_url)){
                $resultado->bindParam(':photo_url', $object->photo_url, PDO::PARAM_STR);
            }else{
                $resultado->bindParam(':photo_url', null, PDO::PARAM_NULL);
            }

            $resultado->bindParam(':recycled_mats', $object->recycled_mats, PDO::PARAM_STR);

            if(isset($object->recycled_mats_detail)){
                $resultado->bindParam(':recycled_mats_detail', $object->recycled_mats_detail, PDO::PARAM_STR);
            }else{
                $resultado->bindParam(':recycled_mats_detail', null, PDO::PARAM_NULL);
            }
            if(isset($object->reuse_tips)){
                $resultado->bindParam(':reuse_tips', $object->reuse_tips, PDO::PARAM_STR);
            }else{
                $resultado->bindParam(':reuse_tips', null, PDO::PARAM_NULL);
            }

            $resultado->bindParam(':recycled_prod', $object->recycled_prod, PDO::PARAM_STR);

            if(isset($object->recycled_prod_detail)){
                $resultado->bindParam(':recycled_prod_detail', $object->recycled_prod_detail, PDO::PARAM_STR);
            }else{
                $resultado->bindParam(':recycled_prod_detail', null, PDO::PARAM_NULL);
            }

            $resultado->bindParam(':general_detail', $object->general_detail, PDO::PARAM_STR);

            if(isset($object->store_id)){
                $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
            }else{
                $resultado->bindParam(':store_id', null, PDO::PARAM_NULL);
            }
            $re=$resultado->execute();
            if (!$re) 
            {
                //die(mysql_error());
                
            } else{
                $re = $this->pdo->lastInsertId();

                $articleConnection = new Article();
                $articleConnection->update_article_stock($object->article_id, $object->quantity);

                $this->pdo = null;
                return array($re);
            }
        } catch(Exception $e){}
    }
    public function delete_article_purchase($id){
        $this->connection_hosting();
        $sql="DELETE FROM `article_purchase` WHERE id=:id;";
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
    public function select_article_purchase($object){
        $this->connection_hosting();
        $sql="SELECT * FROM `article_purchase`";
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
        // Check for purchase_id
        if(!is_null($object) && isset($object->purchase_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."purchase_id=:purchase_id";
            $haveWHERE = true;
        }
        // Check for article_id
        if(!is_null($object) && isset($object->article_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article_id=:article_id";
            $haveWHERE = true;
        }
        // Check for store_id
        if(!is_null($object) && isset($object->store_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."store_id=:store_id";
            $haveWHERE = true;
        }
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->id)){
                $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
            }
            if(isset($object->purchase_id)){
                $resultado->bindParam(':purchase_id', $object->purchase_id, PDO::PARAM_INT);
              }
            if(isset($object->article_id)){
              $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
            }
            if(isset($object->store_id)){
                $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
            }
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_a_purchase = array();
            for($i = 0; $i < count($data); $i++){
                $article_p =new Article_purchase_model();
                $article_p->id=$data[$i]["id"];
                $article_p->purchase_id=$data[$i]["purchase_id"];
                $article_p->article_id=$data[$i]["article_id"];
                $article_p->title=$data[$i]["title"];
                $article_p->unit_price=$data[$i]["unit_price"];
                $article_p->quantity=$data[$i]["quantity"];
                $article_p->photo_url=$data[$i]["photo_url"];
                $article_p->recycled_mats=$data[$i]["recycled_mats"];
                $article_p->recycled_mats_detail=$data[$i]["recycled_mats_detail"];
                $article_p->reuse_tips=$data[$i]["reuse_tips"];
                $article_p->recycled_prod=$data[$i]["recycled_prod"];
                $article_p->recycled_prod_detail=$data[$i]["recycled_prod_detail"];
                $article_p->general_detail=$data[$i]["general_detail"];
                $article_p->store_id=$data[$i]["store_id"];

                $articleIdObject = json_decode(json_encode(array("id" => $article_p->article_id)));
                $articleConnection = new Article();
                $articles = $articleConnection->select_article($articleIdObject);
                $article_p->article = count($articles) > 0? $articles[0] : null;

                $storeIdObject = json_decode(json_encode(array("id" => $article_p->store_id)));
                $storeConnection = new Store();
                $stores = $storeConnection->select_store($storeIdObject);
                $article_p->store = count($stores) > 0? $stores[0] : null;
                
                array_push($lista_a_purchase, $article_p);
            }
        
            $this->pdo = null;
              
            return $lista_a_purchase;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
    public function report_most_selled($object){
        $this->connection_hosting();
        $sql="SELECT COUNT(`article_id`) AS `contador`, `article_id` FROM `article_purchase`";

        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $haveWHERE = false;
        if(!is_null($object) && isset($object->store_id)){
            $sql = $sql." WHERE `store_id`=:store_id";
            $haveWHERE = true;
        }
        $sql=$sql." GROUP BY `article_id` ORDER BY `contador` DESC";
        $sql=$sql.";";
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->store_id)){
                $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
            }
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_a_purchase = array();
            for($i = 0; $i < count($data); $i++){
                $array = array();
                $array["contador"]=$data[$i]["contador"];
                $array["article_id"]=$data[$i]["article_id"];
                array_push($lista_a_purchase, $array);
            }

            $articleIdObject = json_decode(json_encode(array("id_list" => array_map(function($value){
                return $value["article_id"];
            }, $lista_a_purchase))));
            $articleConnection = new Article();
            $articles = $articleConnection->select_article($articleIdObject);

            $lastResult = array();
            foreach($lista_a_purchase as $eachItem){
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
    public function report_sells_by_months($object){
        $this->connection_hosting();
        $sql="SELECT DISTINCT COUNT(purchase_id) AS `contador`, MONTH(purchase.creation_date) as MONTH, 
        YEAR(purchase.creation_date) as YEAR FROM `article_purchase` 
        INNER JOIN purchase ON article_purchase.`purchase_id`= purchase.`id` 
        INNER JOIN article ON article_purchase.`article_id`= article.`id` 
        WHERE article.`store_id` =:store_id AND purchase.`creation_date` 
        BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL - 6 MONTH) AND CURRENT_TIME() 
        GROUP BY YEAR(purchase.creation_date), MONTH(purchase.creation_date)";
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->store_id)){
                $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
            }
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_a_purchase = array();
            for($i = 0; $i < count($data); $i++){
                $array = array();
                $array["contador"]=$data[$i]["contador"];
                $array["month"]=$data[$i]["MONTH"];
                $array["year"]=$data[$i]["YEAR"];
                array_push($lista_a_purchase, $array);
            }
        
            $this->pdo = null;
              
            return $lista_a_purchase;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
}