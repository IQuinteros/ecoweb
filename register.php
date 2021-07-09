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
        <label for="Pname"> nombre publico:</label>
        <input type="text" id="Pname" name="Pname"><br><br>
        <label for="description">descripcion:</label>
        <input type="text" id="description" name="description"><br><br>
        <label for="email">email:</label>
        <input type="text" id="email" name="email"><br><br>
        <label for="contact_number">telefono:</label>
        <input type="text" id="contact_number" name="contact_number"><br><br>
        <label for="location">direccion:</label>
        <input type="text" id="location" name="location"><br><br>
        <label for="passwords">contraseña:</label>
        <input type="text" id="passwords" name="passwords"><br><br>
        <label for="rut">rut:</label>
        <input type="text" id="rut" name="rut">
        <label for="rut_cd">rut cd:</label>
        <input type="text" id="rut_cd" name="rut_cd"><br><br>
        <select id="district" name="district">
            <option>
                <?php
                $distritos = $districtConnection->select(null);
                foreach ($distritos as $value) {
                    echo "<option value='" . $value->id . "'>" . $value->name . "</option>";
                }
                ?>
            </option>
        </select>

        <button value="submit" name="submit">registar</button>
        <button onclick="location.href=''+<script type='text/javascript'> document.write(page); </script>+''" value="submit" name="submit">login</button>
        <?php

        if (isset($_POST['submit'])) {
            $Pname = $_POST['Pname'];
            $description = $_POST['description'];
            $email = $_POST['email'];
            $contact_number = $_POST['contact_number'];
            $location = $_POST['location'];
            $passwords = $_POST['passwords'];
            $rut = $_POST['rut'];
            $rut_cd = $_POST['rut_cd'];
            $district = $_POST['district'];
            $enabled = true;
            $store = (json_decode(json_encode(array(
                "public_name" => $Pname, "description" => $description, "email" => $email, "contact_number" => $contact_number,
                "location" => $location, "passwords" => $passwords, "rut" => $rut, "rut_cd" => $rut_cd, "district_id" => $district_id, "enabled" => $enabled
            ))));
            $x=$profileConnection->insert_store($store);
            ?>
    <script>
        x = <?php $x[0]->id; ?>;
        if (x > 0) {
            var page = "home.php";
        } else {
            if (x == null) {
                var page = "register.php"
            }
        }
    </script>
<?php
} ?>
        }
        ?>
    </form>

    <body>

</html>