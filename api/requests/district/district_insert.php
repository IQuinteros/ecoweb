<?php
require_once('../base_request.php');
require_once('../../query/district.php');

$d = new District();
$result=$d->insert_district($data->name);


send_response(isset($result), $result); 