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
    public function select_article($object){
        $this->connection_hosting();
        $sql="SELECT article.`id`, article.`title`, article.`description`, article.`price`, article.`stock`, 
        article.`creation_date`, article.`last_update_date`, article.`enabled`, article.`article_form_id`, 
        article.`category_id`, article.`store_id`, article.`past_price`, category.`title` AS category_title, 
        article_form.`creation_date` AS from_creation_date, 
        article_form.`last_update_date` AS form_last_update_date, article_form.`recycled_mats`, 
        article_form.`recycled_mats_detail`, article_form.`general_detail`, article_form.`reuse_tips`, 
        article_form.`recycled_prod`, article_form.`recycled_prod_detail`, store.`public_name`, store.`location`, 
        store.`enabled`, store.`photo_url`,
        (SELECT district.`id` FROM store INNER JOIN district ON district_id  = district.`id`) AS district_id,
        (SELECT district.`name` FROM store INNER JOIN district ON district_id = district.`id`) AS district_name 
        FROM `article` 
        INNER JOIN category ON category_id= category.`id` 
        INNER JOIN article_form ON article_form_id = article_form.`id` 
        INNER JOIN store ON store_id = store.`id`";

        $haveWHERE = false;

        // Check for id
        if(!is_null($object) && isset($object->id)){
          $sql = $sql." WHERE id=:id";
          $haveWHERE = true;
        }
        // Check for id_article_form
        if(!is_null($object) && isset($object->id_form)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article_form_id=:article_form_id";
          $haveWHERE = true;
        }
        // Check for id_category
        if(!is_null($object) && isset($object->id_category)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."category_id=:category_id";
          $haveWHERE = true;
        }
        // Check for id_store
        if(!is_null($object) && isset($object->id_store)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."store_id=:store_id";
          $haveWHERE = true;
        }
        // Check for article_name
        if(!is_null($object) && isset($object->title)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."title LIKE :title";
          $haveWHERE = true;
        }
        // Check for category
        if(!is_null($object) && isset($object->category)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."category_name=:category";
          $haveWHERE = true;
        }
        // Check for store_name
        if(!is_null($object) && isset($object->store_name)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."public_name LIKE :store_name";
          $haveWHERE = true;
        }
        // Check for store_location
        if(!is_null($object) && isset($object->store_location)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."location=:store_location";
          $haveWHERE = true;
        }
        // Check for district_id
        if(!is_null($object) && isset($object->district_id)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."district_id=:district_id";
          $haveWHERE = true;
        }
        // Check for district_name
        if(!is_null($object) && isset($object->district_name)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."district_name LIKE :district_name";
          $haveWHERE = true;
        }
        // Check for store_enabled
        if(!is_null($object) && isset($object->store_enabled)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."enabled=:store_enabled";
          $haveWHERE = true;
        }
        // Check for price
        if(!is_null($object) && isset($object->min_price) && isset($object->max_price)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."price<:max_price AND price>:min_price";
          $haveWHERE = true;
        }
        // Check for search
        if(!is_null($object) && isset($object->search)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."title LIKE :title_s OR public_name LIKE :store_name_s OR category_name LIKE :category_s";
          $haveWHERE = true;
        } 

        $sql = $sql.";";

        try{
          $resultado=$this->pdo->prepare($sql);
          if(isset($object->id)){
            $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
          }
          if(isset($object->id_form)){
            $resultado->bindParam(':article_form_id', $object->id_form, PDO::PARAM_INT);
          }
          if(isset($object->id_category)){
            $resultado->bindParam(':category_id', $object->id_category, PDO::PARAM_INT);
          }
          if(isset($object->id_store)){
            $resultado->bindParam(':store_id', $object->id_store, PDO::PARAM_INT);
          }
          if(isset($object->title)){
            $resultado->bindParam(':title', '%'.$object->title.'%', PDO::PARAM_STR);
          }
          if(isset($object->category)){
            $resultado->bindParam(':category', $object->category, PDO::PARAM_STR);
          }
          if(isset($object->store_name)){
            $resultado->bindParam(':store_name', '%'.$object->store_name.'%', PDO::PARAM_STR);
          }
          if(isset($object->store_location)){
            $resultado->bindParam(':store_location', $object->store_location, PDO::PARAM_STR);
          }
          if(isset($object->district_id)){
            $resultado->bindParam(':district_id', $object->district_id, PDO::PARAM_INT);
          }
          if(isset($object->district_name)){
            $resultado->bindParam(':district_name', '%'.$object->district_name.'%', PDO::PARAM_STR);
          }
          if(isset($object->store_enabled)){
            $resultado->bindParam(':store_enabled', $object->store_enabled, PDO::PARAM_INT);
          }
          if(isset($object->min_price)){
            $resultado->bindParam(':min_price', $object->min_price, PDO::PARAM_INT);
          }
          if(isset($object->max_price)){
            $resultado->bindParam(':max_price', $object->max_price, PDO::PARAM_INT);
          }
          if(isset($object->search)){
            $resultado->bindParam(':title_s', '%'.$object->search.'%', PDO::PARAM_STR);
          }
          if(isset($object->search)){
            $resultado->bindParam(':store_name_s', '%'.$object->search.'%', PDO::PARAM_STR);
          }
          if(isset($object->search)){
            $resultado->bindParam(':category_s', '%'.$object->search.'%', PDO::PARAM_STR);
          }
          $resultado->execute();
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
          $lista_articles = array();
  
          for($i = 0; $i < count($data); $i++){
            $articles =new Article_model();
            $articles->id=$data[$i]["id"];
            $articles->title=$data[$i]["title"];
            $articles->description=$data[$i]["description"];
            $articles->price=$data[$i]["price"];
            $articles->stock=$data[$i]["stock"];
            $articles->creation_date=$data[$i]["creation_date"];
            $articles->last_update_date=$data[$i]["last_update_date"];
            $articles->enabled=$data[$i]["enabled"];
            $articles->article_form_id=$data[$i]["article_form_id"];
            $articles->category_id=$data[$i]["category_id"];
            $articles->store_id=$data[$i]["store_id"];
            $articles->past_price=$data[$i]["past_price"];
            $articles->category_title=$data[$i]["category_title"];
            $articles->from_creation_date=$data[$i]["from_creation_date"];
            $articles->form_last_update_date=$data[$i]["form_last_update_date"];
            $articles->recycled_mats=$data[$i]["recycled_mats"];
            $articles->recycled_mats_detail=$data[$i]["recycled_mats_detail"];
            $articles->general_detail=$data[$i]["general_detail"];
            $articles->reuse_tips=$data[$i]["reuse_tips"];
            $articles->recycled_prod=$data[$i]["recycled_prod"];
            $articles->recycled_prod_detail=$data[$i]["recycled_prod_detail"];
            $articles->public_name=$data[$i]["public_name"];
            $articles->location=$data[$i]["location"];
            $articles->enabled=$data[$i]["enabled"];
            $articles->photo_url=$data[$i]["photo_url"];
            $articles->district_id=$data[$i]["district_id"];
            $articles->district_name=$data[$i]["district_name"];
            array_push($lista_articles, $articles);
          }
  
          $this->pdo = null;
          
          return $lista_articles;
        
          } catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
          }
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