<?php
require_once __DIR__.('/../../api/query/store.php');
require_once('result_util.php');

class AuthUtil{

    public static function login(string $email, string $password){

        // Start using sessions
        session_start();
        session_destroy();
        session_start();

        $storeConnection = new Store();
        $login_store = $storeConnection->login($email, $password);

        // Check result
        $result = ResultUtil::checkResult($login_store);

        if($result){
            $_SESSION['id'] = $login_store[0]->id;
            return true;
        } else {
            return false;
        }

    }

    public static function logout(){
        session_start();
        session_destroy();
        return true;
    }

    public static function getStoreSession() : ?Store_model { 
        // Start using sessions
        session_start();

        if(!isset($_SESSION['id'])) return null;

        $storeConnection = new Store();
        $store = $storeConnection->select_store(json_decode(json_encode(array("id" => $_SESSION['id']))));

        // Check result
        $result = ResultUtil::checkResult($store);

        if($result){
            return $store[0];
        } else {
            return null;
        }
    }
    

}