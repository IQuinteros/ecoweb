<?php
require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/article_model.php');
class Article extends Connection{
    public function insert_article($object){
        $this->connection_hosting();
        $sql="INSERT INTO `article` (`id`, `title`, `description`, `price`, `stock`, `creation_date`, `last_update_date`, 
        `enabled`, `article_form_id`, `category_id`, `store_id`, `past_price`) 
        VALUES (NULL, :title, :description, :price, :stock, CURRENT_TIME(), CURRENT_TIME(), :enabled, 
        :article_form_id, :category_id, :store_id, :past_price);";
        try{
             $resultado=$this->pdo->prepare($sql);
             $resultado->bindParam(':title', $object->title, PDO::PARAM_STR);
             $resultado->bindParam(':description', $object->description, PDO::PARAM_STR);
             $resultado->bindParam(':price', $object->price, PDO::PARAM_INT);
             $resultado->bindParam(':stock', $object->stock, PDO::PARAM_INT);
             $resultado->bindParam(':enabled', $object->enabled, PDO::PARAM_INT);
             $resultado->bindParam(':article_form_id', $object->article_form_id, PDO::PARAM_INT);
             $resultado->bindParam(':category_id', $object->category_id, PDO::PARAM_INT);
             $resultado->bindParam(':store_id', $object->store_id, PDO::PARAM_INT);
             if(isset($object->past_price)){
                $resultado->bindParam(':past_price', $object->past_price, PDO::PARAM_INT);
             }else{
                $resultado->bindParam(':past_price', null, PDO::PARAM_NULL);
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
    public function delete_article($id){
        $this->connection_hosting();
        $sql="DELETE FROM `article` WHERE `id`=:id";
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
    public function select_article(){
        $this->connection_hosting();
        $sql="SELECT article.`id`, article.`title`, article.`description`, article.`price`, article.`stock`, 
        article.`creation_date`, article.`last_update_date`, article.`enabled`, article.`article_form_id`, 
        article.`category_id`, article.`store_id`, article.`past_price`, category.`title`, article_form.`creation_date`, 
        article_form.`last_update_date` AS form_last_update_date, article_form.`recycled_mats`, 
        article_form.`recycled_mats_detail`, article_form.`general_detail`, article_form.`reuse_tips`, 
        article_form.`recycled_prod`, article_form.`recycled_prod_detail`, store.`public_name`, store.`location`, 
        store.`enabled`, store.`photo_url`,
        (SELECT district.`name` FROM store INNER JOIN district ON district_id  = district.`id`) AS district_name 
        FROM `article` 
        INNER JOIN category ON category_id= category.`id` 
        INNER JOIN article_form ON article_form_id = article_form.`id` 
        INNER JOIN store ON store_id = store.`id`";
    }
    public function update_article($object){
        $this->connection_hosting();
        $sql="UPDATE `article` 
        SET `title`=:title,`description`=:description,`price`=:price,`stock`=:stock,`last_update_date`=CURRENT_TIME,
        `enabled`=:enabled,`category_id`=:category_id,`past_price`=:past_price WHERE `id`=:id";
        try{
          $resultado=$this->pdo->prepare($sql);
           $resultado->bindParam(':title', $object->title, PDO::PARAM_STR);
           $resultado->bindParam(':description', $object->description, PDO::PARAM_STR);
           $resultado->bindParam(':price', $object->price, PDO::PARAM_INT);
           $resultado->bindParam(':stock', $object->stock, PDO::PARAM_INT);
           $resultado->bindParam(':enabled', $object->enabled, PDO::PARAM_INT);
           $resultado->bindParam(':category_id', $object->category_id, PDO::PARAM_INT);
           $resultado->bindParam(':past_price', $object->past_price, PDO::PARAM_INT);
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
}