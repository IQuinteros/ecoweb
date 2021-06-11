<?php
require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/category_model.php');
class Category extends Connection{
    public function select_category($id, $title, $creation_date){
        $this->connection_hosting();
        $sql="SELECT * FROM `category`";
        $haveWHERE = false;

        // Check for id
        if(!is_null($id)){
          $sql = $sql." WHERE id=:id";
          $haveWHERE = true;
        }
        $sql = $sql.";";

        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($id)){
              $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            }
            
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_category = array();
      
            for($i = 0; $i < count($data); $i++){
              $categorys =new Category_model();
              $categorys->id=$data[$i]["id"];
              $categorys->title=$data[$i]["title"];
              $categorys->creation_date=$data[$i]["creation_date"];
              array_push($lista_category, $categorys);
            }
      
            $this->pdo = null;
            
            return $lista_category;
          
            } catch(PDOException $e){
              echo $e->getMessage();
              return $e;
              die();
            }
    }
}