<?php

require_once __DIR__.('/../Connection.php');
require_once('../../models/district_model.php');

class district extends Connection{ 
    public function insert_district($name){
        $this->connection_hosting();

        $sql = "INSERT INTO `district` (`id`, `name`) VALUES (NULL, :name);";

        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }

        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':name', $name, PDO::PARAM_STR);
         $re=$resultado->execute();
         if (!$re) {
          //die(mysql_error());
        } else{
          $this->pdo = null;
          return $re;
      }
    }
    public function delete_district($id){
      $this->connection_hosting();

      $sql = "DELETE FROM `district` WHERE id=:id;";

      if($this->pdo == null)
      {
        echo 'PDO NULL';
        return;
      }

      $resultado=$this->pdo->prepare($sql);
       $resultado->bindParam(':id', $id, PDO::PARAM_INT);
       $re=$resultado->execute();
       if (!$re) {
        //die(mysql_error());
      } else{
        $this->pdo = null;
        return $re;

    }
  }
  public function update_district($id, $name){
    $this->connection_hosting();

    $sql = "UPDATE `district` SET name=:name WHERE id=:id;";

    if($this->pdo == null)
    {
      echo 'PDO NULL';
      return;
    }

    $resultado=$this->pdo->prepare($sql);
      $resultado->bindParam(':name', $name, PDO::PARAM_STR);
      $resultado->bindParam(':id', $id, PDO::PARAM_INT);
      $re=$resultado->execute();
    if (!$re) {
      //die(mysql_error());
    } else{
      $this->pdo = null;
      return $re;
    }
  }

  public function select($object){
    $this->connection_hosting();
    $sql="SELECT `id`, `name` FROM `district`";

    $haveWHERE = false;

    // Check for id
    if(!is_null($object) && isset($object->id)){
      $sql = $sql." WHERE id=:id";
      $haveWHERE = true;
    }

    // Check for email
    if(!is_null($object) && isset($object->name)){
      $sql = $sql.($haveWHERE? " AND " : " WHERE ")."name=:name";
    }

    $sql = $sql.";";
    
    try{
      $resultado=$this->pdo->prepare($sql);
      if(isset($object->id)){
        $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
      }
      if(isset($object->name)){
        $resultado->bindParam(':name', $object->name, PDO::PARAM_STR);
      }
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      $lista_districts = array();

      for($i = 0; $i < count($data); $i++){
        $districts =new Districts();
        $districts->id=$data[$i]["id"];
        $districts->name=$data[$i]["name"];
        array_push($lista_districts, $districts);
      }

      $this->pdo = null;
      
      return $lista_districts;
    
      } catch(PDOException $e){
        echo $e->getMessage();
        return $e;
        die();
      }
  }
}

?>