<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/opinion_model.php');

class Opinion extends Connection{
    public function insert_opinion($object){
        $this->connection_hosting();
        $sql="INSERT INTO `opinion` (`id`, `rating`, `title`, `content`, `creation_date`, `article_id`, `profile_id`) 
        VALUES (NULL, :rating, :title, :content, CURRENT_TIME(), :article_id, :profile_id);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':rating', $object->rating, PDO::PARAM_INT);
        $resultado->bindParam(':title', $object->title, PDO::PARAM_STR);
        $resultado->bindParam(':content', $object->content, PDO::PARAM_STR);
        $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
        $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
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
    public function delete_opinion($id){
        $this->connection_hosting();
        $sql="DELETE FROM `opinion` WHERE `id`=:id";
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
    public function select_opinion($object){
        $this->connection_hosting();
        $sql="SELECT opinion.*, store.public_name FROM `opinion` INNER JOIN article ON opinion.article_id = article.id INNER JOIN store ON article.store_id = store.id";
        $haveWHERE = false;

        // Check for id
       if(!is_null($object) && isset($object->id)){
         $sql = $sql." WHERE id=:id";
         $haveWHERE = true;
       }
        // Check for id_article
       if(!is_null($object) && isset($object->article_id)){
         $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article_id=:article_id";
         $haveWHERE = true;
       }

       // Check for store_id
       if(!is_null($object) && isset($object->store_id)){
        $sql = $sql.($haveWHERE? " AND " : " WHERE ")."store.id=:store_id";
        $haveWHERE = true;
      }

      // Check for profile_id
       if(!is_null($object) && isset($object->profile_id)){
        $sql = $sql.($haveWHERE? " AND " : " WHERE ")."opinion.profile_id=:profile_id";
        $haveWHERE = true;
      }

      $sql = $sql." ORDER BY opinion.creation_date DESC";

       try{
        $resultado=$this->pdo->prepare($sql);
        if(isset($object->id)){
            $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
          }
        if(isset($object->article_id)){
          $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
        }
        if(isset($object->store_id)){
          $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
        }
        if(isset($object->profile_id)){
          $resultado->bindParam(':profile_id', $object->profile_id, PDO::PARAM_INT);
        }
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $lista_opinion = array();
  
        for($i = 0; $i < count($data); $i++){
          $opinion =new Opinion_model();
          $opinion->id=$data[$i]["id"];
          $opinion->rating=$data[$i]["rating"];
          $opinion->title=$data[$i]["title"];
          $opinion->content=$data[$i]["content"];
          $opinion->creation_date=$data[$i]["creation_date"];
          $opinion->article_id=$data[$i]["article_id"];
          $opinion->profile_id=$data[$i]["profile_id"];
          array_push($lista_opinion, $opinion);
        }
  
        $this->pdo = null;
        
        return $lista_opinion;
      
        } catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
    }
}
