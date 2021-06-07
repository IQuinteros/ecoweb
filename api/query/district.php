<?php
require_once('../api/Connection.php');

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
          return $re;
          $re->close();
          $this->pdo->close();
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
        return $re;
        $re->close();
        $this->pdo->close();
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
        return $re;
        $re->close();
        $this->pdo->close();
      }
    }
}

?>