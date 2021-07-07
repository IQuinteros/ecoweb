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
    <title>Reports</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::REPORTS)) ?>

    <main class="main">
        <?= new HeaderView("Reportes") ?>
        
        <div class="main__container">
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Monto de ventas</h1> 
                </div>
                <div class="card__chart">
                    <canvas class="chart" id="myChart"></canvas>
                </div>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Usuarios registrados</h1>
                </div>
                <h1 class="card__content card__content--unique">1.568</h1>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Usuarios que vieron tu perfil</h1>
                </div>
                <h1 class="card__content card__content--unique">1.568</h1>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Tiendas registradas</h1>
                </div>
                <h1 class="card__content card__content--unique">20</h1>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Usuarios registrados por comuna</h1> 
                </div>
                <div class="card__chart">
                    <canvas class="chart" id="myChart"></canvas>
                </div>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Usuarios registrados por edad</h1> 
                </div>
                <div class="card__chart">
                    <canvas class="chart" id="myChart"></canvas>
                </div>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Lo que buscan los usuarios</h1> 
                </div>
                <div class="card__chart">
                    <canvas class="chart" id="myChart"></canvas>
                </div>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Productos más vendidos</h1>
                </div>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--green"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--yellow"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--blue"></div>
                        </div>
                    </div>
                </button>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--green"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--yellow"></div>
                        </div>
                    </div>
                </button>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--blue"></div>
                        </div>
                    </div>
                </button>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Productos más visitados</h1>
                </div>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--green"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--yellow"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--blue"></div>
                        </div>
                    </div>
                </button>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--green"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--yellow"></div>
                        </div>
                    </div>
                </button>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--blue"></div>
                        </div>
                    </div>
                </button>
            </article>
            <article class="card">
                <div class="card__header">
                    <h1 class="card__title">Productos con más favoritos</h1>
                </div>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--green"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--yellow"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--blue"></div>
                        </div>
                    </div>
                </button>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--green"></div>
                            <div class="ecoindicator__circle ecoindicator__circle--yellow"></div>
                        </div>
                    </div>
                </button>
                <button class="card btn article">
                    <img class="article__img" src="https://source.unsplash.com/random" alt="image">
                    <div class="article__content">
                        <h1 class="article__content__title">Título largo de un producto encontrado</h1>
                        <h1 class="article__content__price">$30.000</h1>
                        <div class="ecoindicator">
                            <div class="ecoindicator__circle ecoindicator__circle--blue"></div>
                        </div>
                    </div>
                </button>
            </article>
        </div>

        <?= new AsideButtonsView() ?>
    </main>

    <footer class="footer">
        <p>Somos ECOmercio, tu app de compras amigables</p>
    </footer>

</div>

<script src="js/script.js"></script>

</body>
</html>