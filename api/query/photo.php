<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/photo_model.php');

class Photo extends Connection{
    public function insert_photo($object){
        $this->connection_hosting();
        $sql="INSERT INTO `photo` (`id`, `photo`, `article_id`) 
        VALUES (NULL, :photo, :article_id);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':photo', $object->photo, PDO::PARAM_STR);
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
    public function delete_photo($id){
        $this->connection_hosting();
        $sql="DELETE FROM `photo` WHERE id=:id;";
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
    public function select_photo($object){
        $this->connection_hosting();
        $sql="SELECT * FROM `photo`";
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
            if(isset($object->article_id)){
              $resultado->bindParam(':article_id', $object->article_id, PDO::PARAM_INT);
            }
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_photo = array();
            for($i = 0; $i < count($data); $i++){
                $photos =new Photo_model();
                $photos->id=$data[$i]["id"];
                $photos->photo=$data[$i]["photo"];
                $photos->article_id=$data[$i]["article_id"];
                array_push($lista_photo, $photos);
            }
        
            $this->pdo = null;
              
            return $lista_photo;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
}