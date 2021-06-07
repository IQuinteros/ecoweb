<?php
require_once('../api/Connection.php');
    class user extends Connection{
        public function insert_user(){
            $this->connection_hosting();
            $sql="INSERT INTO `user` (`id`, `creation_date`, `lastConnectionDate`)
             VALUES (NULL, CURRENT_TIME(), CURRENT_TIME());";
             try{
                $resultado=$this->pdo->prepare($sql);
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
        public function update_user_users($id){
            $this->connection_hosting();
            $sql="UPDATE `user` SET lastConnectionDate=CURRENT_TIME() WHERE id=:id;";
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
        public function update_user_registered($id){
            $this->connection_hosting();
            $sql="UPDATE `user` SET lastConnectionDate=CURRENT_TIME() WHERE id=:id;";
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
        
    }
?>