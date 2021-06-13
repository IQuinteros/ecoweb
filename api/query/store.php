<?php
require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/store_model.php');
class Store extends Connection{
    public function insert_store($object){
        $this->connection_hosting();
        $sql="INSERT INTO `store`(`id`, `public_name`, `description`, `email`, `contact_number`, 
        `location`, `passwords`, `rut`, `rut_cd`, `enabled`, `creation_date`, `last_update_date`, `district_id`, `photo_url`) 
        VALUES (NULL, :public_name, :description , :email, :contact_number, :location, PASSWORD(:password), :rut, :rut_cd, 
        :enabled, CURRENT_TIME(), CURRENT_TIME(), :district_id, :photo_url)";
        try{
            $resultado=$this->pdo->prepare($sql);
             $resultado->bindParam(':public_name', $object->public_name, PDO::PARAM_STR);
             $resultado->bindParam(':description', $object->description, PDO::PARAM_STR);
             $resultado->bindParam(':contact_number', $object->contact_number, PDO::PARAM_INT);
             $resultado->bindParam(':location', $object->location, PDO::PARAM_STR);
             $resultado->bindParam(':password', $object->password, PDO::PARAM_STR);
             $resultado->bindParam(':rut', $object->rut, PDO::PARAM_INT);
             $resultado->bindParam(':rut_cd', $object->rut_cd, PDO::PARAM_INT);
             $resultado->bindParam(':enabled', $object->enabled, PDO::PARAM_INT);
             if(isset($object->district_id)){
                $resultado->bindParam(':district_id', $object->district_id, PDO::PARAM_INT);
               }
               else{
                $resultado->bindValue(':district_id', null, PDO::PARAM_NULL);
               }
               if(isset($object->photo_url)){
                $resultado->bindParam(':photo_url', $object->photo_url, PDO::PARAM_STR);
               }
               else{
                $resultado->bindValue(':photo_url', null, PDO::PARAM_NULL);
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
    public function delete_store($id){
        $this->connection_hosting();
        $sql="DELETE FROM `store` WHERE id=:id";
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
    public function update_store($object){
      $this->connection_hosting();
      $sql="UPDATE `store` SET `public_name`=:public_name,`description`=:description,`email`=:email
      ,`contact_number`=:contact_number,`location`=:location,`last_update_date`=CURRENT_TIME,
      `district_id`=:district_id,`photo_url`=:photo_url 
      WHERE `id`=:id";
      try{
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':public_name', $object->public_name, PDO::PARAM_STR);
         $resultado->bindParam(':description', $object->description, PDO::PARAM_STR);
         $resultado->bindParam(':email', $object->email, PDO::PARAM_STR);
         $resultado->bindParam(':contact_number', $object->contact_number, PDO::PARAM_INT);
         $resultado->bindParam(':location', $object->location, PDO::PARAM_STR);
         if(isset($object->district_id)){
          $resultado->bindParam(':district_id', $object->district_id, PDO::PARAM_INT);
         }
         else{
          $resultado->bindValue(':district_id', null, PDO::PARAM_NULL);
         }
         if(isset($object->photo_url)){
          $resultado->bindParam(':photo_url', $object->photo_url, PDO::PARAM_STR);
         }
         else{
          $resultado->bindValue(':photo_url', null, PDO::PARAM_NULL);
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
    public function update_store_pass($password, $id){
      $this->connection_hosting();
      $sql="UPDATE `store` SET `passwords`=PASSWORD(:password) WHERE id=:id";
      try{
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':password', $password, PDO::PARAM_STR);
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
    public function update_store_enabled($enabled, $id){
      $this->connection_hosting();
      $sql="UPDATE `store` SET `enabled`=:enabled WHERE id=:id";
      try{
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':enabled', $enabled, PDO::PARAM_INT);
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
    public function select_store($id, $public_name, $email){
      $this->connection_hosting();
      $sql="SELECT `id`, `public_name`, `description`, `email`, `contact_number`, `location`, `rut`, `rut_cd`, 
      `enabled`, `creation_date`, `last_update_date`, `district_id`, `photo_url` 
      FROM `store` WHERE `id`=:id OR `public_name` LIKE :public_name OR `email` LIKE :email";

      try{
        $resultado=$this->pdo->prepare($sql);
        
        $resultado->bindParam(':id', $id, PDO::PARAM_INT);
        $resultado->bindParam(':public_name', '%'.$public_name.'%', PDO::PARAM_STR);
        $resultado->bindParam(':email', '%'.$email.'%', PDO::PARAM_STR);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $lista_tiendas = array();

        for($i = 0; $i < count($data); $i++){
          $tiendas =new Store_model();
          $tiendas->id=$data[$i]["id"];
          $tiendas->public_name=$data[$i]["public_name"];
          $tiendas->description=$data[$i]["description"];
          $tiendas->email=$data[$i]["email"];
          $tiendas->contact_number=$data[$i]["contact_number"];
          $tiendas->location=$data[$i]["location"];
          $tiendas->rut=$data[$i]["rut"];
          $tiendas->rut_cd=$data[$i]["rut_cd"];
          $tiendas->enabled=$data[$i]["enabled"];
          $tiendas->creation_date=$data[$i]["creation_date"];
          $tiendas->last_update_date=$data[$i]["last_update_date"];
          $tiendas->district_id=$data[$i]["district_id"];
          $tiendas->photo_url=$data[$i]["photo_url"];
          array_push($lista_tiendas, $tiendas);
        }

        $this->pdo = null;
        
        return $lista_tiendas;
      
        } catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
    }
    public function login($email, $pass){
      $this->connection_hosting();
      $sql="SELECT `email`, `passwords` FROM `store` WHERE `email`=:email AND `passwords`=PASSWORD(:password)";
      try{
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':email', $email, PDO::PARAM_STR);
        $resultado->bindParam(':public_name', $pass, PDO::PARAM_STR);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $lista_login = array();
        for($i = 0; $i < count($data); $i++){
          $tiendas =new Store_model();
          $tiendas->email=$data[$i]["email"];
          $tiendas->passwords=$data[$i]["passwords"];
          array_push($lista_login, $tiendas);
        }

        $this->pdo = null;
        
        return $lista_login;

      }catch(PDOException $e){
        echo $e->getMessage();
          return $e;
          die();
      }
      
    }
}