<?php
require_once('../base_request.php');
require_once('../../query/store.php');

$store = new Store();
$result=$store->insert_store($data);

send_response($result, null);   