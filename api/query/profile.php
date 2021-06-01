<?php
require_once('../api/Connection.php');
class profile extends Connection{

    public function insert_profile($name, $last_name, $email, $contact_number, $birthday, $terms_checked, $location, $passwords, $rut, $rut_cd, $district_id){
        $this->conexion_registered();
        $sql = "INSERT INTO `profile` (`id`, `name`, `last_name`, `email`, `contact_number`, `birthday`, `terms_checked`, `location`, `passwords`, `rut`, `rut_cd`, `creation_date`, `last_update_date`, `district_id`) 
        VALUES (NULL, :name, :last_name, :email, :contact_number, :birthday, :terms_checked, :location, 
        :passwords, :rut, :rut_cd, CURRENT_TIME(), CURRENT_TIME(), :district_id);";
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
         $resultado->bindParam(':district_id', $birthday, PDO::PARAM_INT);
         $re=$resultado->execute();
          if(!$re){$this->debug_to_console(PDOException());}
          return $re;
          $re->close();
          $this->pdo->close();
      
        }catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
         
    }
}

?>