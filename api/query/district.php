<?php
require_once('../api/Connection.php');
class district{ 
    public function insert_district($name){
        $sql = "INSERT INTO `district` (`id`, `name`) VALUES (NULL, ':name');";
        $resultado=$this->pdo->prepare($sql);
         $resultado->bindParam(':name', $name, PDO::PARAM_STR);
         $re=$resultado->execute();
         if (!$re) {
          die(mysql_error());
        } else{
          return $re;
          $re->close();
          $this->pdo->close();
      }
    }
}

?>