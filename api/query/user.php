<?php
require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/user_model.php');
class User extends Connection{
    public function insert_user($user_id){
        $idValue = 'NULL';
        if(isset($user_id)){
          $idValue = ':id';
        }

        $this->connection_hosting();
        $sql="INSERT INTO `user` (`id`, `creation_date`, `lastConnectionDate`)
          VALUES ($idValue, CURRENT_TIME(), CURRENT_TIME()); ";
          try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($user_id)){
              $resultado->bindParam(':id', $user_id, PDO::PARAM_INT);
            }
              $resultado->execute();
              $re = $this->pdo->lastInsertId();
              $this->pdo = null;      
              return array($re);    
            }catch(PDOException $e){
              echo $e->getMessage();
              return $e;
              die();
            }
    }
    public function update_user_users($id){
        $this->connection_hosting();
        $sql="UPDATE `user` SET lastConnectionDate=CURRENT_TIME() WHERE id=:id;";
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
    public function update_user_registered($id){
        $this->connection_hosting();
        $sql="UPDATE `user` SET lastConnectionDate=CURRENT_TIME() WHERE id=:id;";
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
    public function delete_user($id){
      $this->connection_hosting();
      $sql="DELETE FROM `user` WHERE id=:id";
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
    public function select_user($object){
      $this->connection_hosting();
      $sql="SELECT * FROM `user`";

      $haveWHERE = false;

    // Check for id
    if(!is_null($object) && isset($object->id)){
    $sql = $sql." WHERE id=:id";
    $haveWHERE = true;
    $sql=$sql.";";
    }  

    try{
      $resultado=$this->pdo->prepare($sql);
      if(isset($object->id)){
      $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
      }
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      $lista_users = array();

      for($i = 0; $i < count($data); $i++){
        $users =new User_model();
        $users->id=$data[$i]["id"];
        $users->creation_date=$data[$i]["creation_date"];
        $users->last_update_date=$data[$i]["lastConnectionDate"];
        array_push($lista_users, $users);
      }

      $this->pdo = null;
      
      return $lista_users;
    }catch(PDOException $e){
      echo $e->getMessage();
      return $e;
      die();
    }
  }
}
?>