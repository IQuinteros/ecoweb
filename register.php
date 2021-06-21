<?php 
 if(isset($_POST['submit'])){
     $Pname =$_POST['Pname'];
     $description=$_POST['description'];
      $email=$_POST['email'];
     $contact_number=$_POST['contact_number'];
     $location=$_POST['location'];
     $passwords=$_POST['passwords'];
     $rut=$_POST['rut'];
     $rut_cd=$_POST['rut_cd'];
     $district=$_POST['district'];
     $store->id=null;
     $store->public_name=$Pname;
     $store->description=$description;
     $store->email=$email;
     $store->contact_number=$contact_number;
     $store->location=$location;
     $store->passwords=$passwords;
     $store->rut=$rut;
     $store->rut_cd=$rut_cd;
     $store->district_id=$district;
     $store->enabled=true;
     $insert_store=$profileConnection->insert_store($store);
 }
?>
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

require_once('api/query/store.php');
$storeConnection = new Store();

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
        <label for="contact_number">telefono:</label>
        <input type="text" id="contact_number" name="contact_number"><br><br>
        <label for="location">direccion:</label>
        <input type="text" id="location" name="location"><br><br>
        <label for="passwords">passwords:</label>
        <input type="text" id="passwords" name="passwords"><br><br>
        <label for="rut">rut:</label>
        <input type="text" id="rut" name="rut">
        <label for="rut_cd">rut cd:</label>
        <input type="text" id="rut_cd" name="rut_cd"><br><br>   
       <select id="district" name="district">
           <option>
               <?php 
                $distritos = $districtConnection->select(null);
                foreach($distritos as $value){                                                 
                    echo "<option value='".$value->id."'>".$value->name."</option>";
                }
               ?>           
           </option>
       </select>
        
        <button onclick="sendData(insert_store)" value="registro" name="submit"
        <?php         
        
   //         if(isset($store)){
      //
       // }
        ?>
       >registar</button>
      </form>

 <body>
</html>
