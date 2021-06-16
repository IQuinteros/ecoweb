<?php
require_once('../base_request.php');
require_once('../../query/history.php');

$history = new History();
$result=$history->history_delete($data->$id);


send_response(isset($result), $result); 