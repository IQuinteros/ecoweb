<?php
require_once __DIR__ . ('/php/utils/auth_util.php');
echo AuthUtil::getStoreSession() ? "Sesión iniciada" : "No iniciada";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $passwords = $_POST['passwords'];

    echo AuthUtil::login($email, $passwords) ? "verdadero" : "false";
    AuthUtil::getStoreSession();
    if (AuthUtil::getStoreSession() != null) {
        echo AuthUtil::getStoreSession()->public_name;
        $x = true;
    } else {
        echo "no esta iniciada la secion";
    } ?>
    <script>
        x = <?php $x ?>;
        if (x != null) {
            var page = "home.php";
        } else {
            if (x == null) {
                var page = "login.php"
            }
        }
    </script>
<?php
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <?php

    ini_set('display_errors', 1);
    error_reporting(~0);
    require_once('include.php');
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" id="login_store">
        <label for="email">Correo</label>
        <input type="text" id="email" name="email" placeholder="ingrese email"><br><br>
        <label for="passwords">contraseña </label>
        <input type="text" id="passwords" name="passwords" placeholder="ingrese contraseña"><br><br>


        <button onclick="location.href=''+<script type='text/javascript'> document.write(page); </script>+''" value="submit" name="submit">login</button>
    </form>
</body>

</html>