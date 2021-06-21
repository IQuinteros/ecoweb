<?php
require_once('../base_request.php');
require_once('../../query/search.php');

$search = new Search();
$result=$search->select_search($data);

send_response(isset($result), $result);   