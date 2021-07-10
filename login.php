<?php
require_once __DIR__.('/php/views/cover/footer.php');
require_once __DIR__.('/php/views/cover/appbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/mainstyle.css">
</head>

<body>
    <?= new AppBarView()?>

    <main class="main">
        <div class="background">
            <svg class="background__wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path d="M0,160L34.3,181.3C68.6,203,137,245,206,229.3C274.3,213,343,139,411,112C480,85,549,107,617,138.7C685.7,171,754,213,823,213.3C891.4,213,960,171,1029,165.3C1097.1,160,1166,192,1234,208C1302.9,224,1371,224,1406,224L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
            <div class="background__fill"></div>
        </div>
        <form action="req_login.php" method="POST">
            <div class="main__container">
                <h1 class="main__title">Iniciar sesión</h1>
                <div class="input-container">
                    <label class="input-label">
                        Email
                        <input name="email" class="input" type="text" placeholder="Ingrese su email">
                    </label>
                </div>
                <div class="input-container">
                    <label class="input-label">
                        Contraseña
                        <input name="password" class="input" type="password"  placeholder="Ingrese la contraseña">
                    </label>
                </div>
                <button type="submit" class="btn btn--primary">Ingresar</button>
            </div>
        </form>
    </main>

    <?= new FooterView()?>
  
    <script src="js/hover.js"></script>
</body>

</html>