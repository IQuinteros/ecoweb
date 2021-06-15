<?php
require_once('../base_request.php');
require_once('../../query/history.php');

$history = new History();

$result=$history->insert_history($data);


send_response(isset($result), $result); 