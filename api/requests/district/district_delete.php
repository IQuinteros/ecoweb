<?php
require_once('../base_request.php');
require_once('../../query/district.php');

$d = new District();
$result=$d->delete_district($data->id);


send_response($result, null); 