<?php
require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/profile_model.php');
require_once __DIR__.('/user.php');
class Profile extends Connection{

    public function insert_profile($name, $last_name, $email, $contact_number, $birthday, $terms_checked, $location, $passwords, $rut, $rut_cd, $district_id, $user_id){
      $userController = new User();
      if($user_id == 0){
        // If user_id is equal 0, so then profile needs a new user
        $user_id = $userController->insert_user(null);
      }
      else{
        /// NEW FIX
        // Check if exists profile with that user id
        $profileWithThatUser = $this->select_profile(json_decode(json_encode(array('user_id' => $user_id))), FALSE);

        if(isset($profileWithThatUser) && count($profileWithThatUser) <= 0){
          // If there isn't a profile with that user_id, so the new profile can have this user_id

          // First, check if that user exists
          $userWithThatId = $userController->select_user(json_decode(json_encode(array('id' => $user_id))), FALSE);

          if(isset($userWithThatId) && count($userWithThatId) <= 0){
            // If there isn't a user with that id, so create in database
            $user_id = $userController->insert_user($user_id);
          }
          // Else? Not needs else, because user exists
        }
        else{
          // New profile needs new user_id
          $user_id = $userController->insert_user(null);
        }
      }

      if(gettype($user_id) == "array"){
        $user_id = $user_id[0];
      }
      
      if(gettype($user_id) != "integer" && gettype($user_id) != "string"){
        return null;
      }

      $this->connection_hosting();
      $sql = "INSERT INTO `profile` (`id`, `name`, `last_name`, `email`, `contact_number`, `birthday`, `terms_checked`, `location`, `passwords`, `rut`, `rut_cd`, `creation_date`, `last_update_date`, `district_id`, `user_id`) 
      VALUES (NULL, :name, :last_name, :email, :contact_number, :birthday, :terms_checked, :location, 
      PASSWORD(:passwords), :rut, :rut_cd, CURRENT_TIME(), CURRENT_TIME(), :district_id, :user_id);";
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
        if(isset($district_id)){
          $resultado->bindParam(':district_id', $district_id, PDO::PARAM_INT);
        }
        else{
          $resultado->bindValue(':district_id', null, PDO::PARAM_NULL);
        }
        $resultado->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $re=$resultado->execute();

        $re = $this->pdo->lastInsertId();
        $this->pdo = null;      
        return array($re, $user_id);   

    
      }catch(PDOException $e){
        echo $e->getMessage();
        return $e;
        die();
      }
         
    }
    public function update_profile($name, $last_name, $email, $contact_number, $birthday, $location, $district_id, $id){
      $this->connection_hosting();
      $sql="UPDATE `profile` SET name=:name, last_name=:last_name, email=:email, contact_number=:contact_number, birthday=:birthday, location=:location, 
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
         if(isset($district_id)){
          $resultado->bindParam(':district_id', $district_id, PDO::PARAM_INT);
         }
         else{
          $resultado->bindValue(':district_id', null, PDO::PARAM_NULL);
         }
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
    public function update_profile_pass($passwords, $id){
      $this->connection_hosting();
      $sql="UPDATE `profile` SET passwords=PASSWORD(:passwords), last_update_date=CURRENT_TIME() WHERE id=:id";
      try{
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':passwords', $passwords, PDO::PARAM_STR);
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
    public function update_profile_terms($terms_checked, $id){
      $this->connection_hosting();
      $sql="UPDATE `profile` SET terms_checked=:terms_checked, last_update_date=CURRENT_TIME() WHERE id=:id";
      try{
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':terms_checked', $terms_checked, PDO::PARAM_INT);
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
    public function delete_profile($id){
      $this->connection_hosting();
      $sql="DELETE FROM `profile` WHERE id=:id;";
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
    public function select_profile($object){
      $this->connection_hosting();
      $sql="SELECT `id`, `name`, `last_name`, `email`, `contact_number`, `birthday`, `terms_checked`, `location`, `rut`, 
      `rut_cd`, `creation_date`, `last_update_date`, `district_id`, `user_id` FROM `profile`";

      $haveWHERE = false;

      // Check for id
      if(!is_null($object) && isset($object->id)){
        $sql = $sql." WHERE id=:id";
        $haveWHERE = true;
      }

      // Check for email
      if(!is_null($object) && isset($object->email)){
        $sql = $sql.($haveWHERE? " AND " : " WHERE ")."email=:email";
        $haveWHERE = true;
      }

      // Check for user id
      if(!is_null($object) && isset($object->user_id)){
        $sql = $sql.($haveWHERE? " AND " : " WHERE ")."user_id=:user_id";
        $haveWHERE = true;
      }

      $sql = $sql.";";

      // Debugging: echo($sql);

      try{
        $resultado=$this->pdo->prepare($sql);
        if(isset($object->id)){
          $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
        }
        if(isset($object->email)){
          $resultado->bindParam(':email', $object->email, PDO::PARAM_STR);
        }
        if(isset($object->user_id)){
          $resultado->bindParam(':user_id', $object->user_id, PDO::PARAM_STR);
        }
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $lista_profiles = array();

        for($i = 0; $i < count($data); $i++){
          $profiles =new Profiles();
          $profiles->id=$data[$i]["id"];
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

        $this->pdo = null;
        
        return $lista_profiles;
      
        } catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
    }

    public function login(string $email, string $password){
      $this->connection_hosting();
      $sql="SELECT `id`, `name`, `last_name`, `email`, `contact_number`, `birthday`, `terms_checked`, `location`, `rut`, 
      `rut_cd`, `creation_date`, `last_update_date`, `district_id`, `user_id` FROM `profile` WHERE email = :email AND passwords = PASSWORD(:passwords);";

      try{
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':passwords', $password, PDO::PARAM_STR);
        $resultado->bindParam(':email', $email, PDO::PARAM_STR);
        $resultado->execute();

        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $lista_profiles = array();

        for($i = 0; $i < count($data); $i++){
          $profiles =new Profiles();
          $profiles->id = $data[$i]["id"];
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

        $this->pdo = null;
        
        return $lista_profiles;
      
        } catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
    }
    public function report_user_registered($object){
      $this->connection_hosting();
      $sql="SELECT COUNT(`id`) AS `contador` FROM `profile`";

      $haveWHERE = false;
      //id check
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
        $lista_profiles = array();

        for($i = 0; $i < count($data); $i++){
          $contador = $data[$i]["contador"];
          array_push($lista_profiles, $contador);
        }

        $this->pdo = null;
        
        return $lista_profiles;

      }catch(PDOException $e){
        echo $e->getMessage();
        return $e;
        die();
      }
    }
    public function report_user_registered_district($object){
      $this->connection_hosting();
      $sql="SELECT COUNT(profile.id) AS `contador`, profile.`district_id`, district.name as district_name
      FROM `profile`
      INNER JOIN district ON profile.district_id = district.id";
      
      $haveWHERE = false;
      //id check
      if(!is_null($object) && isset($object->district_id)){
        $sql = $sql." WHERE district_id=:district_id";
        $haveWHERE = true;
      }
      $sql = $sql." GROUP BY `district_id`";
      $sql = $sql.";";

      try{
        $resultado=$this->pdo->prepare($sql);

        if(isset($object->id)){
          $resultado->bindParam(':district_id', $object->district_id, PDO::PARAM_INT);
        }
        
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $lista_profiles = array();

        for($i = 0; $i < count($data); $i++){
          $array = array();
          $array["district_id"] = $data[$i]["district_id"];
          $array["district_name"] = $data[$i]["district_name"];
          $array["contador"]=$data[$i]["contador"];
          array_push($lista_profiles, $array);
        }

        $this->pdo = null;
        
        return $lista_profiles;

      }catch(PDOException $e){
        echo $e->getMessage();
        return $e;
        die();
      }
    }
    public function report_user_resgistered_ages($object){
      $this->connection_hosting();
      $sql="SELECT profile.rango AS Rango, COUNT(*) AS `contador` FROM (SELECT CASE 
      WHEN `birthday` BETWEEN DATE_ADD(DATE_ADD(DATE_ADD(CURRENT_DATE(), INTERVAL - 17 YEAR), INTERVAL -11 MONTH), INTERVAL - 30 DAY) 
      AND CURRENT_DATE() THEN '0-18' 
      WHEN `birthday` BETWEEN DATE_ADD(DATE_ADD(DATE_ADD(CURRENT_DATE(), INTERVAL - 30 YEAR), INTERVAL -11 MONTH), INTERVAL - 30 DAY) 
      AND DATE_ADD(CURRENT_DATE(), INTERVAL - 18 YEAR) THEN '18-30' 
      WHEN `birthday` BETWEEN DATE_ADD(DATE_ADD(DATE_ADD(CURRENT_DATE(), INTERVAL - 45 YEAR), INTERVAL -11 MONTH), INTERVAL - 30 DAY) 
      AND DATE_ADD(CURRENT_DATE(), INTERVAL - 31 YEAR) THEN '31-45' 
      WHEN `birthday` BETWEEN DATE_ADD(DATE_ADD(DATE_ADD(CURRENT_DATE(), INTERVAL - 61 YEAR), INTERVAL -11 MONTH), INTERVAL - 30 DAY) 
      AND DATE_ADD(CURRENT_DATE(), INTERVAL - 45 YEAR) THEN '46-60' 
      WHEN `birthday` BETWEEN DATE_ADD(DATE_ADD(DATE_ADD(CURRENT_DATE(), INTERVAL - 120 YEAR), INTERVAL -11 MONTH), INTERVAL - 30 DAY) 
      AND DATE_ADD(CURRENT_DATE(), INTERVAL - 60 YEAR) THEN '60+' 
      ELSE 'Error' END AS rango FROM `profile`) `profile` GROUP BY profile.rango";
      

      try{
        $resultado=$this->pdo->prepare($sql);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $lista_profiles = array();

        for($i = 0; $i < count($data); $i++){
          $array = array();
          $array["rango"] = $data[$i]["Rango"];
          $array["contador"]=$data[$i]["contador"];
          array_push($lista_profiles, $array);
        }

        $this->pdo = null;
        
        return $lista_profiles;

      }catch(PDOException $e){
        echo $e->getMessage();
        return $e;
        die();
      }
    }
}

?>