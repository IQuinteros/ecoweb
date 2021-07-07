<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/inputs/district_input.php');
require_once __DIR__.('/php/views/inputs/text_input.php');
require_once __DIR__.('/php/utils/auth_util.php');

$store = AuthUtil::getStoreSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::PROFILE)) ?>

    <main class="main">
        <?= new HeaderView("Perfil") ?>
        
        <div class="main__container unique">
            <div class="main__profile">
                <img class="main__profile__img" src="<?= $store->photo_url ?? 'assets/img/no-image-bg.png'?>" alt="">
                <h1 class="main__profile__title"><?= $store != null? $store->public_name : 'Indeterminado'?></h1>
                <h2 class="main__profile__subtitle"><?= $store != null? $store->description : 'Sin descripción'?></h2>
                <button class="main__profile__btn">
                    <span class="material-icons material-icons-outlined">edit</span>
                </button>
            </div>
            <article class="card profile__data">
                <h1>Modifica datos</h1>

                <?= new DistrictInputView($store->district_id) ?>
                <?= new TextInputView('Dirección', 'location', 'location', 'Ingrese la dirección', $store->location) ?>
                <?= new TextInputView('Email', 'email', 'email', 'Ingrese el email', $store->email) ?>
                <?= new TextInputView('Número de contacto', 'contact', 'contact', 'Ingrese el número de contacto', $store->contact_number) ?>

                <div class="card__buttons">
                    <button class="btn btn--primary">Guardar cambios</button>
                    <button class="btn btn--primary">Cambiar contraseña</button>
                </div>
            </article>
        </div>
        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>