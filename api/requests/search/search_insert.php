<?php
require_once('../base_request.php');
require_once('../../query/search.php');

$search = new Search();
$result=$search->insert_search_registered($data->user_id, $data->search_text);

send_response($result, null);   