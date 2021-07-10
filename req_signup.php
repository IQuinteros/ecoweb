<?php
require_once __DIR__.('/php/utils/auth_util.php');
require_once __DIR__.('/api/query/store.php');

$data = array();
$data['rut']     =    (int)$_POST['rut'];
$data['rut_cd']     =    substr($_POST['rut'], -1);
$data['district_id']  =    (int)$_POST['district'];
$data['location']  =    $_POST['location'];
$data['contact_number']  =    (int)$_POST['contactNumber'];
$data['password']  =    $_POST['pass'];
$data['email']  =    $_POST['email'];
$data['public_name'] = 'Nueva tienda';
$data['description'] = 'Sin descripción';
$data['enabled'] = false;

echo json_encode($data);

$storeConnection = new Store();
$storeConnection->insert_store(json_decode(json_encode($data)));

$result = AuthUtil::login($data['email'], $data['password']);

if($result){
    header('Location:dashboard.php');
}
else{
    header('Location:signup.php');
}