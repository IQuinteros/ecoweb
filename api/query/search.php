<?php
require_once('../api/Connection.php');
require_once('../../models/search_model.php');
class Search extends Connection{
    public function insert_search_user($search_text, $user_id){
        $this->connection_hosting();
        $sql="INSERT INTO `search` (`id`, `search_text`, `search_date`, `user_id`) 
        VALUES (NULL, :search_text, CURRENT_TIME(), :user_id)";
        try{
            $resultado=$this->pdo->prepare($sql);
             $resultado->bindParam(':search_text', $search_text, PDO::PARAM_STR);
             $resultado->bindParam(':user_id', $user_id, PDO::PARAM_INT);
             $re=$resultado->execute();
             $this->pdo = null;
              return $re;

          
            }catch(PDOException $e){
              echo $e->getMessage();
              return $e;
              die();
            }
    }
    public function insert_search_registered($search_text, $user_id){
        $this->connection_hosting();
        $sql="INSERT INTO `search` (`id`, `search_text`, `search_date`, `user_id`) 
        VALUES (NULL, :search_text, CURRENT_TIME(), :user_id)";
        try{
            $resultado=$this->pdo->prepare($sql);
             $resultado->bindParam(':search_text', $search_text, PDO::PARAM_STR);
             $resultado->bindParam(':user_id', $user_id, PDO::PARAM_INT);
             $re=$resultado->execute();
             $this->pdo = null;
              return $re;
          
            }catch(PDOException $e){
              echo $e->getMessage();
              return $e;
              die();
            }
    }
    public function select_search($object){
      $this->connection_hosting();
      $sql="SELECT * FROM `search` WHERE `search_date` BETWEEN DATE_ADD(CURRENT_TIME(), INTERVAL - 7 DAY) AND CURRENT_TIME()";

      $haveWHERE = false;

        // Check for id
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
          $re=$resultado->execute();
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
          $lista_busqueda= array();

          for($i = 0; $i < count($data); $i++){
            $search =new Search_model();
            $search->id=$data[$i]["id"];
            $search->name=$data[$i]["search_text"];
            $search->last_name=$data[$i]["search_date"];
            $search->email=$data[$i]["user_id"];
            array_push($lista_busqueda, $search);
          }
          $this->pdo = null;
          return $re;
      
        }catch(PDOException $e){
          echo $e->getMessage();
          return $e;
          die();
        }
    }
    public function delete_search($id){
      $this->connection_hosting();
      $sql="DELETE FROM `search` WHERE `id`=:id";
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
}
?>