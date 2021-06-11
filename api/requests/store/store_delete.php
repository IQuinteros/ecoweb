<?php
require_once('../base_request.php');
require_once('../../query/store.php');

$store = new Store();
$result=$store->delete_store($data->id);

send_response($result, null);   