<?php
require_once('../api/Connection.php');
class search extends Connection{
    public function insert_search_user($search_text, $user_id){
        $this->connection_user();
        $sql="INSERT INTO `search` (`id`, `search_text`, `search_date`, `user_id`) 
        VALUES (NULL, :search_text, CURRENT_TIME(), :user_id)";
        try{
            $resultado=$this->pdo->prepare($sql);
             $resultado->bindParam(':search_text', $search_text, PDO::PARAM_STR);
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
    public function insert_search_registered($search_text, $user_id){
        $this->connection_registered();
        $sql="INSERT INTO `search` (`id`, `search_text`, `search_date`, `user_id`) 
        VALUES (NULL, :search_text, CURRENT_TIME(), :user_id)";
        try{
            $resultado=$this->pdo->prepare($sql);
             $resultado->bindParam(':search_text', $search_text, PDO::PARAM_STR);
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
}
?>