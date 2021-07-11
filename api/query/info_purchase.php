<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/info_purchase_model.php');

class Info_purchase extends Connection{
    public function insert_info_purchase($object){
        $this->connection_hosting();
        $sql="INSERT INTO `info_purchase` (`id`, `names`, `location`, `contact_number`, `district`) 
        VALUES (NULL, :names, :location, :contact_number, :district);";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $resultado=$this->pdo->prepare($sql);
        $resultado->bindParam(':names', $object->names, PDO::PARAM_STR);
        $resultado->bindParam(':location', $object->location, PDO::PARAM_STR);
        $resultado->bindParam(':contact_number', $object->contact_number, PDO::PARAM_INT);
        $resultado->bindParam(':district', $object->district, PDO::PARAM_STR);
        $re=$resultado->execute();
        if (!$re) 
        {
         //die(mysql_error());
        } else{
          $re = $this->pdo->lastInsertId();
          $this->pdo = null;
          return array($re);
        }
    }
    public function delete_info_purchase($id){
        $this->connection_hosting();
        $sql="DELETE FROM `info_purchase` WHERE id=:id;";
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
    public function select_info_purchase($object){
        $this->connection_hosting();
        $sql="SELECT * FROM `info_purchase`";
        if($this->pdo == null)
        {
          echo 'PDO NULL';
          return;
        }
        $haveWHERE = false;
        // Check for id
        if(!is_null($object) && isset($object->id)){
            $sql = $sql." WHERE id=:id";
            $haveWHERE = true;
        }
        // Check for id_list (ID LIST WILL BE A LIST WITH ID's TO GET)
        if(!is_null($object) && isset($object->id_list)){
            if(gettype($object->id_list) == "array"){
                $sql = $sql.($haveWHERE? " AND " : " WHERE ");
                for($i = 0; $i < count($object->id_list); $i++){
                    $sql = $sql."info_purchase.id=:each_id".$i;
                    if($i < (count($object->id_list) - 1)){
                    $sql = $sql." OR ";
                    }
                }
                $haveWHERE = true;
            }
        }
        try{
            $resultado=$this->pdo->prepare($sql);
            if(isset($object->id)){
                $resultado->bindParam(':id', $object->id, PDO::PARAM_INT);
            }
            if(isset($object->id_list)){
                if(gettype($object->id_list) == "array"){
                    for($i = 0; $i < count($object->id_list); $i++){
                    $resultado->bindParam(':each_id'.$i, $object->id_list[$i], PDO::PARAM_INT);
                    }
                }
            }
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            $lista_info = array();
            for($i = 0; $i < count($data); $i++){
                $infos =new Info_purchase_model();
                $infos->id=$data[$i]["id"];
                $infos->names=$data[$i]["names"];
                $infos->location=$data[$i]["location"];
                $infos->contact_number=$data[$i]["contact_number"];
                $infos->district=$data[$i]["district"];
                array_push($lista_info, $infos);
            }
        
            $this->pdo = null;
              
            return $lista_info;
        }catch(PDOException $e){
            echo $e->getMessage();
            return $e;
            die();
        }
    }
}



