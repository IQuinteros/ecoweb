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
<<<<<<< HEAD:api/Connection.php
    	}
	}
=======
    }
    }
>>>>>>> 5101ac623b8468435f4aedec5a6cd5c293dae7cb:api/Conexion.php
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
<<<<<<< HEAD:api/Connection.php
    	}
	}
=======
    }
     }
>>>>>>> 5101ac623b8468435f4aedec5a6cd5c293dae7cb:api/Conexion.php
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
<<<<<<< HEAD:api/Connection.php
    	}
	}
	public function conexion_root(){
		$dsn = 'mysql:host=localhost;port=3306;dbname=ecomercio';
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
}
    


=======
    }
	}
}
?>
>>>>>>> 5101ac623b8468435f4aedec5a6cd5c293dae7cb:api/Conexion.php
