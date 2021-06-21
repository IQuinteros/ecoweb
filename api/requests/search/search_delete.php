<?php
require_once('../base_request.php');
require_once('../../query/search.php');

$search = new Search();
$result=$search->delete_search($data->id);

send_response($result, null);   