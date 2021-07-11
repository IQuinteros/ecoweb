<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/article.php');
require_once __DIR__.('/../models/favorite_model.php');

class Favorite extends Connection{
    public function insert_favorite($object){
        $this->connection_hosting();
        $sql="INSERT INTO `favorite` (`id`, `creation_date`, `profile_id`, `article_id`) 
        VALUES (NULL, CURRENT_TIME(), :profile_id, :article_id);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_STR);
        $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
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
    public function delete_favorite($object){
        $this->connection_hosting();
        $sql="DELETE FROM `favorite` WHERE article_id=:article_id AND profile_id=:profile_id;";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }

        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
        $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
        $re=$resultado->execute();
        if (!$re) {
            //die(mysql_error());
        } else{
            $this->pdo = null;
            return array($re);
        }
    }
    public function select_favorite($object){
        $this->connection_hosting();
        $sql="SELECT * FROM `favorite`";
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
        // Check for article_id
        if(!is_null($object) && isset($object->article_id)){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article_id=:article_id";
            $haveWHERE = true;
        }
        // Check for id_list (ID LIST WILL BE A LIST WITH ID's TO GET)
        if(!is_null($object) && isset($object->id_list)){
            if(gettype($object->id_list) == "array"){
                $sql = $sql.($haveWHERE? " AND " : " WHERE ");
                for($i = 0; $i < count($object->id_list); $i++){
                $sql = $sql."article_id=:each_id".$i;
                if($i < (count($object->id_list) - 1)){
                    $sql = $sql." OR ";
                }
                }
                $haveWHERE = true;
            }
        }
        // LIMIT
        $sql = $sql." LIMIT :initial_number,:quantity";
        
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->id)){
                $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
            }
            if(isset($object->profile_id)){
              $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
            }
            if(isset($object->article_id)){
                $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
            }
            if(isset($object->initial_number)){
                $resultado->bindParam(':initial_number', $object->initial_number, PDO::PARAM_INT);
            }else{
                $resultado->bindValue(':initial_number', 0, PDO::PARAM_INT);
            }
            if(isset($object->quantity)){
                $resultado->bindParam(':quantity', $object->quantity, PDO::PARAM_INT);
            }else{
                $resultado->bindValue(':quantity', 20, PDO::PARAM_INT);
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
            $lista_favorite = array();
            for($i = 0; $i < count($data); $i++){
                $favorite =new Favorite_model();
                $favorite->id=$data[$i]["id"];
                $favorite->creation_date=$data[$i]["creation_date"];
                $favorite->profile_id=$data[$i]["profile_id"];
                $favorite->article_id=$data[$i]["article_id"];

                array_push($lista_favorite, $favorite);
            }

            $idList = array_map(function($val){
                return $val->article_id;
            }, $lista_favorite);

            $articleIdObject = json_decode(json_encode(array("id_list" => $idList)));

            $articleConnection = new Article();
            $articles = $articleConnection->select_article($articleIdObject);

            foreach($lista_favorite as $favorite){
                $foundArticles = array_filter($articles, function($val) use (&$favorite){
                    return $favorite->article_id == $val->id;
                });
                
                $favorite->article = count($foundArticles) > 0? end($foundArticles) : null;
            }
        
            $this->pdo = null;
              
            return $lista_favorite;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
    public function report_favorite($object){
        $this->connection_hosting();
        $sql="SELECT COUNT(`article_id`) AS `contador`, `article_id` FROM `favorite` 
        INNER JOIN article ON favorite.`article_id` = article.`id` 
        WHERE article.`store_id` =:store_id GROUP BY `article_id` ORDER BY `contador` DESC LIMIT 4";
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->store_id)){
              $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
            }
            $re=$resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_favorite = array();
            
            for($i = 0; $i < count($data); $i++){
              $array= array();
              $array["contador"]=$data[$i]["contador"];
              $array["article_id"]=$data[$i]["article_id"];
              array_push($lista_favorite, $array);
            }

            $articleIdObject = json_decode(json_encode(array("id_list" => array_map(function($value){
                return $value["article_id"];
            }, $lista_favorite))));
            $articleConnection = new Article();
            $articles = $articleConnection->select_article($articleIdObject);

            $lastResult = array();
            foreach($lista_favorite as $eachItem){
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