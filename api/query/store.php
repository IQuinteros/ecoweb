<?php
require_once('../../Connection.php');
require_once('../../models/store_model.php');
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
    
             $this->pdo = null;
              return $re;
          
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
}