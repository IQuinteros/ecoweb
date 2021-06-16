<?php
require_once('../base_request.php');
require_once('../../query/history.php');

$history = new History();
$result=$history->history_update_deleted($data->$id);


send_response(isset($result), $result); 