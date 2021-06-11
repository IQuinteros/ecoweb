<?php
require_once('../base_request.php');
require_once('../../query/search.php');

$search = new Search();

$result=$search->insert_search_registered($data->search_text, $data->user_id);

send_response(isset($result), $result);   