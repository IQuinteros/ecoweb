<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::NONE)) ?>

    <main class="main">
        <?= new HeaderView("Edición de producto", null, "Publicado") ?>
        
        <div class="main__container unique">
            <div class="main__article">
                <img class="main__article__img" src="https://source.unsplash.com/random/2" alt="">
                <h1 class="main__article__title">Empresa HH</h1>
                <h2 class="main__article__price">$ 450.000</h2>
                <h2 class="main__article__subtitle">5 en stock</h2>
                <div class="ecoindicator">
                    <div class="ecoindicator__circle ecoindicator__circle--green"></div>
                    <div class="ecoindicator__circle ecoindicator__circle--yellow"></div>
                    <div class="ecoindicator__circle ecoindicator__circle--blue"></div>
                </div>
            </div>
            <article class="card">
                <h1>Modifica datos</h1>
                <div class="input-container">
                    <label class="input-label">
                        Descripción
                        <input class="input" type="text" placeholder="Ingrese la descripción">
                    </label>
                </div>
                <div class="input-container">
                    <label class="input-label">
                        Categoría
                        <select class="input" name="category" id="category">
                            <option value="alimentos">Hogar</option>
                            <option value="alimentos">Cuidado personal</option>
                            <option value="alimentos">Alimentos</option>
                            <option value="alimentos">Vestimenta</option>
                        </select>
                    </label>
                </div>
                <div class="input-container">
                    <label class="input-label">
                        Precio
                        <input class="input" type="text" placeholder="Ingrese un precio">
                    </label>
                </div>
                <div class="input-container">
                    <label class="input-label">
                        Stock disponible
                        <input class="input" type="text" placeholder="Ingrese el stock disponible actual">
                    </label>
                </div>
                
                <div class="photos-container">
                    <button class="btn photo">
                        <img class="photo__img" src="https://source.unsplash.com/random/2" alt="">
                        <div class="photo__delete">
                            <span class="photo__delete__icon material-icons material-icons-outlined">delete</span>
                            <span class="photo__delete__text">Eliminar imagen</span>
                        </div>
                    </button>
                    <button class="btn photo">
                        <img class="photo__img" src="https://source.unsplash.com/random/3" alt="">
                        <div class="photo__delete">
                            <span class="photo__delete__icon material-icons material-icons-outlined">delete</span>
                            <span class="photo__delete__text">Eliminar imagen</span>
                        </div>
                    </button>
                    <button class="btn photo">
                        <img class="photo__img" src="https://source.unsplash.com/random/4" alt="">
                        <div class="photo__delete">
                            <span class="photo__delete__icon material-icons material-icons-outlined">delete</span>
                            <span class="photo__delete__text">Eliminar imagen</span>
                        </div>
                    </button>
                    <button class="btn picker">
                        <span class="picker__icon material-icons material-icons-outlined">file_upload</span>
                        <span class="picker__text">Subir nueva imagen</span>
                    </button>
                </div>

                <div class="card__buttons">
                    <button class="btn btn--primary">Publicar producto</button>
                    <button class="btn btn--primary">Guardar borrador</button>
                </div>
            </article>
        </div>
        <aside class="buttons">
            <button class="card btn btn--red">
                <h1>Pedidos</h1>
                <p>50 nuevos pedidos</p>
            </button>
            <button class="card btn">
                <h1>Chats</h1>
                <p>Sin nuevos mensajes</p>
            </button>
            <button class="card btn">
                <h1>Preguntas</h1>
                <p>Sin nuevas preguntas</p>
            </button>
            <button class="card btn btn--red">
                <h1>Valoraciones</h1>
                <p>50 nuevas opiniones</p>
            </button>
        </aside>
    </main>

    <footer class="footer">
        <p>Somos ECOmercio, tu app de compras amigables</p>
    </footer>

</div>

<script src="js/script.js"></script>

</body>
</html>