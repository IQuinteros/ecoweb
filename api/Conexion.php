<?php
class Conexiones{
    protected $pdo;
    public function conexion_user(){
		$dsn = 'mysql:host=localhost;port=3306;dbname=ecomercio';
		$username = 'users';
		$password = 'hola';
		$options = array(
		    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
		    PDO::MYSQL_ATTR_FOUND_ROWS => true
		);
    try {
        $this->pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $th) {
        echo $th->getMessage();
        die();
    }
    public function conexion_registered(){
		$dsn = 'mysql:host=localhost;port=3306;dbname=ecomercio';
		$username = 'registered';
		$password = 'derroche';
		$options = array(
		    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
		    PDO::MYSQL_ATTR_FOUND_ROWS => true
		);
    try {
        $this->pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $th) {
        echo $th->getMessage();
        die();
    }
	public function conexion_shop(){
		$dsn = 'mysql:host=localhost;port=3306;dbname=ecomercio';
		$username = 'shop';
		$password = 'EzMoney';
		$options = array(
		    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
		    PDO::MYSQL_ATTR_FOUND_ROWS => true
		);
    try {
        $this->pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $th) {
        echo $th->getMessage();
        die();
    }

}



?>