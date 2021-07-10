<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/inputs/district_input.php');
require_once __DIR__.('/php/views/inputs/text_input.php');
require_once __DIR__.('/php/views/inputs/image_input.php');
require_once __DIR__.('/php/utils/auth_util.php');
require_once __DIR__.('/php/utils/upload_util.php');
require_once __DIR__.('/api/query/store.php');

$store = AuthUtil::getStoreSession();

if(
    isset($_POST['location']) &&
    isset($_POST['email']) &&
    isset($_POST['contact']) &&
    isset($_POST['district'])
){
    $storeConnection = new Store();
    $newStoreData = array();
    $newStoreData['id'] = $store->id;
    $newStoreData['public_name'] = $_POST['name'];
    $newStoreData['description'] = $_POST['description'];
    $newStoreData['email'] = $_POST['email'];
    $newStoreData['contact_number'] = $_POST['contact'];
    $newStoreData['location'] = $_POST['location'];
    $newStoreData['district_id'] = $_POST['district'];
    $newStoreData['photo_url'] = $store->photo_url;

    if(isset($_FILES['newImg'])){
        $result = UploadUtil::uploadImage('newImg');
        if($result->result) $newStoreData['photo_url'] = $result->newFileUrl;
    }

    $storeConnection->update_store(json_decode(json_encode($newStoreData)));

    header('Location:profile.php?success=true');
    return;
} else if(
    isset($_REQUEST['newpass'])
){
    $storeConnection = new Store();
    $storeConnection->update_store_pass($_REQUEST['newpass'], $store->id);
    header('Location:profile.php?success=true');
    return;
}

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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <?php /*<button class="main__profile__btn">
                    <span class="material-icons material-icons-outlined">edit</span>
                </button> */?>
            </div>
            <article class="card profile__data">
                <h1>Modifica datos</h1>

                <form action="profile.php" method="POST" enctype="multipart/form-data">

                    <?= new TextInputView('Nombre público', 'name', 'name', 'Ingrese el nombre público', $store->public_name) ?>
                    <?= new TextInputView('Descripción de la tienda', 'description', 'description', 'Ingrese la descripción', $store->description) ?>
                    <?= new DistrictInputView($store->district_id) ?>
                    <?= new TextInputView('Dirección', 'location', 'location', 'Ingrese la dirección', $store->location) ?>
                    <?= new TextInputView('Email', 'email', 'email', 'Ingrese el email', $store->email, false, true, 'email') ?>
                    <?= new TextInputView('Número de contacto', 'contact', 'contact', 'Ingrese el número de contacto', $store->contact_number, false, true, 'number') ?>

                    <div class="photos-container">
                        <?= new ImageInputView()?>
                    </div>

                    <div class="card__buttons">
                        <button type="submit" class="btn btn--primary">Guardar cambios</button>
                        <button type="button" class="btn btn--primary" onclick="changePassBtn()">Cambiar contraseña</button>
                    </div>
                    
                    <script>
                        let changePassBtn = () => {
                            inputAlert(
                                'Cambiar contraseña', 
                                'Escribe la nueva contraseña para iniciar sesión', 
                                'Cambiar contraseña',
                                (val) => {
                                    // TODO: Change to POST: https://stackoverflow.com/questions/5684303/javascript-window-open-pass-values-using-post
                                    val = val.replace(/&/g, "&amp;").replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/"/g, "&quot;");
                                    window.open(`profile.php?newpass=${val}`, '_self');
                                },
                                'question',
                                'password'
                            );
                        }
                    </script>

                </form>
            </article>
        </div>
        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>
<?php if(isset($_REQUEST['success'])) {?>
<script>
    displayAlert('Perfil modificado', 'Tu perfil ha sido modificado exitósamente', 'Volver');
</script>
<?php } ?>

</body>
</html>