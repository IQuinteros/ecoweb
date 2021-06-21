<?php
require_once('../base_request.php');
require_once('../../query/store.php');

$store = new Store();
$result=$store->update_store_pass($data->password, $data->id);

send_response($result, null);   