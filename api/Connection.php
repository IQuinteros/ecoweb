<?php
abstract class Connection{
	protected $pdo;
    public function connection_user(){
		$dsn = 'mysql:host=localhost;port=3306;dbname=id16988549_ecomercio';
		$username = 'users';
		$password = 'hola';
		$options = array(
		    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
		    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
		    PDO::MYSQL_ATTR_FOUND_ROWS => true
		);
		echo "hola";
    	try {
        $this->pdo = new PDO($dsn, $username, $password, $options);
    	} catch (PDOException $th) {
        echo $th->getMessage();
        die();
    	}
	}
    public function connection_registered(){
		$dsn = 'mysql:host=localhost;port=3306;dbname=id16988549_ecomercio';
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
	}
	public function connection_shop(){
		$dsn = 'mysql:host=localhost;port=3306;dbname=id16988549_ecomercio';
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
	public function connection_root(){
		$dsn = 'mysql:host=localhost;port=3306;dbname=id16988549_ecomercio';
		$username = 'root';
		$password = 'root';
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
	public function connection_hosting(){
		$dsn = 'mysql:host=localhost;port=3306;dbname=id16988549_ecomercio';
		$username = 'id16988549_admin';
		$password = 'ruJxus-kidky3-puhbox';
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
	public function debug_to_console( $data ) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);
	
		echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	}
}
    


