<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<?php
ini_set('display_errors', 1);
error_reporting(~0);

//require_once('api/query/store.php');
//$storeConnection = new Store();

require_once('include.php');

require_once('api/query/district.php');
$districtConnection = new district();

 ?>

        <form action="api/requests/example.php" method="POST">
        <label for="Pname"> public name:</label>
        <input type="text" id="Pname" name="Pname"><br><br>
        <label for="description">description:</label>
        <input type="text" id="description" name="description"><br><br>
        <label for="email">email:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="location">email:</label>
        <input type="text" id="location" name="location"><br><br>
        <label for="passwords">passwords:</label>
        <input type="text" id="passwords" name="passwords"><br><br>
        <label for="rut">rut:</label>
        <input type="text" id="rut" name="rut">
        <label for="rut_cd">rut cd:</label>
        <input type="text" id="rut_cd" name="rut_cd"><br><br>   
       <select>
           <option>
               <?php 
                $distritos = $districtConnection->select(null);

                foreach($distritos as $value){                                                 
                    echo "<option value='".$value->id."'>".$value->name."</option>";
                }

               ?>           
           </option>


       </select>
        <input type="submit" value="submit"/>
      </form>


</html>
