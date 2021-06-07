<?php
require_once('../../Connection.php');
require_once('../../models/profile_model.php');
class profile extends Connection{

    public function insert_profile($name, $last_name, $email, $contact_number, $birthday, $terms_checked, $location, $passwords, $rut, $rut_cd, $district_id, $user_id){
        $this->connection_hosting();
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
      $this->connection_hosting();
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
      $this->connection_hosting();
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
      $this->connection_hosting();
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
      $this->connection_hosting();
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
      $this->connection_hosting();
      $sql="SELECT `name`, `last_name`, `email`, `contact_number`, `birthday`, `terms_checked`, `location`, `rut`, 
      `rut_cd`, `creation_date`, `last_update_date`, `district_id`, `user_id` FROM `profile`;";

      try{
        $resultado=$this->pdo->query($sql);
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $lista_profiles = array();

        for($i = 0; $i < count($data); $i++){
          $profiles =new Profiles();
          $profiles->name=$data[$i]["name"];
          $profiles->last_name=$data[$i]["last_name"];
          $profiles->email=$data[$i]["email"];
          $profiles->contact_number=$data[$i]["contact_number"];
          $profiles->birthday=$data[$i]["birthday"];
          $profiles->terms_checked=$data[$i]["terms_checked"];
          $profiles->location=$data[$i]["location"];
          $profiles->rut=$data[$i]["rut"];
          $profiles->rut_cd=$data[$i]["rut_cd"];
          $profiles->creation_date=$data[$i]["creation_date"];
          $profiles->last_update_date=$data[$i]["last_update_date"];
          $profiles->district_id=$data[$i]["district_id"];
          $profiles->user_id=$data[$i]["user_id"];
          array_push($lista_profiles, $profiles);
        }
        
        return $lista_profiles;
        $data->close();
        $this->pdo->close();
      
        } catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
    }
}

?>