<?php
require_once __DIR__. '/../connection.php';
require_once __DIR__. '/../models/profile_model.php';

class ProfileController extends Connection{

    public function insert_profile($name, $last_name, $email, $contact_number, $birthday, $terms_checked, $location, $passwords, $rut, $rut_cd, $district_id, $user_id){
        $this->connection_registered();
        $sql = "INSERT INTO `profile` (`id`, `name`, `last_name`, `email`, `contact_number`, `birthday`, `terms_checked`, `location`, `passwords`, `rut`, `rut_cd`, `creation_date`, `last_update_date`, `district_id`, `user_id`) 
        VALUES (NULL, :name, :last_name, :email, :contact_number, :birthday, :terms_checked, :location, 
        :passwords, :rut, :rut_cd, CURRENT_TIME(), CURRENT_TIME(), :district_id, :user_id);";
        try{
         $result=$this->pdo->prepare($sql);
         $result->bindParam(':name', $name, PDO::PARAM_STR);
         $result->bindParam(':last_name', $last_name, PDO::PARAM_STR);
         $result->bindParam(':email', $email, PDO::PARAM_STR);
         $result->bindParam(':contact_number', $contact_number, PDO::PARAM_INT);
         $result->bindParam(':birthday', $birthday, PDO::PARAM_STR);
         $result->bindParam(':terms_checked', $terms_checked, PDO::PARAM_INT);
         $result->bindParam(':location', $location, PDO::PARAM_STR);
         $result->bindParam(':passwords', $passwords, PDO::PARAM_STR);
         $result->bindParam(':rut', $rut, PDO::PARAM_INT);
         $result->bindParam(':rut_cd', $rut_cd, PDO::PARAM_STR);
         $result->bindParam(':district_id', $district_id, PDO::PARAM_INT);
         $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
         $re=$result->execute();
          return $re;
          $re->close();
          $this->pdo->close();
      
        }catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
         
    }
    public function update_profile($name, $last_name, $email, $contact_number, $birthday, $location, $district_id, $id){
      $this->connection_registered();
      $sql="UPDATE `profile` 
      SET name=:name, last_name=:last_name, email=:email, contact_number=:contact_number, birthday=:birthday, location=:location, 
      last_update_date=CURRENT_TIME(), district_id=:district_id 
      WHERE id=:id;";
      try{
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':name', $name, PDO::PARAM_STR);
         $resultado->bindParam(':last_name', $last_name, PDO::PARAM_STR);
         $resultado->bindParam(':email', $email, PDO::PARAM_STR);
         $resultado->bindParam(':contact_number', $contact_number, PDO::PARAM_INT);
         $resultado->bindParam(':birthday', $birthday, PDO::PARAM_STR);
         $resultado->bindParam(':location', $location, PDO::PARAM_STR);
         $resultado->bindParam(':district_id', $district_id, PDO::PARAM_INT);
         $resultado->bindParam(':id', $id, PDO::PARAM_INT);
         $re=$resultado->execute();
          return $re;
          $re->close();
          $this->pdo->close();
      
        }catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
    }
    public function update_profile_pass($passwords, $id){
      $this->connection_registered();
      $sql="UPDATE `profile` SET passwords=:passwords WHERE id=:id";
      try{
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':passwords', $passwords, PDO::PARAM_STR);
         $resultado->bindParam(':id', $id, PDO::PARAM_INT);
         $re=$resultado->execute();
          return $re;
          $re->close();
          $this->pdo->close();
      
        }catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
    }
    public function update_profile_terms($terms_checked, $id){
      $this->connection_registered();
      $sql="UPDATE `profile` SET terms_checked=:terms_checked WHERE id=:id";
      try{
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':terms_checked', $terms_checked, PDO::PARAM_INT);
         $resultado->bindParam(':id', $id, PDO::PARAM_INT);
         $re=$resultado->execute();
          return $re;
          $re->close();
          $this->pdo->close();
      
        }catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
    }
    public function delete_profile($id){
      $this->connection_registered();
      $sql="DELETE FROM `profile` WHERE id=:id;";
      try{
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':id', $id, PDO::PARAM_INT);
         $re=$resultado->execute();
          return $re;
          $re->close();
          $this->pdo->close();
      
        }catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
    }

    public function select_profile(){
      $this->connection_registered();
      $sql="SELECT `name`, `last_name`, `email`, `contact_number`, `birthday`, `terms_checked`, `location`, `rut`, 
      `rut_cd`, `creation_date`, `last_update_date`, `district_id`, `user_id` FROM `profile`;";

      try{
        $result=$this->pdo->query($sql);
        $data=$result->fetchAll(PDO::FETCH_ASSOC);

        // NEW PROFILE MODEL OBJECT
        $profile = new ProfileModel();

        // SET PARAMS
        $profile->name = $data[0]["name"];
        $profile->lastName = $data[0]["last_name"];
        $profile->number = $data[0]["contact_number"];
        $profile->location = $data[0]["location"];
        $profile->rut = $data[0]["rut"];

        // RETURN PROFILE OBJECT
        $this->pdo = null;
        
        return $profile;

      }catch(PDOException $e){
        echo $e->getMessage();
        
        return null;
      }
    }
}

?>