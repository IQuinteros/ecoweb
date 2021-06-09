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
require_once('Conexion.php');
$n = new  Conexiones();
$n->conexion_user();
 ?>
        <form>
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
               $query="select * from distric";
               $result=mysqli_query($n->conexion_user(),$query);
               while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
                echo "<option value='".$row['id']."'>".$row['Name']."</option>";
             }

               ?>           
           </option>


       </select>
        <input type="submit" value="Submit">
      </form>

</html>
