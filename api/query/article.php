<?php
require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/opinion.php');
require_once __DIR__.('/question.php');
require_once __DIR__.('/store.php');
require_once __DIR__.('/category.php');
require_once __DIR__.('/photo.php');
require_once __DIR__.('/favorite.php');
require_once __DIR__.('/article_form.php');
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
      // TODO: Colocar LIMIT
        $this->connection_hosting();
        $sql="SELECT article.`id`, article.`title`, article.`description`, article.`price`, article.`stock`, 
        article.`creation_date`, article.`last_update_date`, article.`enabled`, article.`article_form_id`, 
        article.`category_id`, article.`store_id`, article.`past_price`
        FROM `article` 
        INNER JOIN category ON article.`category_id` = category.`id` 
        INNER JOIN article_form ON article.`article_form_id` = article_form.`id` 
        INNER JOIN store ON article.`store_id` = store.`id`
        INNER JOIN district ON store.`district_id` = district.`id`";

        $haveWHERE = false;

        // Check for id
        if(!is_null($object) && isset($object->id)){
          $sql = $sql." WHERE article.id=:id";
          $haveWHERE = true;
        }
        // Check for id_article_form
        if(!is_null($object) && isset($object->id_form)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article.article_form_id=:article_form_id";
          $haveWHERE = true;
        }
        // Check for id_category
        if(!is_null($object) && isset($object->id_category)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article.category_id=:category_id";
          $haveWHERE = true;
        }
        // Check for id_store
        if(!is_null($object) && isset($object->id_store)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article.store_id=:store_id";
          $haveWHERE = true;
        }
        // Check for article_name
        if(!is_null($object) && isset($object->title)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article.title LIKE :title";
          $haveWHERE = true;
        }
        // Check for category
        if(!is_null($object) && isset($object->category)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."category.title=:category";
          $haveWHERE = true;
        }
        // Check for store_name
        if(!is_null($object) && isset($object->store_name)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."store.public_name LIKE :store_name";
          $haveWHERE = true;
        }
        // Check for store_location
        if(!is_null($object) && isset($object->store_location)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."store.location=:store_location";
          $haveWHERE = true;
        }
        // Check for district_id
        if(!is_null($object) && isset($object->district_id)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."store.district_id=:district_id";
          $haveWHERE = true;
        }
        // Check for district_name
        if(!is_null($object) && isset($object->district_name)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."district.name LIKE :district_name";
          $haveWHERE = true;
        }
        // Check for store_enabled
        if(!is_null($object) && isset($object->store_enabled)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article.enabled=:store_enabled";
          $haveWHERE = true;
        }
        // Check for price
        if(!is_null($object) && isset($object->min_price) && isset($object->max_price)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."article.price <= :max_price AND article.price >= :min_price";
          $haveWHERE = true;
        }

        // Check for search
         if(!is_null($object) && isset($object->search)){
          $sql = $sql.($haveWHERE? " AND " : " WHERE ")."(article.title LIKE CONCAT('%',:title_s,'%') OR store.public_name LIKE CONCAT('%',:store_name_s,'%') OR category.title LIKE CONCAT('%',:category_s,'%'))";
          $haveWHERE = true;
        }  

        // Check for id_list (ID LIST WILL BE A LIST WITH ID's TO GET)
        if(!is_null($object) && isset($object->id_list)){
          if(gettype($object->id_list) == "array"){
            $sql = $sql.($haveWHERE? " AND " : " WHERE ");
            for($i = 0; $i < count($object->id_list); $i++){
              $sql = $sql."article.id=:each_id".$i;
              if($i < (count($object->id_list) - 1)){
                $sql = $sql." OR ";
              }
            }
            $haveWHERE = true;
          }
        }
        // LIMIT
        $sql = $sql." LIMIT :initial_number,:quantity";

        $sql = $sql.";";

        //echo $sql;

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
            $resultado->bindParam(':title_s', $object->search, PDO::PARAM_STR);
            $resultado->bindParam(':store_name_s', $object->search, PDO::PARAM_STR);
            $resultado->bindParam(':category_s', $object->search, PDO::PARAM_STR);
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

            $articleIdObject = json_decode(json_encode(array("article_id" => $articles->id)));
            $opinionConnection = new Opinion();
            $opinions = $opinionConnection->select_opinion($articleIdObject);
            $articles->opinions = $opinions;

            $storeIdObject = json_decode(json_encode(array("id" => $articles->store_id)));
            $storeConnection = new Store();
            $stores = $storeConnection->select_store($storeIdObject);
            $articles->store = count($stores) > 0? $stores[0] : null;

            $formIdObject = json_decode(json_encode(array("id" => $articles->article_form_id)));
            $formConnection = new Article_form();
            $forms = $formConnection->select_article_form($formIdObject);
            $articles->form = count($forms) > 0? $forms[0] : null;;

            $categoryConnection = new Category();
            $categories = $categoryConnection->select_category($articles->category_id, null, null);
            $articles->category = count($categories) > 0? $categories[0] : null;;

            $questionConnection = new Question();
            $questions = $questionConnection->select_question($articleIdObject);
            $articles->questions = $questions;

            $photosConnection = new Photo();
            $photos = $photosConnection->select_photo($articleIdObject);
            $articles->photos = $photos;

            if(isset($object->profile_id)){
              $favoriteConnection = new Favorite();
              $favorites = $favoriteConnection->select_favorite(json_decode(json_encode(array("article_id" => $articles->id, "profile_id" => $object->profile_id))));
              $articles->favorite = count($favorites) > 0;
            }            

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