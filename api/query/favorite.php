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
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_favorite = array();
            for($i = 0; $i < count($data); $i++){
                $favorite =new Favorite_model();
                $favorite->id=$data[$i]["id"];
                $favorite->creation_date=$data[$i]["creation_date"];
                $favorite->profile_id=$data[$i]["profile_id"];
                $favorite->article_id=$data[$i]["article_id"];

                $articleIdObject = json_decode(json_encode(array("id" => $favorite->article_id)));
                $articleConnection = new Article();
                $articles = $articleConnection->select_article($articleIdObject);
                $favorite->article = count($articles) > 0? $articles[0] : null;;

                array_push($lista_favorite, $favorite);
            }
        
            $this->pdo = null;
              
            return $lista_favorite;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
}