<?php
require_once('../base_request.php');
require_once('../../query/district.php');

$d = new District();
$result=$d->update_district($data->id, $data->name);


send_response($result, null); 