<?php
require_once('../base_request.php');
require_once('../../query/history_detail.php');

$history_d = new History_detail();
$result=$history_d->insert_history_detail($data);


send_response(isset($result), $result); 