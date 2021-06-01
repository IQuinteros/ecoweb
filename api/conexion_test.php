<?php
  class Connection{
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
		echo "hola";
    	try {
        $this->pdo = new PDO($dsn, $username, $password, $options);
    	} catch (PDOException $th) {
        echo $th->getMessage();
        die();
    	}
    }
}
   

?>
<html>
    <head>

    </head>
    <body>
        hola
    </body>
</html>