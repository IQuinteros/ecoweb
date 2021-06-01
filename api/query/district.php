<?php
require_once('../api/Connection.php');

class district extends Connection{ 
    public function insert_district($name){
        $this->conexion_user();

        $sql = "INSERT INTO `district` (`id`, `name`) VALUES (NULL, ':name');";

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
}

?>