<?php
require_once('../api/Connection.php');
class ProfileController extends Connection{

    public function insert_profile($name, $last_name, $email, $contact_number, $birthday, $terms_checked, $location, $passwords, $rut, $rut_cd, $district_id, $user_id){
        $this->connection_registered();
        $sql = "INSERT INTO `profile` (`id`, `name`, `last_name`, `email`, `contact_number`, `birthday`, `terms_checked`, `location`, `passwords`, `rut`, `rut_cd`, `creation_date`, `last_update_date`, `district_id`, `user_id`) 
        VALUES (NULL, :name, :last_name, :email, :contact_number, :birthday, :terms_checked, :location, 
        :passwords, :rut, :rut_cd, CURRENT_TIME(), CURRENT_TIME(), :district_id, :user_id);";
        try{
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':name', $name, PDO::PARAM_STR);
         $resultado->bindParam(':last_name', $last_name, PDO::PARAM_STR);
         $resultado->bindParam(':email', $email, PDO::PARAM_STR);
         $resultado->bindParam(':contact_number', $contact_number, PDO::PARAM_INT);
         $resultado->bindParam(':birthday', $birthday, PDO::PARAM_STR);
         $resultado->bindParam(':terms_checked', $terms_checked, PDO::PARAM_INT);
         $resultado->bindParam(':location', $location, PDO::PARAM_STR);
         $resultado->bindParam(':passwords', $passwords, PDO::PARAM_STR);
         $resultado->bindParam(':rut', $rut, PDO::PARAM_INT);
         $resultado->bindParam(':rut_cd', $rut_cd, PDO::PARAM_STR);
         $resultado->bindParam(':district_id', $district_id, PDO::PARAM_INT);
         $resultado->bindParam(':user_id', $user_id, PDO::PARAM_INT);
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

    public function select_profile($id){
      $this->connection_registered();
      $sql = "SELECT FROM profile WHERE id = id"; // Only example sql

      try{
        $resultado = $this->pdo->prepare($sql);
        
        // Only an example after get the row result

        // NEW PROFILE MODEL OBJECT
        $profile = new ProfileModel();

        // SET PARAMS
        $profile->name = $resultado["name"];
        $profile->lastName = $resultado["lastName"];
        $profile->number = $resultado["number"];
        $profile->location = $resultado["location"];
        $profile->rut = $resultado["rut"];

        // RETURN PROFILE OBJECT
        return $profile;

      }catch(PDOException $e){
        echo $e->getMessage();
        
        return null;
      }

    }
}

?>