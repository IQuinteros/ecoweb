<?php
require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/article_form_model.php');
class Article_form extends Connection{
    public function insert_article_form($object){
        $this->connection_hosting();
        $sql="INSERT INTO `article_form` (`id`, `creation_date`, `last_update_date`, `recycled_mats`, 
        `recycled_mats_detail`, `general_detail`, `reuse_tips`, `recycled_prod`, `recycled_prod_detail`) 
        VALUES (NULL, CURRENT_TIME(), CURRENT_TIME(), :recycled_mats, :recycled_mats_detail, :general_detail, 
        :reuse_tips, :recycled_prod, :recycled_prod_detail);";
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->recycled_mats)){
               $resultado->bindParam(':recycled_mats', $object->recycled_mats, PDO::PARAM_STR);
            }else{
               $resultado->bindValue(':recycled_mats', null, PDO::PARAM_NULL);
            }
            if(isset($object->recycled_mats_detail)){
               $resultado->bindParam(':recycled_mats_detail', $object->recycled_mats_detail, PDO::PARAM_STR);
            }else{
               $resultado->bindValue(':recycled_mats_detail', null, PDO::PARAM_NULL);
            }
            if(isset($object->general_detail)){
                $resultado->bindParam(':general_detail', $object->general_detail, PDO::PARAM_STR);
             }else{
                $resultado->bindValue(':general_detail', null, PDO::PARAM_NULL);
             }
             if(isset($object->reuse_tips)){
                $resultado->bindParam(':reuse_tips', $object->reuse_tips, PDO::PARAM_STR);
             }else{
                $resultado->bindValue(':reuse_tips', null, PDO::PARAM_NULL);
             }
             $resultado->bindParam(':recycled_prod', $object->recycled_prod, PDO::PARAM_STR);
             if(isset($object->recycled_prod_detail)){
                $resultado->bindParam(':recycled_prod_detail', $object->recycled_prod_detail, PDO::PARAM_STR);
             }else{
                $resultado->bindValue(':recycled_prod_detail', null, PDO::PARAM_NULL);
             }
            $re=$resultado->execute();
            $re = $this->pdo->lastInsertId();
            $this->pdo = null;
            return array($re);

         
           }catch(PDOException $e){
             echo $e->getMessage();
             return $e;
             die();
           }
    }
    public function delete_article_form($id){
        $this->connection_hosting();
        $sql="DELETE FROM `article_form` WHERE `id`=:id";
        try{
            $resultado=$this->pdo->prepare($sql);
              $resultado->bindParam(':id', $id, PDO::PARAM_INT);
              $re=$resultado->execute();
              $this->pdo = null;
              return $re;
    
          
            }catch(PDOException $e){
              echo $e->getMessage();
              return $e;
              die();
         }
    }
    public function update_article_form($object){
        $this->connection_hosting();
        $sql="UPDATE `article_form` SET `last_update_date` = CURRENT_TIME(), 
        `recycled_mats` = :recycled_mats, `recycled_mats_detail` = :recycled_mats_detail, `general_detail` = :general_detail, 
        `reuse_tips` = :reuse_tips, `recycled_prod` = :recycled_prod, `recycled_prod_detail` = :recycled_prod_detail 
        WHERE `article_form`.`id` = :id;";
        try{
            $resultado=$this->pdo->prepare($sql);
            $resultado->bindParam(':recycled_mats', $object->recycled_mats, PDO::PARAM_STR);
            if(isset($object->recycled_mats_detail)){
               $resultado->bindParam(':recycled_mats_detail', $object->recycled_mats_detail, PDO::PARAM_STR);
            }else{
               $resultado->bindParam(':recycled_mats_detail', null, PDO::PARAM_NULL);
            }
            if(isset($object->general_detail)){
                $resultado->bindParam(':general_detail', $object->general_detail, PDO::PARAM_STR);
             }else{
                $resultado->bindParam(':general_detail', null, PDO::PARAM_NULL);
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
    public function select_article_form($object){
        $this->connection_hosting();
        $sql="SELECT * FROM `article_form`";
        $haveWHERE = false;

        // Check for id
        if(!is_null($object) && isset($object->id)){
          $sql = $sql." WHERE id=:id";
          $haveWHERE = true;
        }
        $sql = $sql.";";
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->id)){
              $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
            }
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_articles_form = array();
      
            for($i = 0; $i < count($data); $i++){
              $articles_form =new Article_form_model();
              $articles_form->id=$data[$i]["id"];
              $articles_form->creation_date=$data[$i]["creation_date"];
              $articles_form->last_update_date=$data[$i]["last_update_date"];
              $articles_form->recycled_mats=$data[$i]["recycled_mats"];
              $articles_form->recycled_mats_detail=$data[$i]["recycled_mats_detail"];
              $articles_form->general_detail=$data[$i]["general_detail"];
              $articles_form->reuse_tips=$data[$i]["reuse_tips"];
              $articles_form->recycled_prod=$data[$i]["recycled_prod"];
              $articles_form->recycled_prod_detail=$data[$i]["recycled_prod_detail"];
              array_push($lista_articles_form, $articles_form);
            }
      
            $this->pdo = null;
            
            return $lista_articles_form;
          
            } catch(PDOException $e){
              echo $e->getMessage();
              return $e;
              die();
        }
    }
}