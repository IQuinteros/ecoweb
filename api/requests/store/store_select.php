<?php
require_once('../base_request.php');
require_once('../../query/store.php');

$store = new Store();
$result=$store->select_store($data->id, $data->public_name, $data->email);

send_response($result, null);   