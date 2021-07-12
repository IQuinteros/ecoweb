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
    <title>EcoApp</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/mainstyle.css">

    <link rel="manifest" href="/manifest.json">
</head>
<body>
    <?= new AppBarView()?>

    <main class="main">
        <div class="background">
            <svg class="background__wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path d="M0,160L34.3,181.3C68.6,203,137,245,206,229.3C274.3,213,343,139,411,112C480,85,549,107,617,138.7C685.7,171,754,213,823,213.3C891.4,213,960,171,1029,165.3C1097.1,160,1166,192,1234,208C1302.9,224,1371,224,1406,224L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
            <div class="background__fill"></div>
            <div class="background inside">
                <svg class="background__wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path d="M0,288L34.3,272C68.6,256,137,224,206,176C274.3,128,343,64,411,80C480,96,549,192,617,213.3C685.7,235,754,181,823,186.7C891.4,192,960,256,1029,282.7C1097.1,309,1166,299,1234,250.7C1302.9,203,1371,117,1406,74.7L1440,32L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
                <div class="background__fill"></div>
            </div>
        </div>
        <div class="main__container">
            <article class="main__article">
                <img class="main__article__img hover--card" src="assets/img/screen3.png" alt="">
                <h1 class="main__article__title">Encuentra los productos ecológicos que tu y el medio ambiente necesitan</h1>
            </article>
            <article class="main__article">
                <img class="main__article__img hover--card" src="assets/img/screen2.png" alt="">
                <h1 class="main__article__title card">Revisa y compara precios y valoraciones de otras personas</h1>
            </article>
            <article class="main__article">
                <img class="main__article__img hover--card" src="assets/img/screen4.png" alt="">
                <h1 class="main__article__title card">Comunícate y pregunta a los mismos vendedores por un producto</h1>
            </article>

            <article class="card main__card">
                <h2 class="main__card__header">Sabrás cómo estás aportando al medio ambiente al comprar en ECOmercio</h2>
                <span class="main__card__icon material-icons material-icons-outlined">eco</span>
                <h1 class="main__card__title">Reduce ya tu impacto ambiental comprando con nuestra app ECOmercio</h1>
                <button class="main__card__img">
                    <img  src="assets/img/google-play-badge.png" alt="">
                </button>
            </article>
        </div>
    </main>

    <?= new FooterView()?>
  
    <script src="js/hover.js"></script>
</body>
</html>